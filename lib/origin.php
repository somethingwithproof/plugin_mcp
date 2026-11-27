<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/**
 * Split an absolute http(s) URL into scheme, host, effective port and path.
 * Returns null for anything that is not a plain origin-plus-path URL.
 *
 * @param string $url Raw URL string to parse.
 * @return array{scheme: string, host: string, port: int, path: string}|null
 */
function mcp_parse_url(string $url) : ?array {
	if (!preg_match('~^(https?)://([^/?#]*)([^?#]*)(?:\?[^#]*)?(?:#.*)?$~iD', $url, $parts)) {
		return null;
	}

	$scheme    = strtolower($parts[1]);
	$authority = $parts[2];
	$path      = $parts[3];

	// Userinfo would let "https://cacti.example.com@evil.example" pass a prefix check.
	if (!preg_match('~^(\[[0-9a-fA-F:.]+\]|[A-Za-z0-9.-]+)(?::([0-9]+))?$~D', $authority, $hostParts)) {
		return null;
	}

	$host = strtolower($hostParts[1]);

	if ($host[0] === '[') {
		if (filter_var(substr($host, 1, -1), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
			return null;
		}
	} elseif (!preg_match('~^[a-z0-9]([a-z0-9-]*[a-z0-9])?(\.[a-z0-9]([a-z0-9-]*[a-z0-9])?)*$~D', $host)) {
		return null;
	}

	$defaultPort = $scheme === 'https' ? 443 : 80;
	$port        = $defaultPort;

	if (($hostParts[2] ?? '') !== '') {
		$port = (int) $hostParts[2];

		if ($port < 1 || $port > 65535) {
			return null;
		}
	}

	if ($path !== '' && !preg_match('#^/[A-Za-z0-9._~!$&\'()*+,;=:@%/-]*$#D', $path)) {
		return null;
	}

	return ['scheme' => $scheme, 'host' => $host, 'port' => $port, 'path' => rtrim($path, '/')];
}

/**
 * Determine whether a lowercase host string refers to a loopback address.
 *
 * @param string $host Hostname or bracketed IPv6 literal.
 * @return bool True for localhost, 127.0.0.1, or ::1.
 */
function mcp_is_loopback_host(string $host) : bool {
	if ($host !== '' && $host[0] === '[') {
		// Any spelling of ::1, such as [0:0:0:0:0:0:0:1].
		return inet_pton(substr($host, 1, -1)) === inet_pton('::1');
	}

	return in_array($host, ['localhost', '127.0.0.1'], true);
}

/**
 * Serialize parsed URL parts into a canonical scheme://host[:port] origin string.
 *
 * @param array{scheme: string, host: string, port: int, path?: string} $parts Parsed URL parts.
 * @return string Canonical origin string without trailing slash or default port.
 */
function mcp_origin_string(array $parts) : string {
	$defaultPort = $parts['scheme'] === 'https' ? 443 : 80;

	return $parts['scheme'] . '://' . $parts['host']
		. ($parts['port'] === $defaultPort ? '' : ':' . $parts['port']);
}

/**
 * Normalize a configured public URL: lowercase scheme and host, default port
 * dropped, no trailing slash, query or fragment. HTTPS is required except for
 * loopback hosts. Returns null when the value is not acceptable.
 *
 * @param string $value Raw configured public URL.
 * @return ?string Normalized URL or null when invalid.
 */
function mcp_normalize_public_url(string $value) : ?string {
	$parts = mcp_parse_url(trim($value));

	if ($parts === null) {
		return null;
	}

	if ($parts['scheme'] !== 'https' && !mcp_is_loopback_host($parts['host'])) {
		return null;
	}

	return mcp_origin_string($parts) . $parts['path'];
}

/**
 * Read and normalize the configured mcp_public_url option.
 *
 * @return ?string Normalized public URL or null when unset or invalid.
 */
function mcp_public_url() : ?string {
	$value = read_config_option('mcp_public_url');

	return is_string($value) ? mcp_normalize_public_url($value) : null;
}

/**
 * Build the canonical MCP endpoint URI for a normalized public Cacti URL.
 *
 * @param string $publicUrl Normalized public Cacti base URL.
 * @return string Canonical endpoint URI.
 */
function mcp_canonical_uri(string $publicUrl) : string {
	return $publicUrl . '/plugins/mcp/mcp.php';
}

/**
 * An absent Origin header (non-browser client) is allowed. Otherwise the
 * header must be exactly the scheme, host and effective port of the public URL.
 *
 * @param ?string $origin    HTTP Origin header value or null when absent.
 * @param string  $publicUrl Normalized public Cacti base URL.
 * @return bool True if the request origin is allowed.
 */
function mcp_origin_allowed(?string $origin, string $publicUrl) : bool {
	if ($origin === null) {
		return true;
	}

	$allowed = mcp_parse_url($publicUrl);
	$given   = mcp_parse_url($origin);

	// An Origin is exactly scheme://host[:port]. Anything the parser tolerates
	// beyond that (path, query, fragment, trailing slash, explicit default
	// port) means the value is not a browser-serialized origin.
	if ($allowed === null || $given === null || strtolower($origin) !== mcp_origin_string($given)) {
		return false;
	}

	return $given['scheme'] === $allowed['scheme']
		&& $given['host'] === $allowed['host']
		&& $given['port'] === $allowed['port'];
}

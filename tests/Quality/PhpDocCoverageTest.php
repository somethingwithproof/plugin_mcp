<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

declare(strict_types=1);

namespace Tests\Quality;

use PHPUnit\Framework\TestCase;

final class PhpDocCoverageTest extends TestCase {
	/**
	 * Collect all production PHP files in the plugin root and lib/ directory.
	 *
	 * @return list<string>
	 */
	private function productionPhpFiles() : array {
		$root  = dirname(__DIR__, 2);
		$files = array_merge(
			glob($root . '/*.php') ?: [],
			glob($root . '/lib/*.php') ?: [],
			glob($root . '/scripts/*.php') ?: []
		);
		sort($files);

		return array_values($files);
	}

	/**
	 * Find the docblock attached to the declaration at token index $index,
	 * skipping modifiers, attributes, and whitespace.
	 *
	 * @param list<array{0: int, 1: string, 2: int}|string> $tokens
	 */
	private function attachedDocComment(array $tokens, int $index) : ?string {
		$modifierTokens = [
			T_PUBLIC, T_PROTECTED, T_PRIVATE, T_STATIC, T_FINAL, T_ABSTRACT, T_READONLY,
		];

		for ($i = $index - 1; $i >= 0; $i--) {
			$token = $tokens[$i];

			if (is_array($token)) {
				if ($token[0] === T_WHITESPACE || $token[0] === T_COMMENT) {
					continue;
				}

				if (in_array($token[0], $modifierTokens, true)) {
					continue;
				}

				if ($token[0] === T_DOC_COMMENT) {
					return $token[1];
				}

				return null;
			}

			return null;
		}

		return null;
	}

	/**
	 * Parse parameter variable names from a function/method signature starting at $fnIndex.
	 *
	 * @param list<array{0: int, 1: string, 2: int}|string> $tokens
	 * @return list<string>
	 */
	private function extractParameterNames(array $tokens, int $fnIndex) : array {
		$count  = count($tokens);
		$params = [];
		$depth  = 0;
		$inArgs = false;

		for ($i = $fnIndex + 1; $i < $count; $i++) {
			$token = $tokens[$i];

			if ($token === '(') {
				$depth++;
				$inArgs = true;

				continue;
			}

			if ($token === ')') {
				$depth--;

				if ($inArgs && $depth === 0) {
					break;
				}

				continue;
			}

			if ($inArgs && $depth === 1 && is_array($token) && $token[0] === T_VARIABLE) {
				// Ignore default value variables after '=' inside a parameter.
				$prev = $i - 1;

				while ($prev > $fnIndex && is_array($tokens[$prev]) && $tokens[$prev][0] === T_WHITESPACE) {
					$prev--;
				}

				if ($tokens[$prev] !== '=') {
					$params[] = $token[1];
				}
			}
		}

		return $params;
	}

	public function testAllProductionPhpDeclarationsHaveCompletePhpDoc() : void {
		$files = $this->productionPhpFiles();
		$this->assertNotEmpty($files, 'Expected production PHP files to inspect');

		$violations = [];
		$checked    = 0;
		$rootPrefix = dirname(__DIR__, 2) . '/';

		foreach ($files as $file) {
			$relative = str_starts_with($file, $rootPrefix) ? substr($file, strlen($rootPrefix)) : $file;
			$source   = (string) file_get_contents($file);
			$tokens   = token_get_all($source);
			$count    = count($tokens);

			for ($i = 0; $i < $count; $i++) {
				$token = $tokens[$i];

				if (!is_array($token)) {
					continue;
				}

				if (in_array($token[0], [T_CLASS, T_INTERFACE, T_TRAIT, T_ENUM], true)) {
					// Skip anonymous classes (`new class ...`) and `::class`.
					$prev = $i - 1;

					while ($prev >= 0 && is_array($tokens[$prev]) && $tokens[$prev][0] === T_WHITESPACE) {
						$prev--;
					}

					if ($prev >= 0 && is_array($tokens[$prev]) && in_array($tokens[$prev][0], [T_NEW, T_DOUBLE_COLON], true)) {
						continue;
					}

					$name = null;

					for ($j = $i + 1; $j < $count; $j++) {
						if (is_array($tokens[$j]) && $tokens[$j][0] === T_STRING) {
							$name = $tokens[$j][1];

							break;
						}

						if ($tokens[$j] === '{' || $tokens[$j] === '(') {
							break;
						}
					}

					if ($name === null) {
						continue;
					}

					$checked++;
					$doc = $this->attachedDocComment($tokens, $i);

					if ($doc === null) {
						$violations[] = sprintf('%s:%d missing PHPDoc for class/type %s', $relative, $token[2], $name);
					}

					continue;
				}

				if ($token[0] === T_FUNCTION) {
					// Determine if this is a named function/method or an anonymous closure.
					$name = null;

					for ($j = $i + 1; $j < $count; $j++) {
						$next = $tokens[$j];

						if (is_array($next) && $next[0] === T_WHITESPACE) {
							continue;
						}

						if ($next === '&') {
							continue;
						}

						if (is_array($next) && $next[0] === T_STRING) {
							$name = $next[1];
						}

						break;
					}

					if ($name === null) {
						continue;
					}

					$checked++;
					$doc = $this->attachedDocComment($tokens, $i);

					if ($doc === null) {
						$violations[] = sprintf('%s:%d missing PHPDoc for function %s()', $relative, $token[2], $name);

						continue;
					}

					foreach ($this->extractParameterNames($tokens, $i) as $param) {
						if (!preg_match('/@param\b[^\n]*' . preg_quote($param, '/') . '\b/', $doc)) {
							$violations[] = sprintf('%s:%d missing @param %s in PHPDoc for %s()', $relative, $token[2], $param, $name);
						}
					}

					if ($name !== '__construct' && !preg_match('/@return\b/', $doc)) {
						$violations[] = sprintf('%s:%d missing @return in PHPDoc for %s()', $relative, $token[2], $name);
					}
				}
			}
		}

		$this->assertGreaterThan(50, $checked, 'Expected to verify all production classes, methods, and functions');
		$this->assertSame([], $violations, "PHPDoc coverage violations:\n" . implode("\n", $violations));
	}
}

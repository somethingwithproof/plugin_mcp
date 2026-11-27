<?php
/* SPDX-FileCopyrightText: 2026 Thomas Vincent
 * SPDX-License-Identifier: GPL-2.0-or-later */

/**
 * Domain error carrying a google.rpc.Code status, ErrorInfo reason, and HTTP status override.
 */
class AbilitiesError extends RuntimeException {
	private const HTTP_CODES = [
		'INVALID_ARGUMENT'    => 400,
		'FAILED_PRECONDITION' => 400,
		'OUT_OF_RANGE'        => 400,
		'UNAUTHENTICATED'     => 401,
		'PERMISSION_DENIED'   => 403,
		'NOT_FOUND'           => 404,
		'ALREADY_EXISTS'      => 409,
		'ABORTED'             => 409,
		'RESOURCE_EXHAUSTED'  => 429,
		'UNIMPLEMENTED'       => 501,
		'UNAVAILABLE'         => 503,
		'INTERNAL'            => 500,
	];

	/**
	 * Construct an AbilitiesError.
	 *
	 * @param string $status     A google.rpc.Code name.
	 * @param string $reason     UPPER_SNAKE_CASE ErrorInfo reason.
	 * @param string $message    Developer facing text; empty selects the default for the reason.
	 * @param array  $violations List of ['field' => string, 'description' => string].
	 * @param ?int   $httpCode   Overrides the HTTP status implied by $status.
	 */
	public function __construct(public string $status, public string $reason, string $message = '',
		public array $violations = [], public ?int $httpCode = null) {
		parent::__construct($message);
	}

	/**
	 * Resolve the HTTP status code corresponding to this error.
	 *
	 * @return int HTTP status code.
	 */
	public function httpStatus() : int {
		return $this->httpCode ?? self::HTTP_CODES[$this->status] ?? 500;
	}
}

/** Realm IDs the built-in abilities check. lib/providers.php enforces them and the console shows them. Plugin abilities declare their own. */
const MCP_BUILTIN_REALMS = [
	'cacti-get-system-info'   => 15,
	'cacti-list-devices'      => 3,
	'cacti-get-device'        => 3,
	'cacti-list-sites'        => 3,
	'cacti-list-pollers'      => 15,
	'cacti-list-trees'        => 7,
	'cacti-list-graphs'       => 7,
	'cacti-list-data-sources' => 3,
	'cacti-get-clog'          => 19,
];

/**
 * The class name of an exception for the log. An anonymous class name embeds a NUL and a file path, so use its parent.
 *
 * @param Throwable $error Exception or error instance.
 * @return string Safe exception class name for logging.
 */
function mcp_exception_class(Throwable $error) : string {
	$class = $error::class;

	if (!str_contains($class, '@anonymous')) {
		return $class;
	}

	return (get_parent_class($error) ?: 'class') . '@anonymous';
}

/**
 * Log a failure the caller only sees as a generic error. Only the ability id, a fixed reason, and the
 * exception class are written: never the message, arguments, or token. Skipped where Cacti is not loaded.
 *
 * @param string     $ability Ability identifier or empty string.
 * @param string     $reason  Fixed reason token.
 * @param ?Throwable $error   Optional exception whose class name is recorded.
 * @return void
 */
function mcp_log_failure(string $ability, string $reason, ?Throwable $error = null) : void {
	if (!function_exists('cacti_log')) {
		return;
	}
	$ability = AbilitiesRegistry::isValidId($ability) ? $ability : '(none)';

	cacti_log('MCP: ability ' . $ability . ' failed: ' . $reason . ($error !== null ? ' (' . mcp_exception_class($error) . ')' : ''), false, 'MCP');
}

/**
 * Validate a schema in the supported JSON Schema subset. Unsupported constraints fail closed.
 *
 * @param array<string, mixed> $schema Ability input or output JSON schema.
 * @return void
 */
function abilities_check_schema(array $schema) : void {
	$types = [
		'object'  => ['type', 'description', 'properties', 'required', 'additionalProperties'],
		'integer' => ['type', 'description', 'minimum', 'maximum'],
		'number'  => ['type', 'description', 'minimum', 'maximum'],
		'string'  => ['type', 'description', 'minLength', 'maxLength', 'enum', 'pattern'],
		'boolean' => ['type', 'description'],
		'array'   => ['type', 'description', 'items', 'maxItems']
	];
	$type = $schema['type'] ?? '';

	// A nullable type is a two-element list ending in 'null'.
	if (is_array($type)) {
		if (count($type) !== 2 || !array_is_list($type) || $type[1] !== 'null') {
			throw new LogicException('Unsupported ability schema');
		}
		$type = $type[0];
	}

	if (!is_string($type) || !isset($types[$type]) || array_diff(array_keys($schema), $types[$type])) {
		throw new LogicException('Unsupported ability schema');
	}

	if (isset($schema['pattern']) && (!is_string($schema['pattern']) || str_contains($schema['pattern'], '~')
		|| @preg_match('~' . $schema['pattern'] . '~Du', '') === false)) {
		throw new LogicException('Invalid string pattern');
	}

	if ($type === 'object') {
		if (($schema['additionalProperties'] ?? null) !== false || !isset($schema['properties'])) {
			throw new LogicException('Object schemas must be closed');
		}

		foreach ($schema['properties'] as $property) {
			if (!is_array($property)) {
				throw new LogicException('Unsupported ability schema');
			}
			abilities_check_schema($property);
		}

		foreach ($schema['required'] ?? [] as $name) {
			if (!array_key_exists($name, (array) $schema['properties'])) {
				throw new LogicException('Unknown required property');
			}
		}
	}

	if ($type === 'array') {
		if (!is_array($schema['items'] ?? null) || !is_int($schema['maxItems'] ?? null) || $schema['maxItems'] < 0) {
			throw new LogicException('Array schemas need items and maxItems');
		}
		abilities_check_schema($schema['items']);
	}
}

/**
 * Validate a decoded JSON value against a checked ability schema.
 *
 * $capStrings applies the default 4096-character limit to strings without a declared maxLength.
 * It is on for arguments; results are bounded by their declared maxLength and the result byte limit.
 *
 * @param mixed                $value      Decoded JSON value to validate.
 * @param array<string, mixed> $schema     Schema specification.
 * @param bool                 $capStrings Whether to enforce the 4096-character default string cap.
 * @return void
 */
function abilities_validate(mixed $value, array $schema, bool $capStrings = true) : void {
	$type = $schema['type'];

	if (is_array($type)) {
		if ($value === null) {
			return;
		}
		$type = $type[0];
	}
	$valid = ($type === 'object' && $value instanceof stdClass)
		|| ($type === 'integer' && is_int($value))
		|| ($type === 'number' && (is_int($value) || is_float($value)))
		|| ($type === 'string' && is_string($value))
		|| ($type === 'boolean' && is_bool($value))
		|| ($type === 'array' && is_array($value) && array_is_list($value));

	if (!$valid) {
		throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS');
	}

	if ($type === 'object') {
		$properties = (array) $schema['properties'];

		foreach ($schema['required'] ?? [] as $name) {
			if (!property_exists($value, $name)) {
				throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS');
			}
		}

		foreach (get_object_vars($value) as $name => $item) {
			if (!array_key_exists($name, $properties)) {
				throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS');
			}
			abilities_validate($item, $properties[$name], $capStrings);
		}
	}

	if ($type === 'array') {
		if (count($value) > $schema['maxItems']) {
			throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS');
		}

		foreach ($value as $item) {
			abilities_validate($item, $schema['items'], $capStrings);
		}
	}

	if (($type === 'integer' || $type === 'number') && ($value < ($schema['minimum'] ?? -INF)
		|| $value > ($schema['maximum'] ?? INF))) {
		throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS');
	}

	if ($type === 'string') {
		$length = preg_match_all('/./us', $value);

		if ($length === false || $length < ($schema['minLength'] ?? 0) || $length > ($schema['maxLength'] ?? ($capStrings ? 4096 : PHP_INT_MAX))
			|| (isset($schema['enum']) && !in_array($value, $schema['enum'], true))
			|| (isset($schema['pattern']) && preg_match('~' . $schema['pattern'] . '~Du', $value) !== 1)) {
			throw new AbilitiesError('INVALID_ARGUMENT', 'INVALID_ARGUMENTS');
		}
	}
}

/**
 * Make every empty PHP array that the schema declares an object an actual empty object, at any depth,
 * so it encodes as {} rather than []. A top-level result stays an array; the callers encode it as an object.
 * Non-empty lists are left alone and fail validation.
 *
 * @param mixed                $value  Result value to normalize.
 * @param array<string, mixed> $schema Declared output schema.
 * @param bool                 $top    True when normalizing the top-level result array.
 * @return mixed Normalized value.
 */
function abilities_normalize_output(mixed $value, array $schema, bool $top = true) : mixed {
	$type = is_array($schema['type']) ? $schema['type'][0] : $schema['type'];

	if ($type === 'object') {
		if ($value === [] && !$top) {
			return new stdClass();
		}
		$properties = (array) ($schema['properties'] ?? []);

		if ($value instanceof stdClass) {
			foreach (get_object_vars($value) as $name => $item) {
				if (isset($properties[$name])) {
					$value->$name = abilities_normalize_output($item, $properties[$name], false);
				}
			}
		} elseif (is_array($value) && !array_is_list($value)) {
			foreach ($value as $name => $item) {
				if (isset($properties[$name])) {
					$value[$name] = abilities_normalize_output($item, $properties[$name], false);
				}
			}
		}
	} elseif ($type === 'array' && is_array($value) && isset($schema['items'])) {
		$value = array_map(fn ($item) => abilities_normalize_output($item, $schema['items'], false), $value);
	}

	return $value;
}

/**
 * In-memory registry of read-only abilities enforcing schema validation, exposure, permissions, and auditing.
 */
class AbilitiesRegistry {
	public const ID_PATTERN        = '/^(?=.{1,64}$)[a-z][a-z0-9]*(-[a-z0-9]+){1,7}$/D';
	private const CATEGORY_PATTERN = '/^[a-z][a-z0-9-]{0,31}$/D';
	private const ANNOTATIONS      = ['readOnly' => true, 'destructive' => false, 'idempotent' => true];
	private const KEYS             = ['label', 'description', 'category', 'input_schema', 'output_schema', 'annotations', 'permission', 'execute'];

	private array $entries    = [];
	private array $categories = [];

	/** @var ?callable(string, string): bool */
	private $isExposed = null;

	/**
	 * Whether $id is a well-formed ability identifier.
	 *
	 * @param string $id Candidate ability identifier.
	 * @return bool True when $id matches ID_PATTERN.
	 */
	public static function isValidId(string $id) : bool {
		return preg_match(self::ID_PATTERN, $id) === 1;
	}

	/**
	 * Set the exposure policy, callable(string $id, string $namespace): bool. Without one, every ability is exposed.
	 *
	 * @param callable(string, string): bool $isExposed Policy callback.
	 * @return void
	 */
	public function setExposure(callable $isExposed) : void {
		$this->isExposed = $isExposed;
	}

	/**
	 * Register an ability category identifier and display label.
	 *
	 * @param string $id    Lowercase category slug.
	 * @param string $label Human-readable category label.
	 * @return void
	 */
	public function registerCategory(string $id, string $label) : void {
		if (!preg_match(self::CATEGORY_PATTERN, $id) || $label === '' || isset($this->categories[$id])) {
			throw new LogicException('Invalid or duplicate ability category');
		}
		$this->categories[$id] = $label;
	}

	/**
	 * Register one read-only ability definition under the given namespace.
	 *
	 * @param string               $id         Ability identifier.
	 * @param array<string, mixed> $definition Ability definition array.
	 * @param string               $namespace  Owning plugin namespace.
	 * @return void
	 */
	public function register(string $id, array $definition, string $namespace = 'cacti') : void {
		if (!self::isValidId($id) || isset($this->entries[$id]) || count($this->entries) >= 256) {
			throw new LogicException('Invalid or duplicate ability');
		}

		if (array_diff(array_keys($definition), self::KEYS) || array_diff(self::KEYS, array_keys($definition))) {
			throw new LogicException('Ability definition must have exactly the documented keys');
		}

		foreach (['label', 'description', 'category'] as $key) {
			if (!is_string($definition[$key])) {
				throw new LogicException('Ability ' . $key . ' must be a string');
			}
		}

		if ($definition['label'] === '' || strlen($definition['description']) > 4096 || !isset($this->categories[$definition['category']])) {
			throw new LogicException('Invalid ability label, description, or category');
		}

		if (!is_array($definition['annotations']) || !$this->sameAnnotations($definition['annotations'])) {
			throw new LogicException('Only read-only, non-destructive, idempotent abilities may register');
		}

		if (!is_callable($definition['permission']) || !is_callable($definition['execute'])) {
			throw new LogicException('Ability permission and execute must be callable');
		}

		foreach (['input_schema', 'output_schema'] as $key) {
			if (!is_array($definition[$key]) || ($definition[$key]['type'] ?? '') !== 'object') {
				throw new LogicException('Ability schemas must be object schemas');
			}
			abilities_check_schema($definition[$key]);
		}
		$this->entries[$id] = ['id' => $id, 'namespace' => $namespace] + $definition;
	}

	/**
	 * Take over the state of a clone made from this registry, once its plugin registered cleanly.
	 *
	 * @param self $scratch Cloned registry with validated plugin registrations.
	 * @return void
	 */
	public function adopt(self $scratch) : void {
		$this->entries    = $scratch->entries;
		$this->categories = $scratch->categories;
	}

	/**
	 * Every registered ability with its namespace, ignoring principal and exposure. For the admin page only.
	 *
	 * @return list<array<string, mixed>>
	 */
	public function all() : array {
		return array_values(array_map(fn (array $entry) => $this->descriptor($entry) + ['namespace' => $entry['namespace']], $this->entries));
	}

	/**
	 * Return all abilities visible and permitted for the given principal.
	 *
	 * @param array<string, mixed> $principal Authenticated principal.
	 * @return list<array<string, mixed>>
	 */
	public function discover(array $principal) : array {
		$items = [];

		foreach ($this->entries as $entry) {
			if ($this->allowed($entry, $principal)) {
				$items[] = $this->descriptor($entry);
			}
		}

		return $items;
	}

	/**
	 * Return one ability descriptor when visible and permitted for the principal, or null otherwise.
	 *
	 * @param array<string, mixed> $principal Authenticated principal.
	 * @param string               $id        Ability identifier.
	 * @return ?array<string, mixed>
	 */
	public function get(array $principal, string $id) : ?array {
		$entry = $this->entries[$id] ?? null;

		return $entry !== null && $this->allowed($entry, $principal) ? $this->descriptor($entry) : null;
	}

	/**
	 * Execute a permitted ability after input validation and audit logging.
	 *
	 * @param array<string, mixed> $principal Authenticated principal.
	 * @param string               $id        Ability identifier.
	 * @param stdClass             $args      Decoded caller arguments.
	 * @param callable             $audit     Audit logger callback.
	 * @return array{requestId: string, result: array}
	 */
	public function execute(array $principal, string $id, stdClass $args, callable $audit) : array {
		$entry     = $this->entries[$id] ?? null;
		$requestId = bin2hex(random_bytes(16));

		// Unknown, hidden, and unpermitted abilities are indistinguishable to the caller.
		if ($entry === null || !$this->allowed($entry, $principal)) {
			// The audit name comes from the caller, so only a well-formed identifier is recorded.
			$this->auditRefusal($audit, $requestId, self::isValidId($id) ? $id : '(invalid)', 'denied');

			throw new AbilitiesError('NOT_FOUND', 'ABILITY_NOT_FOUND');
		}

		try {
			abilities_validate($args, $entry['input_schema']);
		} catch (AbilitiesError $error) {
			// Argument values are never recorded.
			$this->auditRefusal($audit, $requestId, $id, 'rejected');

			throw $error;
		}
		$audit($requestId, $id, 'started');

		try {
			$result = ($entry['execute'])($principal['user_id'], $args);
			$result = $this->checkResult($result, $entry['output_schema']);
		} catch (Throwable $error) {
			$audit($requestId, $id, 'failed');

			throw $error;
		}
		$audit($requestId, $id, 'succeeded');

		return ['requestId' => $requestId, 'result' => $result];
	}

	/**
	 * Record a refused attempt. Nothing ran, so an audit outage must not change the error the caller sees.
	 *
	 * @param callable $audit     Audit logger callback.
	 * @param string   $requestId Generated request ID.
	 * @param string   $name      Validated ability name or '(invalid)'.
	 * @param string   $outcome   Refusal outcome ('denied' or 'rejected').
	 * @return void
	 */
	private function auditRefusal(callable $audit, string $requestId, string $name, string $outcome) : void {
		try {
			$audit($requestId, $name, $outcome);
		} catch (Throwable $error) {
			// The refusal itself is the outcome; the audit failure is not reported to the caller, only logged.
			mcp_log_failure($name, 'AUDIT_REFUSAL_FAILED', $error);
		}
	}

	/**
	 * The result must survive a JSON round trip and match the declared output schema exactly. Returns it with empty objects normalized.
	 *
	 * @param mixed                $result Raw ability return value.
	 * @param array<string, mixed> $schema Declared output schema.
	 * @return array<string, mixed> Validated result array.
	 */
	private function checkResult(mixed $result, array $schema) : array {
		try {
			// A non-empty list would be cast to an object with numeric keys; reject it instead.
			if (!is_array($result) || ($result !== [] && array_is_list($result))) {
				throw new AbilitiesError('INTERNAL', 'INVALID_RESULT');
			}
			$result = abilities_normalize_output($result, $schema);
			$json   = json_encode((object) $result, JSON_THROW_ON_ERROR);

			if (strlen($json) > 1000000) {
				throw new AbilitiesError('INTERNAL', 'INVALID_RESULT');
			}
			abilities_validate(json_decode($json, false, 512, JSON_THROW_ON_ERROR), $schema, false);
		} catch (AbilitiesError | JsonException $error) {
			throw new AbilitiesError('INTERNAL', 'INVALID_RESULT');
		}

		return $result;
	}

	/**
	 * Verify annotations match the fixed read-only, non-destructive, idempotent set.
	 *
	 * @param array<string, mixed> $annotations Candidate annotations array.
	 * @return bool True when annotations match exactly.
	 */
	private function sameAnnotations(array $annotations) : bool {
		foreach (self::ANNOTATIONS as $key => $value) {
			if (!array_key_exists($key, $annotations) || $annotations[$key] !== $value) {
				return false;
			}
		}

		return count($annotations) === count(self::ANNOTATIONS);
	}

	/**
	 * Build the public descriptor array for a registered entry.
	 *
	 * @param array<string, mixed> $entry Internal registry entry.
	 * @return array<string, mixed> Public descriptor array.
	 */
	private function descriptor(array $entry) : array {
		return [
			'id'           => $entry['id'],
			'label'        => $entry['label'],
			'description'  => $entry['description'],
			'category'     => $entry['category'],
			'inputSchema'  => $entry['input_schema'],
			'outputSchema' => $entry['output_schema'],
			'annotations'  => self::ANNOTATIONS
		];
	}

	/**
	 * Check whether the principal holds scope, exposure, and permission for an ability.
	 *
	 * @param array<string, mixed> $entry     Internal registry entry.
	 * @param array<string, mixed> $principal Authenticated principal.
	 * @return bool True when allowed.
	 */
	private function allowed(array $entry, array $principal) : bool {
		// Exposure narrows access; the realm check below still applies to exposed abilities.
		return in_array('abilities:read', $principal['scopes'], true)
			&& ($this->isExposed === null || ($this->isExposed)($entry['id'], $entry['namespace']) === true)
			&& ($entry['permission'])($principal['user_id']) === true;
	}
}

/**
 * Hands plugins a registry view that only accepts abilities in their own namespace.
 */
class AbilitiesRegistrar {
	/**
	 * Create a namespace-scoped registrar wrapper.
	 *
	 * @param AbilitiesRegistry $registry  Target registry instance.
	 * @param string            $namespace Owning plugin namespace prefix.
	 */
	public function __construct(private AbilitiesRegistry $registry, private string $namespace) {
	}

	/**
	 * Register an ability whose identifier starts with this plugin's namespace.
	 *
	 * @param string               $id         Ability identifier.
	 * @param array<string, mixed> $definition Ability definition array.
	 * @return void
	 */
	public function register(string $id, array $definition) : void {
		if (!str_starts_with($id, $this->namespace . '-')) {
			throw new LogicException('Ability IDs must start with the plugin namespace');
		}
		$this->registry->register($id, $definition, $this->namespace);
	}

	/**
	 * Register a category on the underlying ability registry.
	 *
	 * @param string $id    Lowercase category slug.
	 * @param string $label Human-readable category label.
	 * @return void
	 */
	public function registerCategory(string $id, string $label) : void {
		$this->registry->registerCategory($id, $label);
	}
}

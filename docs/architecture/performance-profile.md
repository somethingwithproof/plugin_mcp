<!--
SPDX-FileCopyrightText: 2026 Thomas Vincent
SPDX-License-Identifier: GPL-2.0-or-later
-->

# Performance Profile and Algorithmic Audit

This document records the measured performance profile of `plugin_mcp` hot paths, the algorithmic, regex, and memory bottlenecks found during review, and the measured before/after results.

## Methodology

All timings were collected with PHP 8.4.25 CLI using `hrtime(true)` and `memory_get_peak_usage(true)` at large scale:

- AIP-160 filter compilation (`mcp_filter_sql`) across 25,000 multi-clause filter expressions (strings, escaped quotes, booleans, enums, and resource references).
- Capability-guard post-execution enforcement (`mcp_capability_guard_after_execute`) and provenance manifest extraction (`mcp_capability_provenance_manifest`) on a 10,000-row device payload (100,000 string fields including 2% adversarial prompt-injection and ANSI/bidi inputs).
- Per-value untrusted tagging (`mcp_capability_tag_untrusted_value`) across 10,000 SNMP `sysDescr` strings.
- Ability registry lookup (`AbilitiesRegistry::get`) across 25,000 calls and schema output validation (`abilities_validate`) across 10,000 device rows (100 batches of 100 rows).
- Cacti log tailing and secret redaction (`mcp_read_clog_tail`) on a 1 MiB / 8,537-line log file across three query modes: default 50-line tail (`ALL`), filtered 200-line `ERROR` tail, and worst-case full-window search miss (3 iterations each).

## Bottlenecks Found and Fixed

### 1. Forward Full-Window Redaction in `cacti-get-clog` (`lib/providers.php`)

- **Before**: `mcp_read_clog_tail()` split the entire 1 MiB tail with `preg_split()`, iterated forward from the oldest line, and executed `mcp_redact_log_line()` (18 separate regexes, rebuilding the pattern array per line) on all ~8,500 lines before discarding everything except the final 50-200 matches with `array_slice()`.
- **Fix**: Split with `explode("\n", ...)` and scan backwards from the newest line, stopping as soon as `$limit` matching lines plus one lookahead match (to preserve exact `truncated` semantics) are found. Redaction still executes strictly before severity/search matching so search cannot act as a secret oracle. Hoisted `mcp_redact_log_line()` patterns into static caches and added semantically equivalent literal prechecks (`cmcp_pat_`, `bearer`/`basic`, unprefixed secret keyword check, delimiter/quote guards, and `://`) so clean lines skip all secret replacement regexes.

### 2. Multi-Pass Regexes, Linear Scans, and Duplicate Work in Capability Guard (`lib/capability_guard.php`)

- **Before**:
  - `mcp_capability_strip_unsafe_chars()` and `mcp_capability_neutralize_prompt_markers()` ran 11 separate PCRE calls on every string, including clean printable ASCII.
  - `mcp_capability_tag_untrusted_value()` sanitized the same string twice by calling `mcp_capability_sanitize_untrusted_string()` after already computing `$cleaned`.
  - `mcp_capability_guard_after_execute()` traversed the entire result tree twice (once in `mcp_capability_assert_no_control_escalation()`, then again in `mcp_capability_sanitize_payload()`).
  - Key classification used linear `in_array()` scans over 20-26 element constant arrays on every field.
  - `mcp_capability_provenance_manifest()` appended duplicate field paths for every row (~100,000 strings on 10k rows) before calling `array_unique()`, causing a 9 MiB peak memory spike.
- **Fix**:
  - Added an `O(N)` `strspn()` printable-ASCII fast path in `mcp_capability_strip_unsafe_chars()` and a literal precheck plus single combined regex in `mcp_capability_neutralize_prompt_markers()`.
  - Removed double sanitization in `mcp_capability_tag_untrusted_value()` and short-circuited UTF-8 length counting when `strlen($cleaned) <= $maxLength`.
  - Replaced linear `in_array()` lookups with `O(1)` hash-map constants (`MCP_CAPABILITY_*_SET`).
  - Unified post-execution escalation checking, depth capping, and string sanitization into a single recursive traversal (`mcp_capability_guard_sanitize_tree()`).
  - Deduplicated untrusted field paths in-place via an associative set (`mcp_capability_collect_untrusted_field_set()`), reducing manifest memory from `O(N * F)` to `O(F)`.

### 3. AIP-160 Quoted-String Backtracking and Missing DoS Bounds (`lib/aip.php`)

- **Before**: `mcp_filter_sql()` had no internal length or clause-count cap for direct callers, used a backtracking alternation `"(?:[^"\\]|\\.)*"` for quoted literals, and compiled a dynamic regex per reference filter value in `mcp_filter_value()`.
- **Fix**: Added explicit bounds (`MCP_FILTER_MAX_LENGTH = 4096`, `MCP_FILTER_MAX_CLAUSES = 32`, `MCP_ORDER_MAX_LENGTH = 256`, `MCP_ORDER_MAX_FIELDS = 8`), replaced the quoted-literal regex with a possessive unrolled loop `"[^"\\]*+(?:\\.[^"\\]*+)*+"` (linear time with zero backtracking frames even on unclosed quotes), and replaced per-call integer/reference regexes with `str_starts_with()` + `ctype_digit()`.

### 4. Per-String `preg_match_all('/./us')` in Schema Validation (`lib/registry.php`)

- **Before**: `abilities_validate()` counted UTF-8 characters with `preg_match_all('/./us', $value)` on every string in both input arguments and output validation.
- **Fix**: Validate UTF-8 with `mb_check_encoding()` and skip full code-point counting when `minLength === 0` and `strlen($value) <= $maxLength` (falling back to `mb_strlen()` or `preg_match_all()` when needed).

## Measured Results (PHP 8.4.25)

| Hot Path | Workload | Before (ms) | After (ms) | Speedup | Peak Memory Change |
| --- | --- | ---: | ---: | ---: | --- |
| `mcp_filter_sql()` | 25,000 multi-clause filters | 75.30 ms | 53.07 ms | 1.4x | 14.00 MiB -> 14.00 MiB |
| `mcp_capability_guard_after_execute()` | 10,000 rows (100k strings) | 141.29 ms | 35.49 ms | 4.0x | 22.00 MiB -> 22.00 MiB |
| `mcp_capability_provenance_manifest()` | 10,000 rows | 20.57 ms | 11.25 ms | 1.8x | 31.02 MiB -> 22.00 MiB (-9.02 MiB) |
| `mcp_capability_tag_untrusted_value()` | 10,000 `sysDescr` strings | 35.88 ms | 13.25 ms | 2.7x | 31.02 MiB -> 24.00 MiB (-7.02 MiB) |
| `AbilitiesRegistry::get()` | 25,000 lookups | 16.57 ms | 14.29 ms | 1.2x | 31.02 MiB -> 24.00 MiB |
| `abilities_validate()` | 10,000 device rows (100x100) | 68.32 ms | 49.65 ms | 1.4x | 31.02 MiB -> 24.00 MiB |
| `mcp_read_clog_tail()` (default tail) | 1 MiB / 8,537 lines, limit=50 (3 iters) | 559.79 ms/iter | 0.81 ms/iter | 690.2x | 32.00 MiB -> 28.00 MiB (-4.00 MiB) |
| `mcp_read_clog_tail()` (ERROR filter) | 1 MiB / 8,537 lines, limit=200 (3 iters) | 499.86 ms/iter | 30.92 ms/iter | 16.2x | 32.00 MiB -> 28.00 MiB (-4.00 MiB) |
| `mcp_read_clog_tail()` (search miss) | 1 MiB / 8,537 lines, full scan (3 iters) | 464.44 ms/iter | 60.93 ms/iter | 7.6x | 32.00 MiB -> 28.00 MiB (-4.00 MiB) |

## Telemetry Overhead

Self-graphing script-server telemetry (`scripts/ss_mcp_stats.php`) emits `abilities_total`, `abilities_enabled`, `active_tokens`, `audit_events_24h`, and `capability_blocks` using three single-row `COUNT(*)` prepared queries and in-memory exposure counting. Missing tables or query failures emit RRDtool unknown (`U`) rather than `0`.

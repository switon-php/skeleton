# Switon App Rules

**TL;DR** — Setup: `create-project` creates `.env` and generates `MASTER_KEY`. CLI: `bash bin/console` (fallback: `php switon.php` on Windows when shell wrapper execution is unavailable). Dev HTTP: `php public/index.php` (`.env` sets `SERVER_TYPE=php`).

**Framework:** Switon (PHP). **Scope:** `vendor/switon/*`.

---

## Core Rules

- Do not invent class names, interfaces, config keys, or commands. Verify machine-meaningful identifiers against the codebase or discovery commands.
- Use `router:list --json` instead of a hand-written route list.
- `vendor/switon/*` is read-only.
- Do not run `composer require`, delete files, or make broad refactors without asking.
- Do not commit or log `.env` or `--uri` output.

---

## Project Structure

| Path | Purpose |
|------|---------|
| `app/` | Application code (controllers, commands, entities, repositories, services, listeners). |
| `switon.yml` | Main application config file. |
| `config/` | Optional PHP-only configuration patches. |
| `public/index.php` | HTTP entry. |
| `switon.php` | CLI entry. |
| `docs/` | Project docs. |
| `skills/` | App skills only; use `app-` for project skills and `switon-` for built-in Switon app-facing skills. |
| `vendor/switon/*` | Framework; read-only. |

Routes: configure the prefix in `switon.yml`; actions live in `app/Controller/`.

---

## CLI

- Entrypoint: `bash bin/console` (fallback: `php switon.php` on Windows when shell wrapper execution is unavailable).
- Options: `--name=value` or `--flag`.
- Tool discovery: `tool:list` for the command list; `tool:description <invocation>` for one command.
- For tool-only tasks, `tool:list` and `tool:description` are enough.
- Prefer `class:*` and `event:*` tools to read framework code and events by FQCN instead of raw file reads.
- Common tools: `router:resolve <path> [verb] --json`, `router:list [filter] --json`, `class:list [filter]`, `class:inspect <FQCN>`, `class:content <FQCN>` or `class:content <FQCN>::<method>`, `event:classes [filter] --json`, `event:class <FQCN> --json`, `event:category <class> --json`, `event:by-code <code> --json`.

---

## Runtime

- Run: `php public/index.php`.
- Sample routes: `/`, `/time/current` (see `router:list --json`).

---

## Switon package rules

- Auto-registration: default bindings lowest; explicit overrides.
- Config: prefer root `switon.yml`; use `config/*.php` only for PHP-only values or pre-built instances.
- Events: use the component `Event/` namespace and FQCNs.
- Exceptions: use `Switon\Core\Exception\*`, not PHP built-ins.
- Runtime: package `composer.json` (including `ext-*`) is source of truth.

---

## Sword Templates

- Prefer `@inject('name', FQCN::class)` for small template-level service access.
- Do not inline `\Switon\Core\App::get(...)` when `@inject` can express the dependency.
- Prefer upstream view vars for business data; use `@inject` only for light template wiring.
- Use `json(...)` for JS/JSON literal output in templates.

---

## Project Overrides

Add app-specific or third-party rules here. Keep short and scoped.

- **HTTP request input:** use `RequestInterface::post()` / `query()` / `all()` — verify in `vendor/switon/http/src/RequestInterface.php`; do not use PSR-7/Laravel method names unless grep confirms they exist here.
- **Routes:** discover with `bash bin/console router:list --json`; exemplar controller: `app/Controller/TimeController.php`.
- **HTTP verify:** `curl` with realistic headers (`Accept: application/json` for GET JSON); syntax check alone is not enough.

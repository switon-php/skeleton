# Switon App Rules

**TL;DR** — CLI: `bash bin/console` (fallback: `php switon.php` on Windows when shell wrapper execution is unavailable).
Dev: `SERVER_TYPE=php php public/index.php` (optional `SERVER_PORT=…`). Package integration rules: see
`Switon package rules` below.

**Framework:** Switon (PHP). **Scope (downstream apps):** `vendor/switon/*`. App-specific: "Project overrides" below.

This file is primarily for downstream application repositories generated from the skeleton. When maintaining
`packages/skeleton` inside the Switon monorepo, follow the repo-root `AGENTS.md` and standards first.

---

## Framework Identity & Anti-hallucination

Switon is a standalone application framework on par with Laravel and Symfony. While general programming concepts (like
DI, MVC, Event Dispatching) apply, the implementation is entirely Switon's own. Do NOT invent or borrow specific class
names, interfaces, variables, or exact implementations from other frameworks. Every machine-meaningful identifier MUST
belong to Switon and MUST be verified against the codebase or discovery commands (like `class:inspect`).

---

## Project structure

| Path               | Purpose                                                                                                                                                                                                                                                                                                                                                                                                                                   |
|--------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `app/`             | Application code (Controllers, Commands, Entities, Repositories, Services, Listeners, etc.).                                                                                                                                                                                                                                                                                                                                              |
| `config/`          | App and component configuration (e.g. `app.php`, `router.php`, `server.php`, `db.php`).                                                                                                                                                                                                                                                                                                                                                   |
| `public/index.php` | HTTP entry.                                                                                                                                                                                                                                                                                                                                                                                                                               |
| `switon.php`       | CLI entry (see CLI section).                                                                                                                                                                                                                                                                                                                                                                                                              |
| `docs/`            | Project docs; package list: `packages:official`.                                                                                                                                                                                                                                                                                                                                                                                          |
| `skills/`          | App skills only: one folder per skill, `SKILL.md` inside; name prefix `app-`. Built-in Switon app-facing skills: `vendor/switon/beacon/skills/` (prefix `switon-`). Framework-development skills for working on the Switon monorepo live in that repository root `skills/` (prefix `sps-`) and are not part of normal app installs. Add app skills via `vendor/switon/beacon/skills/switon-meta-skill/SKILL.md` or install switon/beacon. |
| `vendor/switon/*`  | Framework; read-only, do not edit.                                                                                                                                                                                                                                                                                                                                                                                                        |

Routes: prefix in `config/router.php`, actions in `app/Controller/`. List: `router:list --json` (see CLI).

---

## CLI (for AI / scripts)

**Entrypoint:** `bash bin/console` (fallback: `php switon.php` on Windows when shell wrapper execution is unavailable).
Options `--name=value` or `--flag`. Exit 0 = success.

**Tool discovery**

- Run `tool:list` for the tool list (JSON: invocation => doc). `tool:commands` = all commands;
  `tool:description <invocation>` = one command's details.
- **Using tools from tool:list does not require loading this file.** For tool-only tasks, `tool:list` and
  `tool:description` are enough; skip AGENTS.md to save token.
- Use `--json` for machine output. **Filter** (e.g. class:list, event:classes): substring or wildcards `*` `?`.
- Prefer `class:*` and `event:*` tools to read PHP framework code and events (by FQCN) instead of raw file reads; this
  is more precise and saves token.

**Common tools** (see `tool:list` for full doc)

- **Router:** `router:resolve <path> [verb] --json`, `router:list [filter] --json`
- **Class:** `class:list [filter]`, `class:inspect <FQCN>`, `class:content <FQCN>` or `class:content <FQCN>::<method>` (
  `--no-phpdoc` optional)
- **Event:** `event:classes [filter] --json`, `event:class <FQCN> --json`, `event:category <class> --json`,
  `event:by-code <code> --json`

**Run (dev):** `SERVER_TYPE=php php public/index.php`. **Tests:** `tests/run.sh` or composer script.

---

## Request lifecycle (HTTP)

Event-driven pipeline (reference: .NET MVC-style request lifecycle).

**Order:** `RequestReceived` → `RequestBegin` → `RequestAuthenticating`/`RequestAuthenticated` → `RequestRouting`/
`RequestRouted` → `RequestAuthorizing`/`RequestAuthorized` → `RequestValidating`/`RequestValidated` → `RequestReady` →
`RequestInvoking`/`RequestInvoked` → `RequestRendering`/`RequestRendered` → `ResponseStringify` → `HeadersSending`/
`HeadersSent` → `BodySending`/`BodySent` → `RequestEnd`.

**Short-circuit:** Set the response (e.g. status, body), then throw `Switon\Core\StopFlow` in a listener to terminate
early; that response is sent.

**Exception:** On exception (except StopFlow), handler sets error response, `RequestFailed` is dispatched, then response
is sent.

---

## Skills

- **App skills:** Project `skills/` at repo root.
- **Built-in Switon skills:** `vendor/switon/beacon/skills/` (app-facing). Update via `composer update switon/beacon`.
- **Framework-development skills:** live only in the Switon monorepo root `skills/`; they are not part of normal app
  installs.
- **Disable:** Do not load or apply these skills. Add skill names below (e.g. `switon-entity`); omit if none.
    - (none)

---

## Switon package rules

Use these rules in application projects that consume Switon packages. They do not define framework or component
implementation standards.

- **Auto-registration:** Default bindings lowest; explicit overrides.
- **Config:** Keys → `#[Autowired]` properties; file = interface name without `Interface`, lowercased (e.g.
  `DbInterface` → `config/db.php`).
- **Events:** Component `Event/` namespace; use FQCNs.
- **Exceptions:** `Switon\Core\Exception\*`, not PHP built-ins.
- **Runtime:** Package `composer.json` (incl. `ext-*`) is source of truth.

## Sword template conventions

- In `.sword` templates, prefer `@inject('name', FQCN::class)` for small template-level service access.
- Do not inline `\Switon\Core\App::get(...)` in `.sword` templates when `@inject` can express the dependency.
- Prefer upstream view vars for business data; use `@inject` only for light template wiring.
- Use `json(...)` for JS/JSON literal output in templates; do not hand-wrap dynamic values with quotes.

---

## Don't

- Maintain a hand-written route list; use `router:list --json`.
- Edit `vendor/` (read-only).
- Run `composer require`, delete files, or broad refactors without asking.
- Commit or log `.env` or `--uri` output (credentials).

---

## Project overrides (app + third-party)

Add app-specific or third-party rules here. Keep short and scoped.

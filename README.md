# Switon App Starter

Official starter for a new Switon application.

## Installation

```bash
composer create-project switon/skeleton my-app
cd my-app
```

## Run

```bash
php public/index.php
```

`create-project` creates `.env` from `.env.example` and generates `MASTER_KEY`. `.env` defaults `SERVER_TYPE=php` for the built-in PHP server.

Then open:

- `http://127.0.0.1:9501/` — welcome JSON
- `http://127.0.0.1:9501/time/current` — sample route

## CLI

```bash
bash bin/console tool:list
bash bin/console router:list --json
```

On Windows when shell wrapper execution is unavailable, use `php switon.php` instead of `bash bin/console`.

## Start Here

- `switon.yml` defines app metadata, route prefixes, server options, and default filters.
- `app/Controller/` contains the example controllers.
- add `config/*.php` only when you need PHP-only configuration patches.
- `public/index.php` is the HTTP entrypoint.

Docs: https://github.com/switon-php/kernel/blob/main/docs/README.md

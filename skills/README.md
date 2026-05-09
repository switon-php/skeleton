# App skills

This directory is for **app-specific skills** only.

- Use the **`app-`** prefix for the folder and frontmatter `name` (for example `app-invoice`).
- Built-in Switon app-facing skills use the **`switon-`** prefix and come from `switon/beacon`.
- Monorepo-only framework-development skills use the **`sps-`** prefix and are not part of normal app installs.

## Install built-in skills

```bash
composer require switon/beacon --dev
# or
composer update switon/beacon
```

## Rule of thumb

Create `app-*` skills when the knowledge, workflow, or commands are specific to your project or domain. Use built-in
`switon-*` skills when the task is about framework conventions, diagnostics, or generic app-integration capabilities.

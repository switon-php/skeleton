<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$envExample = $root . '/.env.example';
$envFile = $root . '/.env';

if (file_exists($envFile)) {
    return;
}

$template = file_get_contents($envExample);
if ($template === false) {
    throw new RuntimeException('Unable to read .env.example.');
}

if (file_put_contents($envFile, $template) === false) {
    throw new RuntimeException('Unable to create .env from .env.example.');
}

$env = file_get_contents($envFile);
if ($env === false) {
    throw new RuntimeException('Unable to read .env.');
}

if (preg_match('/^MASTER_KEY=\s*$/m', $env) !== 1) {
    return;
}

$key = bin2hex(random_bytes(32));
$updated = preg_replace('/^MASTER_KEY=\s*$/m', 'MASTER_KEY=' . $key, $env, 1);

if (!is_string($updated) || file_put_contents($envFile, $updated) === false) {
    throw new RuntimeException('Unable to write MASTER_KEY to .env.');
}

<?php
declare(strict_types=1);

return [
    'Switon\Core\AppInterface' => [
        'id' => 'skeleton',
        'name' => 'Switon',
        'env' => env('APP_ENV', 'dev'),
        'debug' => env('APP_DEBUG', true),
        'timezone' => 'Asia/Shanghai',
        'version' => 'v0.1',
    ],
];

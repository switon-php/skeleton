<?php
declare(strict_types=1);

return [
    'Switon\Http\ServerOptions' => [
        'type' => env('SERVER_TYPE', 'auto'),
        'port' => (int)env('SERVER_PORT', 9501),
        'settings' => [
            'enable_static_handler' => env('APP_DEBUG', true),
        ],
    ],
];

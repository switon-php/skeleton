<?php
declare(strict_types=1);

use Switon\Http\Filter\CorsFilter;

return [
    'Switon\Http\RequestHandlerInterface' => [
        'filters' => [
            'cors' => CorsFilter::class,
            'accessLog' => null,
        ],
    ],
];

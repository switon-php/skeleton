<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Server clock for HTTP and MCP endpoints.
 */
class TimeService
{
    public function now(): array
    {
        return ['time' => date('c')];
    }
}

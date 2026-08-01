<?php

declare(strict_types=1);

namespace App\Mcp\Tool;

use App\Services\TimeService;
use Switon\Core\Attribute\Autowired;
use Switon\Mcp\AbstractTool;
use Switon\Mcp\ToolSchema;

/**
 * MCP tool: current server time as ISO 8601.
 */
class NowTool extends AbstractTool
{
    #[Autowired] protected TimeService $time;

    public function schema(string $name): ToolSchema
    {
        return $this->schema ??= new ToolSchema(description: 'Return current server time as ISO 8601');
    }

    public function call(string $name, array $arguments): mixed
    {
        return $this->time->now();
    }
}

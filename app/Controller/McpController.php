<?php

declare(strict_types=1);

namespace App\Controller;

use Switon\Authorizing\Attribute\Authorize;
use Switon\Core\Attribute\Autowired;
use Switon\Http\ResponseInterface;
use Switon\Mcp\HttpServerInterface;
use Switon\Routing\Attribute\DeleteMapping;
use Switon\Routing\Attribute\PostMapping;
use Switon\Routing\Attribute\RequestMapping;

#[Authorize(Authorize::ANONYMOUS)]
#[RequestMapping('/mcp')]
class McpController extends Controller
{
    #[Autowired] protected HttpServerInterface $httpServer;

    #[PostMapping('')]
    public function indexAction(): ResponseInterface
    {
        return $this->httpServer->handle();
    }

    #[DeleteMapping('')]
    public function deleteAction(): ResponseInterface
    {
        return $this->httpServer->terminate();
    }
}

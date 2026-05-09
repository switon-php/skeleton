<?php

declare(strict_types=1);

namespace App\Controller;

use Switon\Authorizing\Attribute\Authorize;
use Switon\Routing\Attribute\GetMapping;
use Switon\Routing\Attribute\RequestMapping;

#[Authorize(Authorize::ANONYMOUS)]
#[RequestMapping('')]
class IndexController extends Controller
{
    #[GetMapping('/')]
    public function indexAction(): array
    {
        return ['message' => 'Welcome to Switon'];
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use Switon\Authorizing\Attribute\Authorize;
use Switon\Routing\Attribute\GetMapping;
use Switon\Routing\Attribute\RequestMapping;

#[Authorize(Authorize::ANONYMOUS)]
#[RequestMapping('/time')]
class TimeController extends Controller
{
    #[GetMapping('current')]
    public function currentAction(): array
    {
        return ['time' => date('c')];
    }
}

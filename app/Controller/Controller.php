<?php

declare(strict_types=1);

namespace App\Controller;

use Switon\Core\Attribute\Autowired;
use Switon\Http\RequestInterface;
use Switon\Http\ResponseInterface;
use Switon\Principal\IdentityInterface;

class Controller extends \Switon\Http\Controller
{
    #[Autowired] protected RequestInterface $request;
    #[Autowired] protected ResponseInterface $response;
    #[Autowired] protected IdentityInterface $identity;
}

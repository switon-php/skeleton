<?php

declare(strict_types=1);

namespace App\Controller;

use Switon\Core\Attribute\Autowired;
use Switon\Principal\IdentityInterface;
use Switon\Http\RequestInterface;
use Switon\Http\ResponseInterface;

class Controller extends \Switon\Http\Controller
{
    #[Autowired] protected RequestInterface $request;
    #[Autowired] protected ResponseInterface $response;
    #[Autowired] protected IdentityInterface $identity;
}

<?php

namespace App\Form\RequestHandler;

use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\Form\Util\ServerParams;

abstract class AbstractRequestHandler extends HttpFoundationRequestHandler
{
    protected bool $clearMissing;

    public function __construct(ServerParams $serverParams = null, bool $clearMissing = false)
    {
        parent::__construct($serverParams);

        $this->clearMissing = $clearMissing;
    }
}

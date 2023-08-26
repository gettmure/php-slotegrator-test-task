<?php

namespace App\Form\RequestHandler;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Util\ServerParams;
use Symfony\Component\HttpFoundation\Request;

class JsonContentRequestHandler extends AbstractRequestHandler
{
    public function handleRequest(FormInterface $form, mixed $request = null): void
    {
        if (!$request instanceof Request) {
            throw new UnexpectedTypeException($request, Request::class);
        }

        $body = json_decode($request->getContent(), true);
        $files = $request->files->all();
        $data = [...$body, ...$files];

        $form->submit($data, $this->clearMissing);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

abstract class BaseController extends AbstractController
{
    protected function ok(SerializerInterface $serializer, mixed $data): JsonResponse {
        return $this->toJsonResponse($serializer, $data, Response::HTTP_OK);
    }

    protected function badRequest(SerializerInterface $serializer, FormErrorIterator $errors): JsonResponse {
        return $this->toJsonResponse($serializer, $errors, Response::HTTP_BAD_REQUEST);
    }

    protected function getFormErrors(FormInterface $form): ?FormErrorIterator {
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $form->getErrors(true);
        }

        return null;
    }

    private function toJsonResponse(SerializerInterface $serializer, mixed $data, int $status = 200): JsonResponse {
        return JsonResponse::fromJsonString(
            $serializer->serialize($data, 'json'),
            $status,
        );
    }
}

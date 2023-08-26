<?php

namespace App\Controller\Product;

use App\Accessor\Product\ProductAccessor;
use App\Controller\BaseController;
use App\DTO\Product\ProductPatchDTO;
use App\Form\Product\ProductPatchType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends BaseController
{
    public function __construct(
        private readonly ProductAccessor $accessor,
        private readonly SerializerInterface $serializer,
    ){}

    #[Route('/products/{id}', name: 'products__get', methods: ['GET'])]
    public function getProduct(int $id): JsonResponse
    {
        $product = $this->accessor->one($id);

        return $this->ok($this->serializer, ['product' => $product]);
    }
    #[Route('/products/list', name: 'products__list', methods: ['GET'])]
    public function getProductList(): JsonResponse
    {
        $products = $this->accessor->list();

        return $this->ok($this->serializer, $products);
    }

    #[Route('/products/upsert', name: 'products__upsert', methods: ['POST'])]
    public function postProductUpsert(Request $request): JsonResponse
    {
        $form = $this->createForm(ProductPatchType::class);
        $form->handleRequest($request);

        $errors = $this->getFormErrors($form);
        if ($errors !== null && $errors->count() > 0) {
            return $this->badRequest($this->serializer, $errors);
        }

        /** @var ProductPatchDTO $patch */
        $patch = $form->getData();
        $product = $this->accessor->upsert($patch);

        return $this->ok($this->serializer, ['product' => $product]);
    }

    #[Route('/products/{id}/delete', name: 'products__delete', methods: ['DELETE'])]
    public function deleteProduct(int $id): JsonResponse
    {
        $this->accessor->delete($id);

        return $this->ok($this->serializer, ['success' => true]);
    }
}

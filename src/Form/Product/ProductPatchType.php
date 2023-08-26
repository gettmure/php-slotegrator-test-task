<?php

namespace App\Form\Product;

use App\DTO\Product\ProductPatchDTO;
use App\Form\RequestHandler\FormDataRequestHandler;
use App\Form\RequestHandler\JsonContentRequestHandler;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductPatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', NumberType::class)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', NumberType::class)
            ->add('bgImage', FileType::class)
        ;

        $builder->setRequestHandler(new FormDataRequestHandler());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductPatchDTO::class,
        ]);
    }
}

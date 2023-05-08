<?php

declare(strict_types=1);

namespace App\Form\Type;


use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('color', TextType::class)

            // ...
        ;
    }


    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}

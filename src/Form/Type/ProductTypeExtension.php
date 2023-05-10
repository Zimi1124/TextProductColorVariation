<?php

declare(strict_types=1);

namespace App\Form\Type;


use App\Entity\Product;
use App\Validator\Constraints\Color;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

final class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('color', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a color.',
                        'groups' => ['sylius'],
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Please enter a valid color (letters only).',
                        'groups' => ['sylius'],
                    ]),
                    new Color([
                        'groups' => ['sylius']
                    ]),
                ],
            ])
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'validation_groups' => ['sylius'],
        ]);
    }


    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}

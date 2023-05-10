<?php

namespace App\Tests\Behat\Context;

use Behat\MinkExtension\Context\MinkContext;
use App\Tests\Behat\Pages\CreateProductPageInterface;
use Behat\Behat\Context\Context;
use Sylius\Component\Product\Repository\ProductRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;



final class ProductContext extends MinkContext implements Context
{
    /**
     * @var CreateProductPageInterface
     */
    private $creteProductPage;

    public function __construct(CreateProductPageInterface $creteProductPage)
    {
        $this->creteProductPage = $creteProductPage;
    }

    /**
     * @When I set color to :color
     */
    public function iSetColorTo($color): void
    {
        $this->creteProductPage->setColor($color);
    }


    /**
     * @Then I should see a validation error for the color field, preventing creation of new product
     */
    public function iShouldSeeAValidationErrorForTheColorField()
    {
        $errorMessage = 'Please enter a valid color (letters only).';
        $this->assertSession()->elementContains('css', '.sylius-validation-error', $errorMessage);
    }





}

<?php

namespace App\Tests\Behat\Context;


use App\Tests\Behat\Pages\CreateProductPageInterface;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

final class ProductContext implements Context
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
     * @Then I should see a validation error for the color field
     */
    public function iShouldSeeAValidationErrorForTheColorField()
    {
        throw new PendingException();
    }

    /**
     * @Then the product should not be created
     */
    public function theProductShouldNotBeCreated()
    {
        throw new PendingException();
    }

}

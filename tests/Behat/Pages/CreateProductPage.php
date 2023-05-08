<?php

namespace App\Tests\Behat\Pages;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

class CreateProductPage extends SymfonyPage implements CreateProductPageInterface
{
    public function getRouteName(): string
    {
        return 'sylius_admin_product_create_simple';
    }

    public function setColor(string $color):void
    {
        $this->getDocument()->fillField("sylius_product_color", $color);
    }

}

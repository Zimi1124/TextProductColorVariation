<?php

namespace App\Tests\Behat\Pages;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;

interface CreateProductPageInterface extends SymfonyPageInterface
{
    public function getRouteName(): string;

    public function setColor(string $color):void;
}

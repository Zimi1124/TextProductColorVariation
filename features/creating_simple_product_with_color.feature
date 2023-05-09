@managing_products_color
Feature: Creating a product with color
    In order to add new option
    As an Administrator
    I want to be able to add product with color

    Background:
        Given the store operates on a single channel in "United States"
        And I am logged in as an administrator

    @ui
    Scenario: Creating a product with color
        Given I want to create a new simple product
        When I specify its code as "DINO_HOODIE"
        And I name it "Dino Hoodie" in "English (United States)"
        And I set its slug to "dino-hoodie" in "English (United States)"
        And I set color to "Green"
        And I set its price to "$66.00" for "United States" channel
        And I set its original price to "$201.00" for "United States" channel
        And I add it
        Then I should be notified that it has been successfully created
        And the product "Dino Hoodie" should appear in the store
    @ui
    Scenario: Creating a product with invalid color
        Given I want to create a new simple product
        When I specify its code as "DINO_HOODIE"
        And I name it "Dino Hoodie" in "English (United States)"
        And I set its slug to "dino-hoodie" in "English (United States)"
        And I set color to "Invalid color"
        And I set its price to "$66.00" for "United States" channel
        And I set its original price to "$201.00" for "United States" channel
        And I add it
        Then I should see a validation error for the color field
        And the product should not be created

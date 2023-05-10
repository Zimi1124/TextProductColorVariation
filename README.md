<p align="center">
    <a href="https://sylius.com" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" />
    </a>
</p>

<h1 align="center">Sylius Standard Edition </h1>
<h2 align="center"> Product Color Extension  </h2>

About
-----

This is a simple Sylius Product Type extension that includes constraints and a Behat testing environment. It enables users to add colors to products through the admin panel and display them on the shop page without a worry about typing mistakes.



Documentation
-------------

Documentation about Sylius installation and how to use it is available at [docs.sylius.com](http://docs.sylius.com).

Internals
------------
Colors are added by Extending BaseProduct and ProductType classes provided by Sylius Standard.

How to use
---------------

To add new colors first add new const representing color to ProductInterface in src/Entity directory

```bash
interface ProductInterface
{
    public const COLOR_RED = 'red';
    public const COLOR_GREEN = 'green';
    public const COLOR_BLUE = 'blue';
    public const COLOR_YELLOW = 'yellow';
    public const COLOR_PURPLE = 'purple';
    
    public const COLOR_NEW ='NewColor';
    
    public function getColor(): ?string;

    public function setColor(?string $color): void;
}
```
Next, depending on whether we use the Color constraint(if not you can skip this step), we need to add a new field to the $allowedColors array in the ColorValidator located in src/Validator/Constraints.
```bash
    class ColorValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Color) {
            throw new UnexpectedTypeException($constraint, Color::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $allowedColors = [
            ProductInterface::COLOR_RED,
            ProductInterface::COLOR_GREEN,
            ProductInterface::COLOR_BLUE,
            ProductInterface::COLOR_YELLOW,
            ProductInterface::COLOR_PURPLE,
            
            ProductInterface::COLOR_NEW,
            
        ];

        if (!in_array(strtolower($value), $allowedColors, true)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
```
[List of all available colors could be found here.](https://www.w3schools.com/colors/colors_names.asp)

then clear cache for good measure, and you're good to go.

Constraints
---------------
The code uses 3 types of constraints to assure that we don't push something strange to our product page. 
The use cases of the constraints are described above them in the provided code. If a constraint is not needed, you can simply delete one or more that you don't need. However, if you would like to add or modify them, refer to the documentation at [https://symfony.com/doc/current/reference/constraints.html](https://symfony.com/doc/current/reference/constraints.html), but remember to always add 'groups' => ['sylius'] to ensure your new constraint will work

```bash
$builder
            // ...
            ->add('color', TextType::class, [
                'constraints' => [
                    #Checks whether a value is not blank
                    new NotBlank([
                        'message' => 'Please enter a color.',
                        'groups' => ['sylius'],
                    ]),
                    #Verifies if the input consists solely of letters.
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Please enter a valid color (letters only).',
                        'groups' => ['sylius'],
                    ]),
                    #Verifies if the provided value corresponds to one of our available colors.
                    new Color([
                        'groups' => ['sylius']
                    ]),
                ],
            ])
            // ...
        ;
    }
```
Color in the Product Shop Page 
---------------
If you do not want to display the colored letters indicating the product's color on the shop page, you can delete the line that says 'style="color: {{ product.color }}"' in the file at App/templates/bundles/SyliusShopBundle/Product/Show/_addToCart.html.twig. Here's some code to find it easier 
```bash
{
    {{ form_row(form.cartItem.quantity, sylius_test_form_attribute('quantity')) }}
    {% if product.color != null %}
        <div class="">
            <div class="">
                <h2> Color of the product:  <span style="color: {{ product.color }}">{{ product.color }}</u></span></h2>
            </div>  

```
Testing
------------

The application has been tested to ensure that the functionality related to colors works as expected.All the test code is in App/features and App/tests directories.

Bug Tracking
------------

If you want to report a bug or suggest an idea,  [please contact me](https://github.com/Zimi1124).

MIT License
-----------

Sylius is completely free and released under the [MIT License](https://github.com/Sylius/Sylius/blob/master/LICENSE).

Authors
-------
This Product Color Extension was created by [Szymon Stefaniak]((https://github.com/Zimi1124))


Sylius was originally created by [Paweł Jędrzejewski](http://pjedrzejewski.com). See the list
of [contributors from our awesome community](https://github.com/Sylius/Sylius/contributors).
.

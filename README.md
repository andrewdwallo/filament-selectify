# Filament Selectify

A small package featuring two simple components that serve as excellent alternatives to toggles, radio buttons, and other selectors. These components not only offer seamless user interactions but also maintain UI consistency by effortlessly aligning with neighboring fields and components.

![ButtonGroup2](https://github.com/andrewdwallo/filament-selectify/assets/104294090/053194af-cc0f-471d-ab0d-c4b6753c49ae)
![ToggleButton](https://github.com/andrewdwallo/filament-selectify/assets/104294090/08f7439c-c20d-4d1b-b105-a71d08cc5c94)

<p align="center">
    <a href="https://filamentadmin.com/docs/2.x/admin/installation">
        <img alt="FILAMENT 8.x" src="https://img.shields.io/badge/FILAMENT-2.x-EBB304?style=for-the-badge">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-selectify">
        <img alt="Packagist" src="https://img.shields.io/packagist/v/andrewdwallo/filament-selectify.svg?style=for-the-badge&logo=packagist">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-selectify">
        <img alt="Downloads" src="https://img.shields.io/packagist/dt/andrewdwallo/filament-selectify?color=red&style=for-the-badge" >
    </a>
</p>

## Installation

You can install the package via composer:

```bash
composer require andrewdwallo/filament-selectify
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-selectify-views"
```

## Registering Styles

In order for component styles to be processed, you must add this package's vendor directory into the content array of your `tailwind.config.js` file:
```php
export default {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/andrewdwallo/filament-selectify/resources/views/**/*.blade.php', // The package's vendor directory
    ],
    // ...
}
```

## Usage


### ToggleButton

The ToggleButton has the following options. The `onLabel()` and `offLabel()` represent the true and false states. You may also customize the color representing each state using `onColor()` and `offColor()`.

```php
ToggleButton::make('enabled')
    ->offColor('danger')
    ->onColor('primary')
    ->offLabel('No')
    ->onLabel('Yes')
    ->default(true),
```

![Screenshot 2023-06-30 225445](https://github.com/andrewdwallo/filament-selectify/assets/104294090/dc934b61-ecb4-485e-a4d8-9e46ba357d55)


### ButtonGroup

The ButtonGroup has the following options. You may customize the color representing each state. The `onColor()` represents the button or value that is selected and the `offColor()` represents the button or value that is not selected. You may use `gridDirection()` to change the layout of the buttons. The options are `column` and `row`. The default is `column`.
You may optionally add icons for the buttons using `icons()` and supplying an array that contains the option values as keys and icon names as values. Icon position and size can be changed using `iconPosition()` (default: before) and `iconSize()` (default: Small).

```php
ButtonGroup::make('entity')
    ->options([
        'individual' => 'Individual',
        'company' => 'Company',
    ])
    ->onColor('primary')
    ->offColor('gray')
    ->gridDirection('row')
    ->default('individual')
    ->icons([
        'individual' => 'heroicon-m-user',
        'company' => 'heroicon-m-building-office', 
    ])
    ->iconPosition(\Filament\Support\Enums\IconPosition::After)
    ->iconSize(Filament\Support\Enums\IconSize::Medium),
```

![Screenshot 2023-06-30 224052](https://github.com/andrewdwallo/filament-selectify/assets/104294090/b04bf9ce-197a-4ea1-aa75-4fefa07c7f77)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Andrew Wallo](https://github.com/andrewdwallo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

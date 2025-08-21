<?php

use Wallo\FilamentSelectify\Components\ButtonGroup;
use Wallo\FilamentSelectify\Components\ToggleButton;

it('button group component can be instantiated', function () {
    $component = ButtonGroup::make('test')
        ->options(['yes' => 'Yes', 'no' => 'No'])
        ->onColor('primary')
        ->offColor('gray');

    expect($component)->toBeInstanceOf(ButtonGroup::class);
    expect($component->getOptions())->toBe(['yes' => 'Yes', 'no' => 'No']);
});

it('toggle button component can be instantiated', function () {
    $component = ToggleButton::make('active')
        ->onLabel('Enabled')
        ->offLabel('Disabled')
        ->onColor('success')
        ->offColor('danger');

    expect($component)->toBeInstanceOf(ToggleButton::class);
    expect($component->getOnLabel())->toBe('Enabled');
    expect($component->getOffLabel())->toBe('Disabled');
});

it('button group boolean method works', function () {
    $component = ButtonGroup::make('test')->boolean('Active', 'Inactive');

    expect($component->getOptions())->toBe([true => 'Active', false => 'Inactive']);
});

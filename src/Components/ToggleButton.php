<?php

namespace Wallo\FilamentSelectify\Components;

use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;
use Wallo\FilamentSelectify\Components\Concerns\HasToggleLabels;

class ToggleButton extends Field
{
    use Concerns\CanBeAccepted;
    use Concerns\HasToggleColors;
    use HasExtraAlpineAttributes;
    use HasToggleLabels;

    protected string $view = 'filament-selectify::components.toggle-button';

    protected function setUp(): void
    {
        $this->default(false);

        $this->afterStateHydrated(static function (self $component, $state): void {
            $component->state((bool) $state);
        });

        $this->rule('boolean');
    }
}

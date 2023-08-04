<?php

namespace Wallo\FilamentSelectify\Components;

use Closure;
use Filament\Forms\Components\Concerns\HasGridDirection;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Concerns\HasToggleColors;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;

class ButtonGroup extends Field
{
    use HasOptions;
    use HasToggleColors;
    use HasGridDirection;
    use HasExtraAlpineAttributes;

    protected string $view = 'filament-selectify::components.button-group';

    protected bool | Closure | null $isOptionDisabled = null;

    public function boolean(string | null $trueLabel = null, string | null $falseLabel = null): static
    {
        $this->options([
            true => $trueLabel ?? 'Yes',
            false => $falseLabel ?? 'No',
        ]);

        return $this;
    }

    public function default(mixed $state): static
    {
        return parent::default((string)$state);
    }

    public function disableOptionWhen(bool | Closure $callback): static
    {
        $this->isOptionDisabled = $callback;

        return $this;
    }

    public function isOptionDisabled($value, string $label): bool
    {
        if ($this->isOptionDisabled === null) {
            return false;
        }

        return (bool) $this->evaluate($this->isOptionDisabled, compact('label', 'value'));
    }
}

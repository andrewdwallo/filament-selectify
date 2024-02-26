<?php

namespace Wallo\FilamentSelectify\Components;

use Closure;
use Filament\Forms\Components\Concerns\HasGridDirection;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Concerns\HasToggleColors;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\IconSize;

class ButtonGroup extends Field
{
    use HasExtraAlpineAttributes;
    use HasGridDirection;
    use HasOptions;
    use HasToggleColors;

    protected string $view = 'filament-selectify::components.button-group';

    protected bool | Closure | null $isOptionDisabled = null;

    protected array | Closure $icons = [];

    protected IconPosition | string | Closure | null $iconPosition = null;

    protected IconSize | string | Closure | null $iconSize = null;

    public function boolean(?string $trueLabel = null, ?string $falseLabel = null): static
    {
        $this->options([
            true => $trueLabel ?? 'Yes',
            false => $falseLabel ?? 'No',
        ]);

        return $this;
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

    public function icons(array | Closure $icons): static
    {
        $this->icons = $icons;

        return $this;
    }

    public function getIcons(): array
    {
        return (array) $this->evaluate($this->icons);
    }

    public function iconPosition(IconPosition | string | Closure | null $position): static
    {
        $this->iconPosition = $position;

        return $this;
    }

    public function iconSize(IconSize | string | Closure | null $size): static
    {
        $this->iconSize = $size;

        return $this;
    }

    public function getIconPosition(): IconPosition | string
    {
        return $this->evaluate($this->iconPosition) ?? IconPosition::Before;
    }

    public function getIconSize(): IconSize | string | null
    {
        return $this->evaluate($this->iconSize) ?? IconSize::Small;
    }
}

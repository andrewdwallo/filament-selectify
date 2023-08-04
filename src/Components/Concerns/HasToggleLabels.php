<?php

namespace Wallo\FilamentSelectify\Components\Concerns;

use Closure;
use Illuminate\Contracts\Support\Htmlable;

trait HasToggleLabels
{
    /**
     * Label for the 'off' state.
     */
    protected string | Htmlable | Closure | null $offLabel = 'No';

    /**
     * Label for the 'on' state.
     */
    protected string | Htmlable | Closure | null $onLabel = 'Yes';

    /**
     * Whether or not to translate the label.
     */
    protected bool $shouldTranslateLabel = false;

    /**
     * Set the 'off' label.
     */
    public function offLabel(string | Htmlable | Closure | null $label): static
    {
        $this->offLabel = $label;

        return $this;
    }

    /**
     * Set the 'on' label.
     */
    public function onLabel(string | Htmlable | Closure | null $label): static
    {
        $this->onLabel = $label;

        return $this;
    }

    /**
     * Get the 'off' label.
     */
    public function getOffLabel(): string | Htmlable | null
    {
        $offLabel = $this->evaluate($this->offLabel);

        return (is_string($offLabel) && $this->shouldTranslateLabel) ? __($offLabel) : $offLabel;
    }

    /**
     * Get the 'on' label.
     */
    public function getOnLabel(): string | Htmlable | null
    {
        $onLabel = $this->evaluate($this->onLabel);

        return (is_string($onLabel) && $this->shouldTranslateLabel) ? __($onLabel) : $onLabel;
    }

    /**
     * Set whether or not to translate the label.
     */
    public function translateLabel(bool $shouldTranslateLabel = true): static
    {
        $this->shouldTranslateLabel = $shouldTranslateLabel;

        return $this;
    }
}

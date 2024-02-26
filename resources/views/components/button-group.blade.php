@php
    $id = $getId();
    $statePath = $getStatePath();
    $isDisabled = $isDisabled();
    $options = $getOptions();
    $offColor = $getOffColor() ?? 'gray';
    $onColor = $getOnColor() ?? 'primary';
    $gridDirection = $getGridDirection() ?? 'column';
    $icons = $getIcons();
    $iconPosition = $getIconPosition();
    $iconSize = $getIconSize();
@endphp
<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        @class([
            'selectify-button-group-grid grid gap-3',
            'grid-cols-1 sm:grid-cols-2' => $gridDirection === 'row',
            'sm:grid-flow-col sm:grid-rows-2' => $gridDirection === 'column',
        ])
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')") }},
            getColor(color) {
                return color === 'gray'
                    ? 'bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20'
                    : 'bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus:ring-custom-500/50 dark:focus:ring-custom-400/50';
            }
        }"
    >
        @foreach ($options as $value => $label)
            @php
                $inputId = "{$id}-{$value}";
                $shouldOptionBeDisabled = $isDisabled || $isOptionDisabled($value, $label);
            @endphp

            <label
                for="{{ $inputId }}"
                x-on:click="state = '{{ $value }}'"
                x-bind:class="
                    state == '{{ $value }}'
                        ? getColor('{{ $onColor }}')
                        : getColor('{{ $offColor }}')
                "
                x-bind:style="
                    state == '{{ $value }}'
                        ? '{{ \Filament\Support\get_color_css_variables($onColor, shades: [600, 500, 400]) }}'
                        : '{{ \Filament\Support\get_color_css_variables($offColor, shades: [600, 500, 400]) }}'
                "
                {{
                    $attributes
                    ->merge($getExtraAttributes(), escape: false)
                    ->merge($getExtraAlpineAttributes(), escape: false)
                    ->class([
                        'selectify-button-group items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm flex shadow-sm',
                        'opacity-70 pointer-events-none' => $shouldOptionBeDisabled,
                        'flex-row mr-1' => $iconPosition === \Filament\Support\Enums\IconPosition::Before || $iconPosition === 'before',
                        'flex-row-reverse ml-1' => $iconPosition === \Filament\Support\Enums\IconPosition::After || $iconPosition === 'after',
                    ])
                }}
                {{ $getExtraAlpineAttributeBag() }}
            >
                <input
                    type="radio"
                    name="{{ $id }}"
                    id="{{ $inputId }}"
                    value="{{ $value }}"
                    class="sr-only"
                    aria-labelledby="{{ $inputId }}"
                    @disabled($shouldOptionBeDisabled)
                    wire:loading.attr="disabled"
                />
                @if (filled($icons))
                    <x-filament::icon
                        icon="{{ $icons[$value] }}"
                        @class([
                            match ($iconSize) {
                                \Filament\Support\Enums\IconSize::Small, 'sm' => 'h-4 w-4 mt-1',
                                \Filament\Support\Enums\IconSize::Medium, 'md' => 'h-5 w-5 mt-0.5',
                                \Filament\Support\Enums\IconSize::Large, 'lg' => 'h-6 w-6',
                                default => $iconSize,
                            },
                        ])
                    />
                @endif
                {{ $label }}
            </label>
        @endforeach
    </div>
</x-dynamic-component>

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $id = $getId();
        $gridDirection = $getGridDirection() ?? 'column';
        $statePath = $getStatePath();
        $isDisabled = $isDisabled();
        $options = $getOptions();
        $offColor = $getOffColor() ?? 'gray';
        $onColor = $getOnColor() ?? 'primary';
    @endphp

    <div
        @class([
            'selectify-button-group-grid',
            'grid grid-flow-row grid-cols-2 gap-3' => $gridDirection === 'row',
            'grid grid-flow-col grid-rows-2 gap-3' => $gridDirection === 'column',
        ])
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')") }}
        }"
    >
        @foreach ($options as $value => $label)
            @php
                $shouldOptionBeDisabled = $isDisabled || $isOptionDisabled($value, $label);
            @endphp

            <label
                for="{{ $id }}-{{ $value }}"
                x-on:click="state = '{{ $value }}'"
                x-bind:class="
                    state === '{{ $value }}'
                        ? '{{
                            match ($onColor) {
                                'gray' => 'bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20',
                                default => 'bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus:ring-custom-500/50 dark:focus:ring-custom-400/50',
                            }
                        }}'
                        : '{{
                            match ($offColor) {
                                'gray' => 'bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20',
                                default => 'bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus:ring-custom-500/50 dark:focus:ring-custom-400/50',
                            }
                        }}'
                "
                x-bind:style="
                    state === '{{ $value }}'
                        ? '{{ \Filament\Support\get_color_css_variables($onColor, shades: [600, 500, 400]) }}'
                        : '{{ \Filament\Support\get_color_css_variables($offColor, shades: [600, 500, 400]) }}'
                "
                {{
                    $attributes
                    ->merge($getExtraAttributes())
                    ->class([
                        'selectify-button-group items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 disabled:pointer-events-none disabled:opacity-70 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm',
                    ])
                }}
                {{ $getExtraAlpineAttributeBag() }}
            >
                <input
                    type="radio"
                    name="{{ $id }}"
                    id="{{ $id }}-{{ $value }}"
                    value="{{ $value }}"
                    class="sr-only"
                    aria-labelledby="{{ $id }}-{{ $value }}"
                    @disabled($shouldOptionBeDisabled)
                    wire:loading.attr="disabled"
                />

                {{ $label }}
            </label>
        @endforeach
    </div>
</x-dynamic-component>








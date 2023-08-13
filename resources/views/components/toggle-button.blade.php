<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $id = $getId();
        $statePath = $getStatePath();
        $isDisabled = $isDisabled();
        $onLabel = $getOnLabel();
        $offLabel = $getOffLabel();
        $onColor = $getOnColor() ?? 'primary';
        $offColor = $getOffColor() ?? 'danger';
        $buttons = [
            'on' => [$onColor, $onLabel, true],
            'off' => [$offColor, $offLabel, false]
        ];
    @endphp

    <div
        class="flex items-center"
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')") }}
        }"
    >
        @foreach ($buttons as $key => [$color, $label, $value])
            <label
                for="{{ $id }}-{{ $label }}"
                x-on:click="state = {{ $value ? 'true' : 'false' }}"
                x-bind:class="
                    {{ $value ? 'state' : '!state' }}
                        ? '{{
                            match ($color) {
                                'gray' => 'bg-gray-700 text-white hover:bg-gray-700 dark:bg-gray-950 dark:text-white dark:hover:bg-gray-800',
                                default => 'bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400',
                            }
                        }}'
                        : 'bg-gray-200 dark:bg-white/10 text-gray-900 dark:text-white'
                "
                x-bind:style="
                    {{ $value ? 'state' : '!state' }}
                        ? '{{ \Filament\Support\get_color_css_variables($color, shades: [600, 500, 400]) }}'
                        : null
                "
                {{
                    $attributes
                    ->merge($getExtraAttributes(), escape: false)
                    ->merge($getExtraAlpineAttributes(), escape: false)
                    ->class([
                        'selectify-toggle-' . $key,
                        'opacity-70 pointer-events-none' => $isDisabled,
                    ])
                }}
            >
                {{ $label }}
                <input
                    type="radio"
                    name="{{ $id }}"
                    id="{{ $id }}-{{ $label }}"
                    value="{{ $value }}"
                    class="sr-only"
                    @disabled($isDisabled)
                    wire:loading.attr="disabled"
                />
            </label>
        @endforeach
    </div>
    <style>
        .selectify-toggle-on, .selectify-toggle-off {
            cursor: pointer;
            display: inline-block;
            font-size: 1rem;
            line-height: 1.5rem;
            padding-bottom: 0.375rem;
            padding-inline-end: 0.75rem;
            padding-inline-start: 0.75rem;
            padding-top: 0.375rem;
            position: relative;
            text-align: center;
            transition: all 0.2s ease-in-out;
        }

        .selectify-toggle-on {
            border-bottom-left-radius: 0.5rem;
            border-top-left-radius: 0.5rem;
        }

        .selectify-toggle-off {
            border-bottom-right-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        @media (min-width: 640px) {
            .selectify-toggle-on, .selectify-toggle-off {
                font-size: 0.875rem;
                line-height: 1.5rem;
            }
        }
    </style>
</x-dynamic-component>

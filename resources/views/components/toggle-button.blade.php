<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $id = $getId();
        $statePath = $getStatePath();
        $isDisabled = $isDisabled();
        $offLabel = $getOffLabel();
        $onLabel = $getOnLabel();
        $offColor = $getOffColor() ?? 'danger';
        $onColor = $getOnColor() ?? 'primary';
    @endphp

    <div
        class="flex items-center"
        x-data="{
                state: $wire.{{ $applyStateBindingModifiers("entangle('{$statePath}')") }}
        }"
    >
        <style>
            .filament-selectify-toggle-button-on {
                border-top-left-radius: 0.5rem;
                border-bottom-left-radius: 0.5rem;
            }

            .filament-selectify-toggle-button-off {
                border-top-right-radius: 0.5rem;
                border-bottom-right-radius: 0.5rem;
            }
        </style>
        <label
            for="{{ $id }}-{{ $onLabel }}"
            x-on:click="state = true"
            x-bind:class="
                state
                    ? '{{
                        match ($onColor) {
                            'gray' => 'bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20',
                            default => 'bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus:ring-custom-500/50 dark:focus:ring-custom-400/50',
                        }
                      }}'
                    : 'bg-gray-200 dark:bg-white/10 text-gray-900 dark:text-white'
            "
            x-bind:style="
                state
                    ? '{{ \Filament\Support\get_color_css_variables($onColor, shades: [600, 500, 400]) }}'
                    : null
            "
            {{
                $attributes
                ->merge($getExtraAttributes(), escape: false)
                ->merge($getExtraAlpineAttributes(), escape: false)
                ->class([
                    'filament-selectify-toggle-button-on relative inline-block h-10 py-2 px-3 text-sm text-center transition-all cursor-pointer',
                ])
            }}
        >
            {{ $onLabel }}
            <input
                type="radio"
                x-model="state"
                class="absolute left-0 opacity-0"
            />
        </label>

        <label
            for="{{ $id }}-{{ $offLabel }}"
            x-on:click="state = false"
            x-bind:class="
                !state
                    ? '{{
                        match ($offColor) {
                            'gray' => 'bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20',
                            default => 'bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus:ring-custom-500/50 dark:focus:ring-custom-400/50',
                        }
                      }}'
                    : 'bg-gray-200 dark:bg-white/10 text-gray-900 dark:text-white'
            "
            x-bind:style="
                !state
                    ? '{{ \Filament\Support\get_color_css_variables($offColor, shades: [600, 500, 400]) }}'
                    : null
            "
            {{
                $attributes
                ->merge($getExtraAttributes())
                ->class([
                    'filament-selectify-toggle-button-off relative inline-block h-10 py-2 px-3 text-sm text-center transition-all cursor-pointer',
                ])
            }}
            {{ $getExtraAlpineAttributeBag() }}
        >
            {{ $offLabel }}
            <input
                type="radio"
                x-model="!state"
                class="absolute left-0 opacity-0"
            />
        </label>
    </div>
</x-dynamic-component>




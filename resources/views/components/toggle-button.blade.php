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
                ->class(['selectify-toggle-on'])
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
                ->class(['selectify-toggle-off'])
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
    <style>
        .selectify-toggle-on {
            position: relative;
            display: inline-block;
            padding-top: 0.375rem;
            padding-bottom: 0.375rem;
            padding-inline-start: 0.75rem;
            padding-inline-end: 0.75rem;
            text-align: center;
            font-size: 1rem;
            line-height: 1.5rem;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        @media (min-width: 640px) {
            .selectify-toggle-on {
                font-size: 0.875rem;
                line-height: 1.5rem;
            }
        }

        .selectify-toggle-off {
            position: relative;
            display: inline-block;
            padding-top: 0.375rem;
            padding-bottom: 0.375rem;
            padding-inline-start: 0.75rem;
            padding-inline-end: 0.75rem;
            text-align: center;
            font-size: 1rem;
            line-height: 1.5rem;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        @media (min-width: 640px) {
            .selectify-toggle-off {
                font-size: 0.875rem;
                line-height: 1.5rem;
            }
        }
    </style>
</x-dynamic-component>




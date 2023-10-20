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
        x-on:keydown.left="state = true"
        x-on:keydown.right="state = false"
    >
        @foreach ($buttons as $key => [$color, $label, $value])
            <button
                x-on:click="state = {{ $value ? 'true' : 'false' }}"
                x-bind:aria-pressed="state ? 'true' : 'false'"
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
                    ->merge([
                        'id' => "{$id}-{$label}",
                        'role' => 'button',
                        'type' => 'button',
                        'aria-label' => $label,
                        'disabled' => $isDisabled,
                        'wire:loading.attr' => 'disabled',
                    ], escape: false)
                    ->merge($getExtraAttributes(), escape: false)
                    ->merge($getExtraAlpineAttributes(), escape: false)
                    ->class([
                        'relative inline-block outline-none cursor-pointer text-base sm:text-sm sm:leading-6 text-center ps-3 pe-3 py-1.5 transition-all duration-200 ease-in-out disabled:pointer-events-none disabled:opacity-70',
                        'selectify-toggle-on rounded-s-lg' => $key === 'on',
                        'selectify-toggle-off rounded-e-lg' => $key === 'off',
                    ])
                }}
            >
                {{ $label }}
            </button>
        @endforeach
    </div>
</x-dynamic-component>

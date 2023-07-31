<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        class="flex items-center mt-1"
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
        }"
    >
        <label
            for="{{ $getId() }}-{{ $getOnLabel() }}"
            x-on:click="state = true"
            x-bind:class="{
                '{{
                    match ($getOnColor()) {
                        'danger' => 'bg-danger-600',
                        'primary' => 'bg-primary-600',
                        'secondary' => 'bg-gray-500',
                        'warning' => 'bg-warning-600',
                        default => 'bg-success-600',
                    }
                }} text-white': state,
                'bg-gray-200 dark:bg-white/10 text-gray-900 dark:text-white': !state,
            }"
            {{
                $attributes
                ->merge($getExtraAttributes())
                ->class([
                    'filament-companies-toggle-button-on relative inline-block h-10 rounded-l-lg pt-2 pb-2 pl-3 pr-3 text-sm text-center transition-all cursor-pointer',
                ])
            }}
            {{ $getExtraAlpineAttributeBag() }}
        >
            {{ $getOnLabel() }}
            <input type="radio" x-model="state" class="absolute left-0 opacity-0" />
        </label>

        <label
            for="{{ $getId() }}-{{ $getOffLabel() }}"
            x-on:click="state = false"
            x-bind:class="{
                '{{
                    match ($getOffColor()) {
                        'primary' => 'bg-primary-600',
                        'secondary' => 'bg-gray-500',
                        'success' => 'bg-success-600',
                        'warning' => 'bg-warning-600',
                        default => 'bg-danger-600',
                    }
                }} text-white': !state,
                'bg-gray-200 dark:bg-white/10 text-gray-900 dark:text-white': state,
            }"
            {{
                $attributes
                ->merge($getExtraAttributes())
                ->class([
                    'filament-companies-toggle-button-off relative inline-block h-10 rounded-r-lg pt-2 pb-2 pl-3 pr-3 text-sm text-center transition-all cursor-pointer',
                ])
            }}
            {{ $getExtraAlpineAttributeBag() }}
        >
            {{ $getOffLabel() }}
            <input type="radio" x-model="!state" class="absolute left-0 opacity-0" />
        </label>
    </div>
</x-dynamic-component>

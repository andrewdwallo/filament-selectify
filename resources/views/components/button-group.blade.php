@php
    $gridDirection = $getGridDirection();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
        }"
        class="grid gap-3 {{ $gridDirection === 'column' ? 'grid-cols-2' : 'grid-rows-2' }}"
    >
        @php
            $isDisabled = $isDisabled();
        @endphp

        @foreach ($getOptions() as $value => $label)
            @php
                $shouldOptionBeDisabled = $isDisabled || $isOptionDisabled($value, $label);
            @endphp

            <label
                for="{{ $getId() }}-{{ $value }}"
                x-on:click="state = '{{ $value }}'"
                x-bind:class="{
                    'text-sm text-gray-800 bg-white border-gray-300 hover:bg-gray-50 focus:ring-primary-600 focus:text-primary-600 focus:bg-primary-50 focus:border-primary-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:text-gray-200 dark:focus:text-primary-400 dark:focus:border-primary-400 dark:focus:bg-gray-800': state !== '{{ $value }}',
                    'text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700': state === '{{ $value }}',
                }"
                {{
                    $attributes
                    ->merge($getExtraAttributes())
                    ->class([
                        'filament-companies-button-group inline-flex items-center justify-center gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 py-2.5',
                    ])
                }}
                {{ $getExtraAlpineAttributeBag() }}
            >
                <input
                    type="radio"
                    name="{{ $getId() }}"
                    id="{{ $getId() }}-{{ $value }}"
                    value="{{ $value }}"
                    class="sr-only"
                    aria-labelledby="{{ $getId() }}-{{ $value }}"
                    {!! $shouldOptionBeDisabled ? 'disabled' : null !!}
                    wire:loading.attr="disabled"
                />
                {{ $label }}
            </label>
        @endforeach
    </div>
</x-dynamic-component>

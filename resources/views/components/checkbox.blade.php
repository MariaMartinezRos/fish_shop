<div>
    @props([
        'name',
        'value' => 1,
        'checked' => false,
        'disabled' => false,
        'class' => '',
        'label' => null,
        'error' => null
    ])

    <div class="flex items-center">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            {{ old($name, $checked) ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 {{ $class }}"
            {{ $attributes }}
        >

        @if($label)
            <x-label :for="$name" class="ml-2">
                {{ $label }}
            </x-label>
        @endif
    </div>

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>


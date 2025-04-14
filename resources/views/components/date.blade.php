<div>
    @props([
        'name',
        'value' => '',
        'placeholder' => '',
        'required' => false,
        'disabled' => false,
        'class' => '',
        'error' => null
    ])

    <input
        type="date"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ $error ? 'border-red-500' : '' }} {{ $class }}"
        {{ $attributes }}
    >

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>

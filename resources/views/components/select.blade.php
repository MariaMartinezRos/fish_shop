<div>
    @props([
        'name',
        'options' => [],
        'selected' => null,
        'placeholder' => __('Select an option'),
        'required' => false,
        'disabled' => false,
        'class' => '',
        'error' => null
    ])

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm {{ $error ? 'border-red-500' : '' }} {{ $class }}"
        {{ $attributes }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $option)
            <option value="{{ $option->id }}" {{ old($name, $selected) == $option->id ? 'selected' : '' }}>
                {{ $option->display_name }}
            </option>
        @endforeach
    </select>

    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>

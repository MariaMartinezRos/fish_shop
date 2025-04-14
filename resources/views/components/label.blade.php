<div>
    @props(['for', 'required' => false, 'class' => ''])

    <label
        for="{{ $for }}"
        class="block text-sm font-medium text-gray-700 {{ $class }}"
    >
        {{ $slot }}
        @if($required) <span class="text-red-500">*</span> @endif
    </label>
</div>

<?php


it('renders select component with options', function () {
    $options = [
        '1' => 'Option 1',
        '2' => 'Option 2',
        '3' => 'Option 3',
    ];

    $view = $this->blade('<x-select-livewire name="test" :options="$options" />', ['options' => $options]);

    $view->assertSee('Option 1');
    $view->assertSee('Option 2');
    $view->assertSee('Option 3');
});

it('renders select component with selected value', function () {
    $options = [
        '1' => 'Option 1',
        '2' => 'Option 2',
        '3' => 'Option 3',
    ];

    $view = $this->blade('<x-select-livewire name="test" :options="$options" value="2" />', ['options' => $options]);

    $view->assertSee('selected');
})->todo('no hay forma aparente de comprobar que hay una opcion seleccionada');

it('renders select component with label', function () {
    $options = [
        '1' => 'Option 1',
        '2' => 'Option 2',
    ];

    $view = $this->blade('<x-select-livewire name="test" :options="$options" label="Test Label" />', ['options' => $options]);

    $view->assertSee('Test Label');
});

it('renders select component with error state', function () {
    $options = [
        '1' => 'Option 1',
        '2' => 'Option 2',
    ];

    $view = $this->blade('<x-select-livewire name="test" :options="$options" :error="true" />', ['options' => $options]);

    $view->assertSee('border-red-500');
});

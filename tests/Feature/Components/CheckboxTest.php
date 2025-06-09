<?php

it('renders checkbox component with label', function () {
    $view = $this->blade('<x-checkbox name="test" label="Test Checkbox" />');

    $view->assertSee('Test Checkbox');
})->todo();

it('renders checkbox component as checked', function () {
    $view = $this->blade('<x-checkbox name="test" :checked="true" />');

    $view->assertSee('checked');
});

it('renders checkbox component with error state', function () {
    $view = $this->blade('<x-checkbox name="test" :error="true" />');

    $view->assertSee('text-red-600');
});

it('renders checkbox component with custom value', function () {
    $view = $this->blade('<x-checkbox name="test" value="custom_value" />');

    $view->assertSee('custom_value');
});

<?php

use App\Models\User;

it('renders date component with label', function () {
    $view = $this->blade('<x-date name="test" label="Test Date" />');

    $view->assertSee('Test Date');
    $view->assertSee('date');
});

it('renders date component with value', function () {
    $date = '2024-03-20';
    $view = $this->blade('<x-date name="test" :value="$date" />', ['date' => $date]);

    $view->assertSee($date);
});

it('renders date component with error state', function () {
    $view = $this->blade('<x-date name="test" :error="true" />');

    $view->assertSee('border-red-500');
});

it('renders date component with min and max attributes', function () {
    $view = $this->blade('<x-date name="test" min="2024-01-01" max="2024-12-31" />');

    $view->assertSee('2024-01-01');
    $view->assertSee('2024-12-31');
});

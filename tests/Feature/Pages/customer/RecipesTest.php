<?php

it('returns a successful response for recipes page', function () {
    $response = $this->get('recipes');

    $response->assertStatus(200);
});

it('includes the nav bar client partial', function () {
    // Arrange
    $detailedMeals = [
        [
            'strMealThumb' => 'path/to/image.jpg',
            'strMeal' => 'Sample Meal',
            'strCategory' => 'Category',
            'strArea' => 'Area',
            'strInstructions' => 'Sample instructions',
            'strYoutube' => 'https://youtube.com',
            'strSource' => 'https://source.com',
            'strIngredient1' => 'Ingredient 1',
            'strMeasure1' => '1 cup',
        ],
    ];

    // Act
    $response = $this->view('dashboard.recipes', ['detailedMeals' => $detailedMeals]);

    // Assert
    $response->assertSee('Nosotros');
    $response->assertSee('Productos');
    $response->assertSee('Tiendas');
    $response->assertSee('Recetas');

});

it('shows a list of detailed meals', function () {
    // Arrange
    $detailedMeals = [
        [
            'strMealThumb' => 'path/to/image.jpg',
            'strMeal' => 'Sample Meal',
            'strCategory' => 'Category',
            'strArea' => 'Area',
            'strInstructions' => 'Sample instructions',
            'strYoutube' => 'https://youtube.com',
            'strSource' => 'https://source.com',
            'strIngredient1' => 'Ingredient 1',
            'strMeasure1' => '1 cup',
        ],
    ];

    // Act
    $response = $this->view('dashboard.recipes', ['detailedMeals' => $detailedMeals]);

    // Assert
    $response->assertSee('Sample Meal');
    $response->assertSee('Category');
    $response->assertSee('Area');
    $response->assertSee('Sample instructions');
    $response->assertSee('https://youtube.com');
    $response->assertSee('https://source.com');
    $response->assertSee('Ingredient 1');
    $response->assertSee('1 cup');
});

it('shows a message when no detailed meals are available', function () {
    // Act
    $detailedMeals = [];
    $response = $this->view('dashboard.recipes', ['detailedMeals' => $detailedMeals]);

    // Assert
    $response->assertSee('No hay recetas disponibles.');
});

it('includes the footer', function () {
    // Act
    $detailedMeals = [];
    $response = $this->view('dashboard.recipes', ['detailedMeals' => $detailedMeals]);

    // Assert
    $response->assertSee(' Términos de Servicio');
    $response->assertSee(' Política de Privacidad');
});

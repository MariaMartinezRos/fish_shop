<?php


use App\Models\Fish;
use App\Models\Role;
use App\Models\TypeWater;
use App\Models\User;

use function Pest\Laravel\get;

use function Pest\Laravel\post;


it('returns a successful response for fish page', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get('fish')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('fish')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 4]);
    $costumer = User::factory()->create(['role_id' => 'costumer']);

    // Act
    $this->actingAs($costumer)
        ->get('fish')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $employee = User::factory()->create(['role_id' => 'employee']);

    // Act
    $this->actingAs($employee)
        ->get('fish')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get('fish')
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('can create a fish', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);
    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];

    // Act
    $response = $this->post('http://fish_shop.test/api/v2/fishes', $data);
    $response2 = $this->get('http://fish_shop.test/api/v2/fishes', $data);

    // Assert
    $response->assertStatus(201);
    $response2->assertSee([
        'name' => 'Salmon',
        'image' => null,
        'type' => null,
        'description' => 'descripcion',
    ]);

});

it('can delete a fish', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);
    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];

    // Act && Assert
    $response = $this->post('http://fish_shop.test/api/v2/fishes', $data);
    $response->assertStatus(201);

    $fish = Fish::where('name', 'Salmon')->first();
    $response2 = $this->delete('http://fish_shop.test/api/v2/fishes/'.$fish->id);

    $response2->assertStatus(204);
    $this->assertDatabaseMissing('fishes', [
        'name' => 'Salmon',
        'image' => null,
        'type' => null,
        'description' => 'descripcion',
    ]);
});

it('can fetch all fishes', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);

    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];
    $this->post('http://fish_shop.test/api/v2/fishes', $data);  // Create a fish

    // Act
    $response = $this->get('http://fish_shop.test/api/v2/fishes');

    // Assert
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'name' => 'Salmon',
        'description' => 'descripcion',
    ]);
});

it('can fetch a single fish by ID', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);

    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];
    $response = $this->post('http://fish_shop.test/api/v2/fishes', $data); // Create a fish
    $fish = Fish::where('name', 'Salmon')->first();

    // Act
    $response2 = $this->get('http://fish_shop.test/api/v2/fishes/'.$fish->id);

    // Assert
    $response2->assertStatus(200);
    $response2->assertJsonFragment([
        'name' => 'Salmon',
        'description' => 'descripcion',
    ]);
});

it('can update an existing fish', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);

    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];
    $response = $this->post('http://fish_shop.test/api/v2/fishes', $data);  // Create a fish
    $fish = Fish::where('name', 'Salmon')->first();

    // New data for updating the fish
    $updatedData = [
        'name' => 'Updated Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'updated description',
    ];

    // Act
    $response2 = $this->put('http://fish_shop.test/api/v2/fishes/'.$fish->id, $updatedData);

    // Assert
    $response2->assertStatus(200);
    $response2->assertJsonFragment([
        'name' => 'Updated Salmon',
        'type' => null,
        'description' => 'updated description',
    ]);
});

it('can filter fishes by type', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);

    $dataSaltwater = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];
    $dataFreshwater = [
        'name' => 'Trout',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];

    $this->post('http://fish_shop.test/api/v2/fishes', $dataSaltwater);  // Create a Saltwater fish
    $this->post('http://fish_shop.test/api/v2/fishes', $dataFreshwater);  // Create a Freshwater fish

    // Act
    $response = $this->get('http://fish_shop.test/api/v2/fishes/filter/Saltwater');

    // Assert
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'name' => 'Salmon',
        'type' => null,
    ]);
    $response->assertDontSee('Trout');  // Ensure the Freshwater fish is not included
})->todo();

it('can search fishes', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);

    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];
    $this->post('http://fish_shop.test/api/v2/fishes', $data);  // Create a fish

    // Act
    $response = $this->get('http://fish_shop.test/api/v2/fishes/search?name=Salmon');

    // Assert
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'name' => 'Salmon',
        'description' => 'descripcion',
    ]);
})->todo();

it('can list all fishes', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $this->actingAs($admin);

    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];
    $this->post('http://fish_shop.test/api/v2/fishes', $data);  // Create a fish

    // Act
    $response = $this->get('http://fish_shop.test/api/v2/fishes/list');

    // Assert
    $response->assertStatus(200);
    $response->assertJsonFragment([
        'name' => 'Salmon',
        'description' => 'descripcion',
    ]);
})->todo();


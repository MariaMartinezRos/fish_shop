<?php

use Illuminate\Support\Facades\File;

it('ensures the auth.php file exists before including it', function () {
    // Act & Assert
    expect(File::exists(base_path('routes/auth.php')))
        ->toBeTrue();
});

it('ensures the web.php file exists', function () {
    // Act & Assert
    expect(File::exists(base_path('routes/web/web.php')))
        ->toBeTrue();
});

it('ensures the api.php file exists', function () {
    // Act & Assert
    expect(File::exists(base_path('routes/api/api.php')))
        ->toBeTrue();
});

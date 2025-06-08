<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'User has full access to manage the system, including user roles and permissions'],
            ['name' => 'employee', 'display_name' => 'Employee', 'description' => 'User has general access to perform assigned tasks and duties'],
            ['name' => 'supplier', 'display_name' => 'Supplier', 'description' => 'User provides goods to the system'],
            ['name' => 'customer', 'display_name' => 'Client', 'description' => 'User interacts with the system as a client for purchases or services'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

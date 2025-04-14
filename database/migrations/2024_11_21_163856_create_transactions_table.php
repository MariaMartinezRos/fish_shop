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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('tpv');
            $table->string('serial_number');
            $table->string('terminal_number');
            $table->string('operation');
            $table->decimal('amount', 10, 2);
            $table->string('card_number');
            $table->dateTime('date_time');
            $table->string('transaction_number');
            $table->unsignedBigInteger('sale_id')->index();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

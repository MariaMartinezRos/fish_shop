<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'tpv' => $this->faker->word(),
            'serial_number' => $this->faker->uuid(),
            'terminal_number' => 'TERM-'.$this->faker->randomNumber(3),
            'operation' => $this->faker->randomElement(['sale', 'refund']),
            'amount' => $this->faker->randomFloat(2, 1, 500),
            'card_number' => $this->faker->creditCardNumber(),
            'date_time' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'transaction_number' => 'TXN-'.$this->faker->unique()->numerify('#####'),
            'sale_id' => $this->faker->randomNumber(5),
        ];
    }
}

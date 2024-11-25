<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = Storage::path('transactions.json');
        $jsonData = file_get_contents($filePath);
        $transactions = json_decode($jsonData, true);

        foreach ($transactions as $transaction) {
            Transaction::create([
                'tpv' => $transaction['tpv'],
                'serial_number' => $transaction['serial_number'],
                'terminal_number' => $transaction['terminal_number'],
                'operation' => $transaction['operation'],
                'amount' => $transaction['amount'],
                'card_number' => $transaction['card_number'],
                'date_time' => $transaction['date_time'],
                'transaction_number' => $transaction['transaction_number'],
                'sale_id' => $transaction['sale_id'],
                'created_at' => $transaction['created_at'] ?? now(),
                'updated_at' => $transaction['updated_at'] ?? now(),
            ]);
        }
    }
}
//$table->string('tpv');
//$table->string('serial_number');
//$table->string('terminal_number');
//$table->string('operation');
//$table->decimal('amount', 10, 2);
//$table->string('card_number');
//$table->dateTime('date_time');
//$table->string('transaction_number');
//$table->unsignedBigInteger('sale_id')->index();
//$table->timestamp('created_at')->nullable();
//$table->timestamp('updated_at')->nullable();

<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

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

    private function isDataAlreadyGiven(): bool
    {
        return Transaction::where('sale_id', '101')->exists();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{

    protected $fillable = [
        'tpv',
        'serial_number',
        'terminal_number',
        'operation',
        'amount',
        'card_number',
        'date_time',
        'transaction_number',
        'sale_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the Transaction
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tpv', 'name');
    }
    public static function create(array $transaction): Transaction
    {

        $newTransaction = new self();

        $newTransaction->tpv = $transaction['tpv'];
        $newTransaction->serial_number = $transaction['serial_number'];
        $newTransaction->terminal_number = $transaction['terminal_number'];
        $newTransaction->operation = $transaction['operation'];
        $newTransaction->amount = $transaction['amount'];
        $newTransaction->card_number = $transaction['card_number'];
        $newTransaction->date_time = $transaction['date_time'];
        $newTransaction->transaction_number = $transaction['transaction_number'];
        $newTransaction->sale_id = $transaction['sale_id'];
        $newTransaction->created_at = $transaction['created_at'];
        $newTransaction->updated_at = $transaction['updated_at'];

        $newTransaction->save();
        return $newTransaction;
    }
}

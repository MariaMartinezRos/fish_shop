<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, HasFactory;
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
     * Get the user that owns the TransactionSearcher
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tpv', 'name');
    }

    public static function create(array $transaction): Transaction
    {

        $newTransaction = new self;

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

    /**
     * Scope a query to filter by TVP.
     */
    public function scopeSearch(Builder $query, $tpv): Builder
    {
        return $query->where('tpv', 'like', "%{$tpv}%");
    }
}

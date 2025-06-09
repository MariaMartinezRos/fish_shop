<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

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

    /**
     * Scope a query to analyze transactions with complex metrics.
     *
     * @param Builder $query
     * @param string|null $startDate Start date for filtering (Y-m-d H:i:s)
     * @param string|null $endDate End date for filtering (Y-m-d H:i:s)
     * @param float|null $minAmount Minimum transaction amount
     * @param array|null $operationTypes Array of operation types to filter by
     * @param bool $groupByTerminal Whether to group results by terminal
     * @param bool $includeUserMetrics Whether to include user performance metrics
     * @return Builder
     */
    public function scopeByTransactionMetrics(
        Builder $query,
        ?string $startDate = null,
        ?string $endDate = null,
        ?float $minAmount = null,
        ?array $operationTypes = null,
        bool $groupByTerminal = false,
        bool $includeUserMetrics = false
    ): Builder {
        $query = $query->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date_time', [$startDate, $endDate]);
            })
            ->when($minAmount !== null, function ($query) use ($minAmount) {
                $query->where('amount', '>=', $minAmount);
            })
            ->when($operationTypes !== null, function ($query) use ($operationTypes) {
                $query->whereIn('operation', $operationTypes);
            });

        if ($groupByTerminal) {
            $query->groupBy('terminal_number')
                ->select('terminal_number')
                ->selectRaw('COUNT(*) as total_transactions')
                ->selectRaw('SUM(amount) as total_amount')
                ->selectRaw('AVG(amount) as average_amount')
                ->selectRaw('MIN(date_time) as first_transaction')
                ->selectRaw('MAX(date_time) as last_transaction');
        }

        if ($includeUserMetrics) {
            $query->with(['user' => function ($query) {
                $query->select('name', 'id')
                    ->withCount('transactions as total_user_transactions')
                    ->withSum('transactions', 'amount');
            }]);
        }

        return $query;
    }
}

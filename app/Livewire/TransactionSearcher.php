<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

/**
 * @method static query()
 */
class TransactionSearcher extends Component
{
    public string $tpv = '';
    public bool $todays_transactions = false;

    /**
     * Render the Livewire component.
     */
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
    {
        $query = Transaction::query();
        
        if ($this->tpv) {
            $query->search($this->tpv);
        }
        
        if ($this->todays_transactions) {
            $query->today();
        }

        $transactions = $query->get();

        return view('livewire.transaction-searcher', [
            'transactions' => $transactions,
        ])->layout('layouts.app');
    }
}

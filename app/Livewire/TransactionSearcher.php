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

    /**
     * Render the Livewire component.
     */
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
    {
        $transactions = Transaction::search($this->tpv)->get();

        return view('livewire.transaction-searcher', [
            'transactions' => $transactions,
        ])->layout('layouts.app');
    }
}

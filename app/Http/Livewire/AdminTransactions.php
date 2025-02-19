<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class AdminTransactions extends Component
{
    public $tvp = '';

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        $transactions = Transaction::query()
            ->whereNotNull('tvp')
            ->orderBy('tvp', 'desc')
            ->ByTVP($this->tvp)
            ->get();

        dd($transactions);

        return view('livewire.admin-transactions', compact('transactions'));
    }

    //    public function render()
    //    {
    //        $transactions = Transaction::scopeByTVP($this->tvp)->get();
    //
    //        return view('livewire.admin-transactions', [
    //            'transactions' => $transactions // 👈 Aquí nos aseguramos de pasar la variable a la vista
    //        ]);
    //    }
}

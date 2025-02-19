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
    public $transactions;
    public $value = '';


    public function mount(): void
    {
        $this->transactions = Transaction::all();
    }

    public function update($value): void
    {
        $this->tvp = $value; // Store the new value
        $this->transactions = Transaction::query()
            ->whereNotNull('tvp')
            ->orderBy('tvp', 'desc')
            ->byTVP($this->tvp)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.admin-transactions', [
            'transactions' => $this->transactions
        ]);
    }


//    public function render(): Application|Factory|View|\Illuminate\View\View
//    {
//        $transactions = Transaction::query()
//            ->whereNotNull('tvp')->get();
//
//        return view('livewire.admin-transactions', compact('transactions'));
//    }

    public function updatedFiltro($value): void
    {
        $this->tvp = $value; // Set the filter value correctly

        if ($value === 'all') {
            $this->transactions = Transaction::all();
        } else {
            $this->transactions = Transaction::query()
                ->whereNotNull('tvp')
                ->orderBy('tvp', 'desc')
                ->byTVP($this->tvp) // Fix scope usage
                ->get();
        }
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

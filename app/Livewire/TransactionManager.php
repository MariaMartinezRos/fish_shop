<?php

namespace App\Livewire;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionManager extends Component
{
    use WithPagination;

    public $tpv = '';

    public $serial_number = '';

    public $terminal_number = '';

    public $operation = '';

    public $amount = '';

    public $card_number = '';

    public $date_time = '';

    public $transaction_number = '';

    public $sale_id = '';

    public $editing = false;

    public $creating = false;

    public $transactionId = null;

    public $search = '';

    protected $rules = [
        'tpv' => 'required|string|max:255',
        'serial_number' => 'required|string',
        'terminal_number' => 'required|string',
        'operation' => 'required|string',
        'amount' => 'required|numeric|min:4',
        'card_number' => 'required|string|min:4',
        'date_time' => 'required|date',
        'transaction_number' => 'required|string',
        'sale_id' => 'required|numeric',
    ];

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        $transactions = Transaction::search($this->search)->paginate(10);

        return view('livewire.transaction-manager', [
            'transactions' => $transactions,
        ]);
    }

    public function create(): void
    {
        $this->authorize('create', Transaction::class);
        $this->resetValidation();
        $this->reset(['tpv', 'serial_number', 'terminal_number', 'operation', 'amount', 'card_number', 'date_time', 'transaction_number', 'sale_id', 'editing', 'transactionId']);
        $this->creating = true;
    }

    public function edit(Transaction $transaction): void
    {
        $this->authorize('update', $transaction);
        $this->editing = true;
        $this->creating = false;
        $this->transactionId = $transaction->id;
        $this->tpv = $transaction->tpv;
        $this->serial_number = $transaction->serial_number;
        $this->terminal_number = $transaction->terminal_number;
        $this->operation = $transaction->operation;
        $this->amount = $transaction->amount;
        $this->card_number = $transaction->card_number;
        $this->date_time = $transaction->date_time;
        $this->transaction_number = $transaction->transaction_number;
        $this->sale_id = $transaction->sale_id;
    }

    public function update(): void
    {
        $this->authorize('update', Transaction::class);

        $request = new UpdateTransactionRequest;
        $request->setContainer(app())
            ->setRouteResolver(function () {
                return ['transaction' => $this->transactionId];
            });

        $request->merge([
            'tpv' => $this->tpv,
            'serial_number' => $this->serial_number,
            'terminal_number' => $this->terminal_number,
            'operation' => $this->operation,
            'amount' => $this->amount,
            'card_number' => $this->card_number,
            'date_time' => $this->date_time,
            'transaction_number' => $this->transaction_number,
            'sale_id' => $this->sale_id,
        ]);

        $this->validate($request->rules(), $request->messages());

        $transaction = Transaction::find($this->transactionId);
        $transaction->update([
            'tpv' => $this->tpv,
            'serial_number' => $this->serial_number,
            'terminal_number' => $this->terminal_number,
            'operation' => $this->operation,
            'amount' => $this->amount,
            'card_number' => $this->card_number,
            'date_time' => $this->date_time,
            'transaction_number' => $this->transaction_number,
            'sale_id' => $this->sale_id,
        ]);

        $this->reset(['tpv', 'serial_number', 'terminal_number', 'operation', 'amount', 'card_number', 'date_time', 'transaction_number', 'sale_id', 'editing', 'transactionId', 'creating']);
        session()->flash('message', __('Transaction updated successfully.'));
    }

    public function store(): void
    {
        $this->authorize('create', Transaction::class);

        $request = new StoreTransactionRequest;
        $request->merge([
            'tpv' => $this->tpv,
            'serial_number' => $this->serial_number,
            'terminal_number' => $this->terminal_number,
            'operation' => $this->operation,
            'amount' => $this->amount,
            'card_number' => $this->card_number,
            'date_time' => $this->date_time,
            'transaction_number' => $this->transaction_number,
            'sale_id' => $this->sale_id,
        ]);

        $this->validate($request->rules(), $request->messages());

        Transaction::create([
            'tpv' => $this->tpv,
            'serial_number' => $this->serial_number,
            'terminal_number' => $this->terminal_number,
            'operation' => $this->operation,
            'amount' => $this->amount,
            'card_number' => $this->card_number,
            'date_time' => $this->date_time,
            'transaction_number' => $this->transaction_number,
            'sale_id' => $this->sale_id,
        ]);

        $this->reset(['tpv', 'serial_number', 'terminal_number', 'operation', 'amount', 'card_number', 'date_time', 'transaction_number', 'sale_id', 'creating']);
        session()->flash('message', __('Transaction created successfully.'));
    }

    public function delete($id): void
    {
        $transaction = Transaction::findOrFail($id);

        try {
            $this->authorize('delete', $transaction);
            $transaction->delete();
            session()->flash('message', __('Transaction deleted successfully.'));
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            session()->flash('error', __('You are not authorized to delete this transaction.'));
        }
    }

    public function cancel(): void
    {
        $this->reset(['tpv', 'serial_number', 'terminal_number', 'operation', 'amount', 'card_number', 'date_time', 'transaction_number', 'sale_id', 'editing', 'transactionId', 'creating']);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }
}

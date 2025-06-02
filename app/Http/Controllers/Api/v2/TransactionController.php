<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;

class TransactionController extends Controller
{
    /**
     * Get a list of all transactions.
     *
     * @group Transactions V2
     *
     * @response 200 {
     *    "data": [
     *      {
     *        "id": 1,
     *        "tpv": "TPV001",
     *        "serial_number": "SN123456",
     *        "terminal_number": "TN789012",
     *        "operation": "SALE",
     *        "amount": 150.50,
     *        "card_number": "4111111111111111",
     *        "date_time": "2024-02-11T18:24:59.000000Z",
     *        "transaction_number": "TRX123456",
     *        "sale_id": 1,
     *        "user": {
     *          "id": 1,
     *          "name": "John Doe",
     *          "email": "john@example.com"
     *        },
     *        "created_at": "2024-02-11T18:24:59.000000Z",
     *        "updated_at": "2024-02-11T18:24:59.000000Z"
     *      }
     *    ]
     *  }
     */
    public function index()
    {
        return TransactionResource::collection(Cache::rememberForever('transactions', function () {
            return Transaction::with('user')->get();
        }));
    }

    /**
     * Get a specific transaction.
     *
     * @group Transactions V2
     *
     * @urlParam transaction int required The ID of the transaction. Example: 1
     *
     * @response 200 {
     *     "data": {
     *       "id": 1,
     *       "tpv": "TPV001",
     *       "serial_number": "SN123456",
     *       "terminal_number": "TN789012",
     *       "operation": "SALE",
     *       "amount": 150.50,
     *       "card_number": "4111111111111111",
     *       "date_time": "2024-02-11T18:24:59.000000Z",
     *       "transaction_number": "TRX123456",
     *       "sale_id": 1,
     *       "user": {
     *         "id": 1,
     *         "name": "John Doe",
     *         "email": "john@example.com"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction->load('user'));
    }

    /**
     * Store a new transaction.
     *
     * @group Transactions V2
     *
     * @bodyParam tpv string required The TPV identifier. Example: TPV001
     * @bodyParam serial_number string required The serial number. Example: SN123456
     * @bodyParam terminal_number string required The terminal number. Example: TN789012
     * @bodyParam operation string required The operation type. Example: SALE
     * @bodyParam amount numeric required The transaction amount. Example: 150.50
     * @bodyParam card_number string required The card number. Example: 4111111111111111
     * @bodyParam date_time date required The transaction date and time. Example: 2024-02-11 18:24:59
     * @bodyParam transaction_number string required The transaction number. Example: TRX123456
     * @bodyParam sale_id integer required The sale ID. Example: 1
     *
     * @response 201 {
     *     "data": {
     *       "id": 1,
     *       "tpv": "TPV001",
     *       "serial_number": "SN123456",
     *       "terminal_number": "TN789012",
     *       "operation": "SALE",
     *       "amount": 150.50,
     *       "card_number": "4111111111111111",
     *       "date_time": "2024-02-11T18:24:59.000000Z",
     *       "transaction_number": "TRX123456",
     *       "sale_id": 1,
     *       "user": {
     *         "id": 1,
     *         "name": "John Doe",
     *         "email": "john@example.com"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->validated());
        Cache::forget('transactions');

        return new TransactionResource($transaction->load('user'));
    }

    /**
     * Update an existing transaction.
     *
     * @group Transactions V2
     *
     * @urlParam transaction int required The ID of the transaction. Example: 1
     *
     * @bodyParam tpv string required The TPV identifier. Example: TPV001
     * @bodyParam serial_number string required The serial number. Example: SN123456
     * @bodyParam terminal_number string required The terminal number. Example: TN789012
     * @bodyParam operation string required The operation type. Example: SALE
     * @bodyParam amount numeric required The transaction amount. Example: 150.50
     * @bodyParam card_number string required The card number. Example: 4111111111111111
     * @bodyParam date_time date required The transaction date and time. Example: 2024-02-11 18:24:59
     * @bodyParam transaction_number string required The transaction number. Example: TRX123456
     * @bodyParam sale_id integer required The sale ID. Example: 1
     *
     * @response 200 {
     *     "data": {
     *       "id": 1,
     *       "tpv": "TPV001",
     *       "serial_number": "SN123456",
     *       "terminal_number": "TN789012",
     *       "operation": "SALE",
     *       "amount": 150.50,
     *       "card_number": "4111111111111111",
     *       "date_time": "2024-02-11T18:24:59.000000Z",
     *       "transaction_number": "TRX123456",
     *       "sale_id": 1,
     *       "user": {
     *         "id": 1,
     *         "name": "John Doe",
     *         "email": "john@example.com"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        Cache::forget('transactions');

        return new TransactionResource($transaction->load('user'));
    }

    /**
     * Delete a transaction.
     *
     * @group Transactions V2
     *
     * @urlParam transaction int required The ID of the transaction. Example: 1
     *
     * @response 204
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        Cache::forget('transactions');

        return response()->json(null, 204);
    }
} 
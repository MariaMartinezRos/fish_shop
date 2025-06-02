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

     *        "created_at": "2024-02-11T18:24:59.000000Z",
     *        "updated_at": "2024-02-11T18:24:59.000000Z"
     *      }
     *    ]
     * }
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

     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     * @response 404 {"message": "Transaction not found"}
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction->load('user'));
    }

    /**
     * Store a new transaction.
     *
     * @group Transactions V2
     * @authenticated
     *
     * @bodyParam tpv string required The TPV (Point of Sale Terminal) identifier. Example: TPV001
     * @bodyParam serial_number string required The unique serial number of the terminal. Example: SN123456
     * @bodyParam terminal_number string required The terminal number used for the transaction. Example: TN789012
     * @bodyParam operation string required The type of operation (SALE, REFUND, VOID). Example: SALE
     * @bodyParam amount numeric required The transaction amount in dollars. Example: 150.50
     * @bodyParam card_number string required The masked card number used for the transaction. Example: 4111111111111111
     * @bodyParam date_time datetime required The date and time of the transaction. Example: 2024-02-11 18:24:59
     * @bodyParam transaction_number string required The unique transaction reference number. Example: TRX123456
     * @bodyParam sale_id integer required The ID of the associated sale. Example: 1
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

     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     * @response 422 {"message": "The given data was invalid.", "errors": {"tpv": ["The tpv field is required."]}}
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
     * @authenticated
     *
     * @urlParam transaction int required The ID of the transaction. Example: 1
     *
     * @bodyParam tpv string required The TPV (Point of Sale Terminal) identifier. Example: TPV001
     * @bodyParam serial_number string required The unique serial number of the terminal. Example: SN123456
     * @bodyParam terminal_number string required The terminal number used for the transaction. Example: TN789012
     * @bodyParam operation string required The type of operation (SALE, REFUND, VOID). Example: SALE
     * @bodyParam amount numeric required The transaction amount in dollars. Example: 150.50
     * @bodyParam card_number string required The masked card number used for the transaction. Example: 4111111111111111
     * @bodyParam date_time datetime required The date and time of the transaction. Example: 2024-02-11 18:24:59
     * @bodyParam transaction_number string required The unique transaction reference number. Example: TRX123456
     * @bodyParam sale_id integer required The ID of the associated sale. Example: 1
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
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     * @response 404 {"message": "Transaction not found"}
     * @response 422 {"message": "The given data was invalid.", "errors": {"tpv": ["The tpv field is required."]}}
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
     * @authenticated
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

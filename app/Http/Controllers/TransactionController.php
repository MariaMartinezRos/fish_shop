<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function importJson()
    {
//        // Path to the JSON file (adjust the path based on your setup)
//        $path = storage_path('private/transactions.json');
//
//        // Check if the file exists
//        if (!File::exists($path)) {
//            return response()->json(['error' => 'File not found'], 404);
//        }
//
//        // Read the file content and decode the JSON
//        $json = File::get($path);
//        $data = json_decode($json, true);
//
//        // Read and decode the JSON file
//        $json = File::get($path);
//        $transactions = json_decode($json, true);
//
//        // Loop through each transaction and insert into the database
//        foreach ($transactions as $transaction) {
//            $newTransaction = new Transaction();
//
//            // Assign values
////            $newTransaction->tpv = $transaction['tpv'];
////            $newTransaction->serial_number = $transaction['serial_number'];
////            $newTransaction->terminal_number = $transaction['terminal_number'];
////            $newTransaction->operation = $transaction['operation'];
////            $newTransaction->amount = $transaction['amount'];
////            $newTransaction->card_number = $transaction['card_number'];
////            $newTransaction->date_time = $transaction['date_time'];
////            $newTransaction->transaction_number = $transaction['transaction_number'];
////            $newTransaction->sale_id = $transaction['sale_id'];
////            $newTransaction->created_at = $transaction['created_at'];
////            $newTransaction->updated_at = $transaction['updated_at'];
//
//            // Save to database
//            $newTransaction->save();
//        }
//
//        return response()->json(['success' => 'Transactions imported successfully']);
    }
}

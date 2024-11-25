<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transactions')->get();

        if ($transactions->isEmpty()) {
            return view('transactions', ['transactions' => []]);
        }

        return view('transactions', compact('transactions'));
    }
    public function showSales()
    {
        $totalAmount = DB::table('transactions')->sum('amount');
        return view('sales', compact('totalAmount'));
    }
    public function showClients()
    {
        $totalClients = DB::table('transactions')->count();
        return view('sales', compact('totalClients'));
    }
}

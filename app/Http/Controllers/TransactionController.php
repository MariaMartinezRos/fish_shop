<?php

namespace App\Http\Controllers;

use App\Charts\SalesPerHourChart;
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
//        $totalAmount = DB::table('transactions')->sum('amount');
//        return view('sales', compact('totalAmount'));
        $totalAmount = DB::table('transactions')->sum('amount');
        $totalClients = DB::table('transactions')->count();
        $chart = $this->showGraphic();
        return view('sales', compact('totalAmount', 'totalClients', 'chart'));
    }
    public function showGraphic()
    {
        $chart = new SalesPerHourChart();
        $chart->build();
        return $chart;

//        return view('sales', compact('chart'));
    }
}

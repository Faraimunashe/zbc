<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::paginate(10);
        return view('admin.transactions', [
            'transactions' => $transactions
        ]);
    }

    public function report()
    {
        $transactions = Transaction::all();
        $pdf = PDF::loadView('pdf.transactions', ['transactions' => $transactions]);

        return $pdf->download(now().'_trans-report_'.'.pdf');
    }
}

<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class StatementController extends Controller
{
    public function index()
    {
        $statements = Transaction::where('user_id', Auth::id())->paginate(10);

        return view('user.statement', [
            'statements' => $statements
        ]);
    }

    public function download()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        $pdf = PDF::loadView('pdf.transactions', ['transactions' => $transactions]);

        return $pdf->download(now().'statement'.'.pdf');
    }
}

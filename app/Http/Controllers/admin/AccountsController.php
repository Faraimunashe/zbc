<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        $accounts = Account::paginate(10);
        return view('admin.accounts', [
            'accounts' => $accounts
        ]);
    }
}

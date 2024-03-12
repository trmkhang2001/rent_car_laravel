<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        $items = Transactions::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.transaction.index', ['items' => $items]);
    }
}

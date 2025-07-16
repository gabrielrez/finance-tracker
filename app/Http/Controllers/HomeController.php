<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    

    public function index(Request $request)
    {
        $period = $request->query('period') ?? null;

        $overview = $this->transactionService->overview(user(), $period);
        $transactions = user()->transactions()->with('category')->take(3)->latest('created_at')->get(); 

        return view('app.home', [
            'overview' => $overview,
            'transactions' => $transactions
        ]);
    }
}

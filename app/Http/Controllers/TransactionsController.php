<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }



    public function index()
    {
        $search = request()->query('search') ?? null;
        $from = request('from') ? Carbon::parse(request('from')) : null;
        $to = request('to') ? Carbon::parse(request('to')) : null;

        $transactions = $this->transactionService->filter(user(), $search, $from, $to);

        $grouped_transactions = $transactions->groupBy(function ($transaction) {
            return Carbon::parse($transaction->date)->format('Y-m-d');
        });

        return view('app.transactions.index', [
            'grouped_transactions' => $grouped_transactions,
            'search' => $search,
            'from' => $from,
            'to' => $to,
        ]);
    }



    public function store()
    {
        request()->merge([
            'amount' => str_replace(',', '.', request('amount')),
        ]);

        $attributes = request()->validate([
            'type' => ['required'],
            'category_id' => ['required'],
            'description' => ['max:75'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $attributes['amount'] = (int) round($attributes['amount'] * 100);
        $attributes['user_id'] = user()->id;

        Transaction::create($attributes);

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;

class TransactionsController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }



    public function index()
    {
        $transactions_paginated = user()
            ->transactions()
            ->with('category')
            ->latest('date')
            ->paginate(12);

        $grouped_transactions = $this->transactionService
            ->groupByDate($transactions_paginated->getCollection());

        return view('app.transactions.index', [
            'grouped_transactions' => $grouped_transactions,
            'transactions_paginated' => $transactions_paginated,
        ]);
    }



    public function show(int $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        return view('app.transactions.show', [
            'transaction' => $transaction,
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

        $attributes['amount'] = intval(round($attributes['amount'] * 100));
        $attributes['user_id'] = user()->id;

        Transaction::create($attributes);

        return redirect()->route('home');
    }



    public function delete(int $id)
    {
        Transaction::findOrFail($id)->delete();

        return redirect()->route('transactions.index');
    }
}

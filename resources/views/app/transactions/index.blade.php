<x-head></x-head>

<div class="max-w-2xl mx-auto">
    <x-layout.header></x-layout.header>

<main class="px-4 mt-8">
    <h1 class="text-center text-[2rem] sm:text-[3rem] font-extrabold font-poppins">Incomes & outcomes</h1>

    <div class="bg-white rounded-lg overflow-hidden">
        @foreach ($grouped_transactions as $date => $transactions)
            <h4 class="text-base font-semibold text-[#9D9EA2] font-poppins mt-12 mb-4">
                {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
            </h4>

            @foreach ($transactions as $transaction)
                <a href="transactions/{{ $transaction->id }}"
                    class="grid grid-cols-3 items-center mb-4 pt-4 border-t border-[#EFF1F3] hover:scale-[0.98] transition duration-150">
                    <span class="font-semibold text-[#2c2c2c]">{{ $transaction->category->name }}</span>
                    <span
                        class="text-center font-semibold {{ $transaction->type->value === 'income' ? 'text-[#47AA79]' : 'text-[#FE5857]' }}">
                        {{ $transaction->type->value === 'income' ? '+' : '-' }}
                        {{ number_format($transaction->amount / 100, 2, ',', '.') }} R$
                    </span>
                    <span class="text-right text-sm text-[#9D9EA2] underline cursor-pointer">
                        Details
                    </span>
                </a>
            @endforeach
        @endforeach
    </div>
    <div class="mt-12">
        @if ($transactions_paginated->hasPages())
            <ul class="pagination flex justify-between">
                @if ($transactions_paginated->onFirstPage())
                    <li class="disabled font-poppins bg-[#EFF1F3] font-medium inline-block w-max px-6 py-2 rounded-xl hover:scale-95 transaction duration-150"><span>{{ __('<') }}</span></li>
                @else
                    <li><a class="font-poppins bg-[#dadee2] font-medium inline-block w-max px-6 py-2 rounded-xl hover:scale-95 transaction duration-150" href="{{ $transactions_paginated->previousPageUrl() }}" rel="prev">{{ __('<') }}</a></li>
                @endif
                
                {{ "Page " . $transactions_paginated->currentPage() . "  of  " . $transactions_paginated->lastPage() }}
            
                @if ($transactions_paginated->hasMorePages())
                    <li><a class="font-poppins bg-[#dadee2] font-medium inline-block w-max px-6 py-2 rounded-xl hover:scale-95 transaction duration-150" href="{{ $transactions_paginated->nextPageUrl() }}" rel="next">{{ __('>') }}</a></li>
                @else
                    <li class="disabled font-poppins bg-[#EFF1F3] font-medium inline-block w-max px-6 py-2 rounded-xl hover:scale-95 transaction duration-150"><span>{{ __('>') }}</span></li>
                @endif
            </ul>
        @endif
    </div>
</main>

<x-footer></x-footer>
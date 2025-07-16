<x-head></x-head>

<div class="max-w-2xl mx-auto">
    <x-layout.header></x-layout.header>

    <main class="px-4 mt-12">

        <h2 class="text-xl font-bold font-poppins text-[#9D9EA2]">Hello, {{ Auth::user()->username }} 👋</h2>


        <section class="mt-10">

            <div class="flex justify-between items-center">
                <h3 class="text-xl text-[#9D9EA2] font-poppins">Overview</h3>

                @php
                    $currentPeriod = request()->query('period');
                @endphp
                <form method="GET" action="{{ route('home') }}">
                    @csrf
                    <select name="period" id="period"
                        class="text-sm text-[#9D9EA2] border-2 border-[#EFF1F3] px-5 py-2 rounded-full cursor-pointer"
                        onchange="this.form.submit()">
                        <option value="this-month" {{ $currentPeriod === 'this-month' ? 'selected' : '' }}>This month
                        </option>
                        <option value="last-7-days" {{ $currentPeriod === 'last-7-days' ? 'selected' : '' }}>Last 7 days
                        </option>
                        <option value="today" {{ $currentPeriod === 'today' ? 'selected' : '' }}>Today</option>
                    </select>
                </form>

            </div>

            <div class="flex justify-between items-center flex-wrap mt-6 font-poppins">
                <div class="text-[#422DC8]">
                    <span class="text-sm">Balance</span>
                    <h4 class="text-xl font-bold">
                        {{ number_format($overview['balance'] / 100, 2, ',', '.') }} R$
                    </h4>
                </div>
                <div class="text-[#47AA79]">
                    <span class="text-sm">Income</span>
                    <h4 class="text-xl font-bold">
                        +{{ number_format($overview['income'] / 100, 2, ',', '.') }} R$
                    </h4>
                </div>
                <div class="text-[#FE5857]">
                    <span class="text-sm">Outcome</span>
                    <h4 class="text-xl font-bold">
                        -{{ number_format($overview['outcome'] / 100, 2, ',', '.') }} R$
                    </h4>
                </div>
            </div>

        </section>

        <section class="mt-16">
            <h3 class="text-xl text-[#9D9EA2] font-poppins">Incomes & outcomes</h3>

            <div class="mt-6 bg-white rounded-lg overflow-hidden">
                <div class="grid grid-cols-3 text-sm text-[#9D9EA2] mb-5">
                    <span>Category</span>
                    <span class="text-center">Date</span>
                    <span class="text-right">Amount</span>
                </div>

                @foreach ($transactions as $transaction)
                    <div class="grid grid-cols-3 items-center mb-4 pt-4 border-t border-[#EFF1F3]">
                        <span class="font-semibold text-[#2c2c2c]">{{ $transaction->category->name }}</span>
                        <span
                            class="text-center text-sm text-[#9D9EA2]">{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</span>
                        <span
                            class="text-right font-semibold {{ $transaction->type->value === 'income' ? 'text-[#47AA79]' : 'text-[#FE5857]' }}">{{ $transaction->type->value === 'income' ? '+' : '-' }}
                            {{ number_format($transaction->amount / 100, 2, ',', '.') }} R$</span>
                    </div>
                @endforeach
            </div>

            <div class="w-full text-right">
                <a href="{{ route('transactions.index') }}" class="text-[#9D9EA2] underline">See more</a>
            </div>
        </section>

        <a href="{{ route('transactions.create') }}"
            class="inline-block font-poppins w-full text-center rounded-2xl mt-10 mb-5 bg-gradient-to-t from-[#2C18B0] to-[#422DC8] text-white text-base font-extrabold py-3 px-14 transition duration-150 hover:from-[#251499] hover:to-[#3925b5]">
            Add +
        </a>

    </main>

</div>

<x-footer></x-footer>

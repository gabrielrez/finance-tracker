<x-head></x-head>

<div class="max-w-2xl mx-auto">
    <x-layout.header></x-layout.header>

    <main class="px-4 mt-8">
        <h1 class="text-center text-[2rem] sm:text-[3rem] font-extrabold font-poppins">New Transaction</h1>

        <form action="{{ route('transactions.store') }}" class="mt-5 md:max-w-lg md:mx-auto" method="POST">
            @csrf
            <div class="flex gap-5 items-end">
                <div class="w-full">
                    <label class="block font-semibold text-base text-[#9D9EA2]" for="type">Type</label>
                    <select class="text-[#1E1E1E] border-2 bg-[#EFF1F3] border-[#dadee2] px-2 mt-2.5 w-full min-h-12 h-full rounded-2xl hover:bg-[#dadee2] duration-150" name="type" required>
                        @foreach (App\Enums\TransactionType::cases() as $type)
                            <option value="{{ $type }}">
                                {{ $type->value === 'income' ? '↗️' : '↘️' }}
                                {{ ucfirst($type->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-8 w-full">
                    <label class="block font-semibold text-base text-[#9D9EA2]" for="amount">Amount (R$)</label>
                    <input
                        class="border-2 border-[#EFF1F3] px-2 mt-2.5 w-full min-h-12 h-full rounded-2xl"
                        type="text"
                        name="amount"
                        placeholder="25,50"
                        required
                        inputmode="decimal"
                        pattern="^\d+([,]\d{1,2})?$"
                    >
                </div>
            </div>
            <div class="mt-8">
                <div class="flex justify-between items-baseline">
                    <label class="block font-semibold text-base text-[#9D9EA2]" for="category_id">Category</label>
                    <a href="#" class="inline-block text-sm underline text-[#9D9EA2] mt-2 text-right">Add Category +</a>
                </div>
                <select class="text-[#1E1E1E] border-2 bg-[#EFF1F3] border-[#dadee2] px-2 mt-2.5 w-full min-h-12 h-full rounded-2xl hover:bg-[#dadee2] duration-150" name="category_id" required>
                    @foreach (user()->categories as $category) 
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-8">
                <label class="block font-semibold text-base text-[#9D9EA2]" for="description">Description</label>
                <input class="border-2 border-[#EFF1F3] px-2 mt-2.5 w-full min-h-12 h-full rounded-2xl" type="text"
                    name="description" placeholder="A short description...">
            </div>
            <div class="mt-8">
                <label class="block font-semibold text-base text-[#9D9EA2]" for="date">Date</label>
                <input
                    class="border-2 border-[#EFF1F3] px-2 mt-2.5 w-full min-h-12 h-full rounded-2xl"
                    type="date"
                    name="date"
                    id="date"
                    value="{{ old('date', now()->format('Y-m-d')) }}"
                    placeholder="DD/MM/YYYY"
                    required
                >
            </div>
            @if ($errors->any())
                <div class="text-[#FE5857] mt-5">
                    <ul class="list-disc list-inside">  
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit"
                class="inline-block font-poppins w-full text-center rounded-2xl mt-12 mb-5 bg-gradient-to-t from-[#2C18B0] to-[#422DC8] text-white text-base font-extrabold py-3 px-14 transition duration-150 hover:from-[#251499] hover:to-[#3925b5] cursor-pointer">
                Add Transaction
            </button>
        </form>
    </main>
</div>

<x-footer></x-footer>

<x-head></x-head>

<div class="max-w-2xl mx-auto">

    <x-layout.header></x-layout.header>

    <main class="px-4 mt-8 text-center">
        <h1 class="text-[2rem] sm:text-[3rem] font-extrabold font-poppins">Track your spending.<br>Take control.</h1>
        <p class="mt-5">Document your incomes and outcomes, and get smart insights through clear, easy-to-read stats.
        </p>
        @guest
            <a href="{{ route('login') }}"
                class="inline-block font-poppins rounded-2xl mt-10 bg-gradient-to-t from-[#2C18B0] to-[#422DC8] text-white text-base font-extrabold py-3 px-14 transition duration-150 hover:from-[#251499] hover:to-[#3925b5]">Get
                Started</a>
        @endguest

        @auth
            <a href="{{ route('home') }}"
                class="inline-block font-poppins rounded-2xl mt-10 bg-gradient-to-t from-[#2C18B0] to-[#422DC8] text-white text-base font-extrabold py-3 px-14 transition duration-150 hover:from-[#251499] hover:to-[#3925b5]">Get
                Started</a>
        @endauth
    </main>

    <section class="mx-auto mt-16">
        <img class="mx-auto" src="{{ asset('img/lp.png') }}" alt="Expenses Tracker">
    </section>

    <footer class="mb-5">
        <p class="text-center text-sm text-[#9D9EA2] font-light">© 2025 Expenses Tracker</p>
    </footer>

</div>

<x-footer></x-footer>

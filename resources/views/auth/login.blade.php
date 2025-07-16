<x-head></x-head>

<div class="max-w-2xl mx-auto">

    <x-layout.header></x-layout.header>

    <main class="px-4 mt-8">
        <h1 class="text-center text-[2rem] sm:text-[3rem] font-extrabold font-poppins">Login</h1>
        <form action="{{ route('login') }}" class="mt-12 md:max-w-lg md:mx-auto" method="POST">
            @csrf
            <div>
                <label class="block font-semibold text-base text-[#9D9EA2]" for="email">E-mail</label>
                <input class="border-2 border-[#EFF1F3] px-2 mt-2.5 w-full min-h-12 h-full rounded-2xl" type="email"
                    name="email" placeholder="expenses@tracker.com">
            </div>
            <div class="mt-8">
                <label class="block font-semibold text-base text-[#9D9EA2]" for="password">Password</label>
                <input class="border-2 border-[#EFF1F3] px-2 mt-2.5 w-full min-h-12 h-full rounded-2xl" type="password"
                    name="password" placeholder="************">
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
                Login
            </button>
            <p class="text-center mb-10">Dont’t have an account? <a href="{{ route('register') }}"
                    class="text-[#422DC8] font-bold underline">Create Account</a></p>
        </form>
    </main>

</div>

<x-footer></x-footer>

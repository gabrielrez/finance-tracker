<header class="px-4 mt-8">
    <div class="flex justify-between items-center">
        @auth
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/icons/logo-2.svg') }}" alt="Logo">
            </a>
        @endauth

        @guest
            <a href="/">
                <img src="{{ asset('img/icons/logo-2.svg') }}" alt="Logo">
            </a>
        @endguest

        @auth
            @if (Route::currentRouteName() !== 'profile.index')
                <a href="{{ route('profile.index') }}" class="flex gap-3 items-center hover:underline">
                    <span class="text-sm font-medium">
                        {{ user()?->username }}
                    </span>
                    <img class="max-w-10 rounded-full" src="{{ asset(user()?->profile_picture) }}" alt="Profile picture">
                </a>
            @endif
        @endauth

        @guest
            <x-layout.menu></x-layout.menu>
        @endguest

    </div>
    <span class="block bg-[#EFF1F3] h-0.5 w-full mt-5"></span>
</header>

<x-head></x-head>

<div class="max-w-2xl mx-auto">
    <x-layout.header></x-layout.header>

    <main class="px-4 mt-12 flex flex-col items-center text-center">
        <section>
            <div class="relative group cursor-pointer hover:scale-95 transition duration-150" onclick="document.getElementById('photo-modal').classList.remove('hidden')">
                <img 
                    src="{{ asset(user()?->profile_picture) }}" 
                    alt="Foto de perfil"
                    class="w-32 h-32 rounded-full object-cover shadow-md"
                >
                <div class="absolute bottom-0 right-0 bg-white p-1 rounded-full shadow group-hover:scale-125 transition duration-300">
                    <img src="{{ asset('img/icons/edit.svg') }}" alt="Editar foto" class="w-5 h-5">
                </div>
            </div>

            <h2 class="mt-3 text-xl font-semibold font-poppins">
                {{ user()?->username }}
            </h2>
        <section>
    </main>

    <section class="mt-12 px-4">
        <div class="bg-[#EFF1F3] rounded-2xl pt-5">
            <div class="px-4">
                <h3 class="text-xl font-poppins text-[#9D9EA2]">Settings</h3>
                <div class="mt-6">
                    <button 
                        id="edit-profile-btn"
                        type="button"
                        class="w-full py-5 cursor-pointer text-[#9d9ea2] font-semibold flex gap-2 items-center hover:underline transaction">
                        <img src="{{ asset('img/icons/profile-edit.svg') }}" class="w-5 h-5"> 
                        Edit Profile
                    </button>
                    
                    <span class="block h-[1px] w-full bg-[#e3e6ea]"></span>
                    
                    <form action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-5 cursor-pointer text-[#FE5857] font-semibold flex gap-2 items-center hover:underline transaction">
                            <img src="{{ asset('img/icons/exit.svg') }}" class="w-5 h-5"> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="photo-modal" class="fixed px-4 inset-0 z-50 bg-black/50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-2xl w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4 text-center font-poppins">Choose a profile picture</h3>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach (File::files(public_path('img/profile-pics')) as $pic)
                <form method="POST" action="{{ route('profile.picture.update') }}">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" name="profile_picture" value="img/profile-pics/{{ $pic->getFilename() }}">
                    <button type="submit" class="block w-full cursor-pointer">
                        <img 
                            src="{{ asset('img/profile-pics/' . $pic->getFilename()) }}" 
                            alt="Foto"
                            class="w-20 h-20 rounded-full object-cover {{ user()->profile_picture === 'img/profile-pics/' . $pic->getFilename() ? 'border-4 border-[#2C18B0]' : 'border-2 border-[#EFF1F3]' }} hover:scale-110 transition"
                        >
                    </button>
                </form>
            @endforeach
        </div>
        <button onclick="document.getElementById('photo-modal').classList.add('hidden')" class="mt-10 w-full bg-[#EFF1F3] py-2 rounded-xl hover:bg-[#dadee2] cursor-pointer">
            Cancelar
        </button>
    </div>
</div>

<div 
    id="edit-profile-modal" 
    class="fixed px-4 inset-0 z-50 bg-black/50 flex items-center justify-center hidden"
    x-cloak
>
    <div class="bg-white p-6 rounded-2xl w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4 text-center font-poppins">Edit Profile</h3>

        <form method="POST" action="{{ route('profile.update') }}">
            @method('PUT')
            @csrf

            <label for="username" class="block text-left text-sm font-medium text-gray-700 mb-1">
                Username
            </label>
            <input
                id="username"
                name="username"
                type="text"
                value="{{ old('username', user()->username) }}"
                class="w-full px-3 py-2 rounded-xl border border-[#E3E6EA] focus:outline-none focus:ring-2 focus:ring-[#2C18B0] focus:border-transparent"
                required
            >

            @error('username')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="mt-6 flex gap-3">
                <button 
                    type="button"
                    onclick="document.getElementById('edit-profile-modal').classList.add('hidden')"
                    class="w-1/2 bg-[#EFF1F3] py-2 rounded-xl hover:bg-[#dadee2] cursor-pointer"
                >
                    Cancelar
                </button>

                <button 
                    type="submit"
                    class="w-1/2 font-poppins bg-gradient-to-t from-[#2C18B0] to-[#422DC8] text-white py-2 rounded-xl transition duration-150 hover:from-[#251499] hover:to-[#3925b5] cursor-pointer"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('edit-profile-btn');
        const modal   = document.getElementById('edit-profile-modal');
        if (editBtn && modal) {
            editBtn.addEventListener('click', function (e) {
                e.preventDefault();
                modal.classList.remove('hidden');
                const input = modal.querySelector('#username');
                if (input) { setTimeout(() => input.focus(), 50); }
            });
        }
    });
</script>

<x-footer></x-footer>

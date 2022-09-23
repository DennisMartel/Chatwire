<x-guest-layout>
    <div class="h-screen bg-gray-100 flex flex-col justify-center items-center">
        <div class="bg-white mb-3 border border-gray-300 w-80 pt-8 pb-4 flex flex-col items-center">
            <h1 class="text-2xl font-semibold">Chatwire</h1>
            <form method="POST" action="{{ route('register') }}" class="w-64 flex flex-col gap-1 mt-8">
                @csrf
                <div class="relative">
                    <x-jet-input id="name" class="w-full rounded border border-gray-300 p-3 text-xs focus:border-gray-400 ring-0 focus:ring-0 bg-gray-50 peer placeholder-transparent" placeholder="Usuario" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    @error('name')
                        <span class="text-red-600 text-xs space-y-2">{{ $message }}</span>
                    @enderror
                    <x-jet-label for="name" value="Usuario" class="absolute transition-all left-2 top-0 text-gray-500 text-xxs pl-1 peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 pointer-events-none" />
                </div>

                <div class="relative">
                    <x-jet-input id="email" class="w-full rounded border border-gray-300 p-3 text-xs focus:border-gray-400 ring-0 focus:ring-0 bg-gray-50 peer placeholder-transparent" placeholder="Correo electrónico" type="email" name="email" :value="old('email')" required />
                    @error('email')
                        <span class="text-red-600 text-xs space-y-2">{{ $message }}</span>
                    @enderror
                    <x-jet-label for="email" value="Correo electrónico" class="absolute transition-all left-2 top-0 text-gray-500 text-xxs pl-1 peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 pointer-events-none" />
                </div>
                
                <div class="relative">
                    <x-jet-input id="password" class="w-full rounded border border-gray-300 p-3 text-xs focus:border-gray-400 ring-0 focus:ring-0 bg-gray-50 peer placeholder-transparent" placeholder="Contraseña"  type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <span class="text-red-600 text-xs space-y-2">{{ $message }}</span>
                    @enderror
                    <x-jet-label for="password" value="Contraseña" class="absolute transition-all left-2 top-0 text-gray-500 text-xxs pl-1 peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 pointer-events-none" />
                </div>
                
                <div class="relative">
                    <x-jet-input id="password_confirmation" class="w-full rounded border border-gray-300 p-3 text-xs focus:border-gray-400 ring-0 focus:ring-0 bg-gray-50 peer placeholder-transparent" placeholder="Confirmar contraseña" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <span class="text-red-600 text-xs space-y-2">{{ $message }}</span>
                    @enderror
                    <x-jet-label for="password_confirmation" value="Confirmar contraseña" class="absolute transition-all left-2 top-0 text-gray-500 text-xxs pl-1 peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 pointer-events-none" />
                </div>
                <x-jet-button class="bg-blue-300 hover:bg-blue-300 active:bg-blue-300 shadow-none border-none active:ring-0 flex justify-center mt-2 font-bold">
                    Registrarte
                </x-jet-button>
                <div class="flex space-x-2 items-center mt-4">
                    <span class="flex-1 h-px bg-gray-300"></span>
                    <span class="text-gray-400 text-base font-semibold">O</span>
                    <span class="flex-1 h-px bg-gray-300"></span>
                </div>
            </form>
            <div class="mt-4">
                <a href="{{ url("login/facebook") }}" class="text-white bg-blue-900 p-2 rounded-lg hover:bg-blue-800 font-bold text-sm"><i class="fab fa-facebook"></i> Registrarte con Facebook</a>
            </div>
            <div class="mt-4">
                <a href="{{ url("login/google") }}" class="text-white bg-gray-500 p-2 rounded-lg hover:bg-gray-600 font-bold text-sm">G Registrarte con Google</a>
            </div>
        </div>

        @if (Route::has('register'))
            <div class="mt-1 border border-gray-300 p-4 bg-white w-80 flex items-center justify-center text-sm font-semibold">
                <p>¿Tienes una cuenta? <a href="{{ route('login') }}" class="text-blue-600">Inicia sesión</a></p>
            </div>
        @endif
    </div>
</x-guest-layout>

<x-guest-layout>
    <div class="h-screen bg-gray-100 flex flex-col justify-center items-center">
        <div class="bg-white mb-3 border border-gray-300 w-80 pt-8 pb-4 flex flex-col items-center">
            <h1 class="text-2xl font-semibold">Chatwire</h1>
            <form method="POST" action="{{ route('password.update') }}" class="w-64 flex flex-col gap-1 mt-8">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                    Restablecer la contraseña
                </x-jet-button>
            </form>
        </div>
    </div>
</x-guest-layout>

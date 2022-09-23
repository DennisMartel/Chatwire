<x-guest-layout>
    <div class="h-screen bg-gray-100 flex flex-col justify-center items-center">
        <div class="bg-white mb-3 border border-gray-300 w-1/3 pt-8 pb-4 flex flex-col items-center">
            <h1 class="text-2xl font-semibold">Chatwire</h1>            
            <form method="POST" action="{{ route('password.email') }}" class="w-96 flex flex-col gap-1 mt-8">
                @csrf

                <div class="mb-4 text-sm text-gray-600 text-center">
                    ¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace de restablecimiento de contraseña que le permitirá elegir una nueva.
                </div>
        
                @if (session('status'))
                    <div class="mb-4 font-semibold text-sm text-green-600">
                        ¡Le hemos enviado un correo electrónico con su enlace de restablecimiento de contraseña!
                    </div>
                @endif
                <div class="relative">
                    <x-jet-input id="email" class="w-full rounded border border-gray-300 p-3 text-xs focus:border-gray-400 ring-0 focus:ring-0 bg-gray-50 peer placeholder-transparent" placeholder="Correo electrónico" type="email" name="email" :value="old('email')" required autofocus />
                    @error('name')
                        <span class="text-red-600 text-xs space-y-2">{{ $message }}</span>
                    @enderror
                    <x-jet-label for="email" value="Correo electrónico"  class="absolute transition-all left-2 top-0 text-gray-500 text-xxs pl-1 peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 pointer-events-none" />
                </div>

                <x-jet-button class="bg-blue-300 hover:bg-blue-300 active:bg-blue-300 shadow-none border-none active:ring-0 flex justify-center mt-2 font-bold">
                    Enlace de restablecimiento de contraseña de correo electrónico
                </x-jet-button>
                <div class="flex space-x-2 items-center mt-4">
                    <span class="flex-1 h-px bg-gray-300"></span>
                    <span class="text-gray-400 text-base font-semibold">O</span>
                    <span class="flex-1 h-px bg-gray-300"></span>
                </div>
            </form>
            <div class="mt-4">
                <a href="{{ route('register') }}" class="text-gray-700 font-bold text-sm">Crear cuenta nueva</a>
            </div>
        </div>
    </div>
</x-guest-layout>

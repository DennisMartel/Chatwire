<x-app-layout>
    <div class="container mx-auto max-w-4xl mt-5 px-5">
        <div class="bg-white shadow-sm p-4 rounded-lg">
            <div class="relative flex flex-row items-stretch flex-shrink-0  select-none">
                <div class="basis-0 flex-grow sm:mr-8">
                    <div class="mx-auto w-32 h-32">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-full shadow-md">
                    </div>
                </div>
                <section class="basis-1/2 flex-grow">
                    <div class="flex flex-col sm:flex-row sm:items-center max-w-max">
                        <h2 class="text-gray-500 text-2xl font-medium truncate sm:mr-6">{{ $user->name }}</h2>
                        @if (Auth::user()->id === $user->id)
                            <a class="bg-blue-500 text-white rounded-md p-1 border-transparent text-sm hover:bg-blue-400 font-semibold max-w-max" href="{{ route('profile.show') }}">
                                <i class="fas fa-cog"></i> Editar perfil
                            </a>
                        @else
                            <a class="bg-blue-500 text-white rounded-md cursor-pointer p-1 border-transparent text-sm hover:bg-blue-400 font-semibold max-w-max">
                                <i class="fas fa-user-plus"></i> Enviar solicitud
                            </a>
                        @endif
                    </div>
                    <div class="h-4"></div>
                    <ul class="sm:flex flex-row">
                        <li class="mr-10">
                            <p>
                                <span class="font-bold">{{ $user->posts()->count() }}</span> 
                                {{ $user->posts()->count() == 1 ? 'publicación' : 'publicaciones' }}
                            </p>
                        </li>
                        <li class="mr-10">
                            <p>
                                <span class="font-bold">{{ $user->friends()->count() }}</span> 
                                {{ $user->friends()->count() == 1 ? 'amigo' : 'amigos' }}
                            </p>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="h-px bg-gray-300 my-6"></div>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 select-none">
                @foreach ($user->posts as $publicacion)
                    <div class="relative group cursor-pointer">
                        <img 
                            src="{{ Storage::url($publicacion->images()->pluck('url')->first()) }}" 
                            alt="{{ $publicacion->body }}"
                            class="w-full object-cover"
                        />
                        <div class="absolute inset-0 flex flex-row justify-center items-center bg-black opacity-0 group-hover:opacity-75 space-x-6">
                            <div class="text-white font-semibold">
                                <i class="fas fa-heart"></i>
                                <span>{{ $publicacion->likes()->count() }}</span>
                            </div>
                            <div class="text-white font-semibold">
                                <i class="fas fa-comment"></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
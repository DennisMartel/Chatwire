<div class="basis-1/2 hidden md:block relative">
    <div class="relative">
        <i class="fas fa-search absolute left-3 top-3 text-gray-300"></i>
        <input wire:model="search" type="text" placeholder="Buscar amigos" class="border-0 bg-gray-100 p-2 rounded-lg w-80 pl-10 align-middle focus:outline-0 placeholder:font-medium ring-0 focus:ring-0"/>
    </div>
    @if ($search)
        <div class="absolute bg-white w-full mt-1 z-50 rounded-lg drop-shadow-sm h-80 transition-all overflow-hidden">
            <ul>
                @forelse ($this->resultados as $resultado)
                    <li class="hover:bg-gray-100 w-full">
                        <a href="#" class="flex flex-row items-center p-2">
                            <img src="{{ $resultado->profile_photo_url }}" alt="{{ $resultado->name }}" class="rounded-full object-cover h-11 w-11">
                            <div class="flex flex-col pl-4">
                                <p class="text-sm font-bold">{{ $resultado->name }}</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="h-80 flex justify-center items-center w-full">
                        <a class="font-medium text-sm text-gray-400">No se encontraron resultados.</a>
                    </li>
                @endforelse
            </ul>
        </div>
    @endif
</div>

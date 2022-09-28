<div class="bg-white p-3 shadow-md rounded-md mb-4">
    <form wire:submit.prevent="updatePost" method="post" enctype="multipart/form-data" class="flex flex-col">
        <div class="relative">
            <textarea class="w-full bg-gray-100 resize-none border-gray-300 focus:border-gray-400 p-3 rounded-lg text-sm ring-0 focus:ring-0 placeholder-transparent peer" wire:model.defer="publicacion.body" :value="old('body')" placeholder="¿Qué estás pensando?"></textarea>
            @error('publicacion.body')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
            <x-jet-label for="body" value="¿Qué estás pensando {{ Auth::user()->name }}?" class="absolute top-0 left-2 text-gray-500 font-semibold text-xxs pl-1 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm transition-all pointer-events-none"/>
        </div>
        <x-jet-input type="file" wire:model.defer="images" accept="image/*" multiple class="bg-gray-100 outline-none border-none mt-3" />
        @error('images.*')
            <span class="text-red-600 text-xs space-y-2">{{ $message }}</span>
        @enderror
        <x-jet-button class="flex justify-center self-end bg-blue-500 hover:bg-blue-400 active:bg-blue-400 border-none shadow-none font-bold mt-2">
            <i class="fas fa-undo mr-1"></i> Actualizar publicación
        </x-jet-button>
    </form>
    @if ($images)
        <div class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 mt-2 gap-2">
            @foreach ($images as $image)
                <img src="{{ $image->temporaryUrl() }}" alt="{{ $publicacion->body }}" class="max-w-full w-full object-cover rounded-md shadow-xl">
            @endforeach
        </div>
    @else
        <h1 class="text-sm text-gray-600 font-semibold">Imagenes</h1>
        <div class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 mt-2 gap-2">
            @foreach ($publicacion->images as $image)
                <img src="{{ Storage::url($image->url) }}" alt="{{ $publicacion->body }}" class="max-w-full w-full object-cover rounded-md shadow-xl">
            @endforeach
        </div>
    @endif
</div>

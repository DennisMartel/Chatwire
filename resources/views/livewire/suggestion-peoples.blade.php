<div class="mt-8">
    <p class="font-semibold text-gray-700 mb-2 text-sm">Sugerencias</p>
    @foreach ($personas as $persona)
        <div class="flex flex-row {{ $loop->last ? '' : 'mb-4' }}">
            <a href="{{ route('profile.index', $persona) }}">
                <img src="{{ $persona->profile_photo_url }}" alt="{{ $persona->name }}" class="rounded-full object-cover w-11 h-11 border-2">
            </a>
            <div class="pl-2">
                <div class="text-sm font-medium">
                    <a href="#" class="truncate">
                        {{ $persona->name }}
                    </a>
                </div>
                <a class="text-blue-500 text-sm font-bold cursor-pointer" wire:click.prevent="sendFriendRequest({{ $persona->id }})">Enviar solicitud</a>
            </div>
        </div>
    @endforeach
</div>

<div>
    @forelse ($publicaciones as $publicacion)
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="p-3 flex flex-row items-center">
                <div class="flex-1">
                    <a href="">
                        <img src="{{ $publicacion->user->profile_photo_url ?? asset('images/defaul-pic.webp') }}" alt="Avatar" class="rounded-full w-8 h-8 inline">
                        <span class="font-bold text-sm ml-2">
                            {{ $publicacion->user->name }}
                        </span>
                    </a>
                </div>
                @can('myPost', $publicacion)
                    <div class="relative">
                        <x-jet-dropdown width="48">
                            <x-slot name="trigger">
                                <a class="cursor-pointer">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                            </x-slot>

                            <x-slot name="content">
                                <x-jet-dropdown-link class="align-middle cursor-pointer" wire:click="$emit('showAlertRemovePost', {{ $publicacion->id }})">
                                    <i class="fas fa-trash-alt mr-1"></i> Borrar
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('posts.edit', $publicacion) }}">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endcan
            </div>
            <div class="owl-carousel owl-theme" wire:ignore>
                @foreach ($publicacion->images->pluck('url') as $image)
                    <img data-src="{{ Storage::url($image) }}" alt="{{ $image }}" class="w-full object-cover owl-lazy item">
                @endforeach
            </div>
            <div class="p-3 flex flex-row text-2xl">
                <div class="flex-1">
                    <div class="flex items-center" 
                        x-data="{ 
                            likeCount: @json($publicacion->likes()->count()), 
                            isLiked: @json(Auth::user()->hasLikedPost($publicacion)),
                            toggleLike: function() 
                            {
                                if(this.isLiked)
                                {
                                    this.likeCount--;
                                    this.isLiked = false;
                                }
                                else 
                                {
                                    this.likeCount++;
                                    this.isLiked = true;
                                }
                            }
                        }"
                    >
                        <a @click.prevent="toggleLike; $wire.toggleLike({{ $publicacion->id }})" class="cursor-pointer" :class="isLiked ? 'text-red-600' : 'text-gray-600'">
                            <i :class="isLiked ? 'fas' : 'far'" class="fa-heart"></i>
                        </a>
                        <div class="font-bold text-sm ml-2"><span x-text="likeCount"></span> Me gusta</div>
                    </div>
                    {{-- <a href="" class="mr-4 text-gray-600 hover:text-gray-500 cursor-pointer">
                        <i class="far fa-comment"></i>
                    </a>
                    <a href="" class="mr-4 text-gray-600 hover:text-gray-500 cursor-pointer">
                        <i class="far fa-paper-plane"></i>
                    </a> --}}
                </div>
                <div class="">
                    <a href="" class="mr-4 text-gray-600 hover:text-gray-500 cursor-pointer">
                        <i class="far fa-bookmark"></i>
                    </a>
                </div>
            </div>
            
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-16">
            <p class="text-center text-gray-500 font-semibold">No tienes publicaciones aún</p>
        </div>
    @endforelse

    <div x-data="{
        observe() {
            const observer = new IntersectionObserver((publicaciones) => {
                publicaciones.map(publicacion => {
                    if(publicacion.isIntersecting)
                    {
                        @this.loadMorePosts()
                    }
                })
            })
            observer.observe(this.$el)
        }
    }" x-init="observe">

    </div>
</div>
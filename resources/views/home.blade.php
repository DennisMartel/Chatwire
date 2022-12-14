<x-app-layout>
    <main class="container mx-auto max-w-4xl mt-5">
        <div class="grid grid-cols-3 gap-10">
            <div class="px-3 sm:px-8 md:px-12 lg:px-0 col-span-3 lg:col-span-2">
                @livewire('posts')
            </div>

            <div class="col-span-1 hidden lg:block">
                <div class="sticky top-24 rounded-lg p-3 bg-white shadow-md">
                    <div class="flex flex-row items-center">
                        <a href="{{ route('profile.show') }}">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('images/defaul-pic.webp') }}" alt="{{ Auth::user()->name ?? 'avatar' }}" class="border-2 h-11 w-11 rounded-full object-cover">
                        </a>
                        <div class="pl-1">
                            <div class="text-sm font-medium">
                                <a href="{{ route('profile.show') }}" class="truncate">
                                    {{ Auth::user()->email }}
                                </a>
                            </div>
                            <div class="text-gray-500 text-sm leading-4 truncate">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>
                    @livewire('suggestion-peoples')
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            const loadOwlcarousel = () => {
                $('.owl-carousel').owlCarousel({
                    items: 1,
                    lazyLoad:true,
                    loop:false,
                    nav:true,
                    animateOut: 'fadeOut',
                    touchDrag  : false,
                    mouseDrag  : false
                })
            }
            loadOwlcarousel();
            
            document.addEventListener('livewire:load', function () {
                Livewire.on('loadOwlCarousel', () => {
                    loadOwlcarousel();
                });
            });

            Livewire.on('showAlertRemovePost', id => {
                Swal.fire({
                    title: '',
                    text: "{{ Auth::user()->name }} est??s seguro de borrar la publicaci??n",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'S??, deseo borrarla!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('posts', 'removePost', id)
                        Swal.fire(
                            '',
                            'La publicaci??n ha sido eliminada.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</x-app-layout>
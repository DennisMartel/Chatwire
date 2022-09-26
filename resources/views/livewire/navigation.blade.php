<header class="sticky top-0 min-h-fit bg-white w-full border border-b-2 z-50">
    <div class="container max-w-5xl mx-auto">
        <div class="flex flex-row py-2 items-center">
            <div class="basis-1/2 pl-3 lg:p-0">
                <a href="/">
                    <h1 class="text-2xl font-semibold">Test</h1>
                </a>
            </div>

            @livewire('search')

            <nav class="basis-1/2">
                <ul class="flex flex-row p-2 text-2xl space-x-6 justify-end">
                    <li>
                        <a href="/">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="">
                            <i class="far fa-comment"></i>
                        </a>
                    </li> -->
                    <li>
                        <a href="{{ route('posts.create') }}">
                            <i class="far fa-plus-square"></i>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="">
                            <i class="fa fa-compass"></i>
                        </a>
                    </li> -->
                    <li>
                        <a href="">
                            <i class="far fa-bell"></i>
                        </a>
                    </li>
                    <div class="relative">
                        <x-jet-dropdown width="60">
                            <x-slot name="trigger">
                                <button class="flex text-sm border border-gray-300 rounded-full focus:outline-none focus:border-black transition">
                                    <img class="h-7 w-7 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/defaul-pic.webp') }}" alt="{{ Auth::user()->name ?? 'avatar' }}" />
                                </button>
                            </x-slot>
    
                            <x-slot name="content">
                                <x-jet-dropdown-link class="align-middle" href="{{ route('profile.show') }}">
                                    <i class="far fa-user-circle mr-1"></i> Perfil
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    <i class="fas fa-cog mr-1"></i> Configuración
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    <i class="fas fa-info mr-3"></i> Reportar un problema
                                </x-jet-dropdown-link>
                                <div class="border-t border-gray-300"></div>    
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
    
                                    <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        Salir
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </ul>
            </nav>
        </div>
    </div>
</header>
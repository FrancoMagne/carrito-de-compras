{{-- <style>

    #navigation-menu {
        height: calc(100vh - 4rem);
    }

</style> --}}

<header class="bg-blue-900 sticky top-0 z-50" x-data="{open: false}">
    
    <div class="container flex items-center h-16 justify-between md:justify-start">

        <a x-on:click="open = true"
            :class="{'bg-white bg-opacity-25': open}"
            class="flex flex-col items-center justify-center px-6 md:px-4 order-last md:order-first text-white cursor-pointer font-semibold h-full">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <span class="text-sm hidden md:block"> Categorias </span>
        </a>

        <a href="/" class="mx-6">
            <img class="block lg:hidden h-12 w-auto" src="{{asset('DI_logo.png')}}" alt="DIUNSa">
            <img class="hidden lg:block h-12 w-auto" src="{{asset('DI_logo.png')}}" alt="DIUNSa">
        </a>
        
        <div class="flex-1 hidden md:block">
            @livewire('search')
        </div>


        <div class="mx-6 hidden md:block">
            @livewire('dropdown-cart')
        </div>
        
        <div class="relative hidden md:block">
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-700">
                            {{ __('Bienvenido '.Auth::user()->name) }}
                        </div>

                        <!-- Opciones de Administrador -->
                        @can('usuarios')
                            <x-jet-dropdown-link href="{{ route('admin.users.index') }}">
                                {{ __('Panel de Control') }}
                            </x-jet-dropdown-link>
                        @endcan

                        <!-- Opciones de Vendedor -->
                        @can('articulos')
                            <x-jet-dropdown-link href="{{ route('articulos.index') }}">
                                {{ __('Articulos') }}
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('ventas.index') }}">
                                {{ __('Ordenes') }}
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Cuenta') }}
                            </x-jet-dropdown-link>
                        @endcan

                        <!-- Opciones de Cliente -->
                        @can('compras')
                            <x-jet-dropdown-link href="{{ route('orders.index') }}">
                                {{ __('Mis Compras') }}
                            </x-jet-dropdown-link>
                        @endcan

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            @else 
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Iniciar Sesión') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Registrarse') }}
                        </x-jet-dropdown-link>

                    </x-slot>
                </x-jet-dropdown>
            @endauth

        </div>

    </div>

    <nav id="navigation-menu" 
        :class="{'block': open, 'hidden': !open}"
        class="container w-full md:w-auto absolute hidden">

        {{-- Menu Computer --}}
        <div class="container h-auto hidden md:block">
            <div x-on:click.away="open = false" class="grid grid-cols-1 h-auto">
                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center">
                            <a href="{{ route('category.show', $category)}}" class="py-2 px-4 text-sm flex items-center">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Menu Mobil --}}
        <div 
            x-on:click="open = true"
            x-on:click.away="open = false"
            class="bg-white h-auto md:hidden overflow-y-auto z-50">

            <div class="container bg-gray-300 py-3 mb-2">
                @livewire('search')
            </div>
            
            <div class="block text-sm md:text-xs text-blue-700 md:text-gray-700 px-4 py-2">
                {{ __('Categorias') }}
            </div>
            <ul>
                @foreach ($categories as $category)
                    <li class="text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center">
                        <a href="{{ route('category.show', $category)}}" class="py-2 px-6 text-sm flex items-center">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            
            @auth
                <div class="block text-sm md:text-xs text-blue-700 md:text-gray-700 px-4 my-2">
                    {{ __('Bienvenido '.Auth::user()->name) }}
                </div>
                
                @livewire('cart-mobil')

                <!-- Opciones de Administrador -->
                @can('usuarios')
                    <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('admin.users.index') }}">
                        {{ __('Panel de Control') }}
                    </x-jet-dropdown-link>
                @endcan

                <!-- Opciones de Vendedor -->
                @can('articulos')
                    <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('articulos.index') }}">
                        {{ __('Articulos') }}
                    </x-jet-dropdown-link>

                    <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('ventas.index') }}">
                        {{ __('Ordenes') }}
                    </x-jet-dropdown-link>

                    <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('profile.show') }}">
                        {{ __('Cuenta') }}
                    </x-jet-dropdown-link>
                @endcan
                
                <!-- Opciones de Cliente -->
                @can('compras')
                    <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('orders.index') }}">
                        {{ __('Mis Compras') }}
                    </x-jet-dropdown-link>
                @endcan
                
                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-jet-dropdown-link>
                </form>
            @else
                <div class="block text-sm md:text-xs text-blue-700 md:text-gray-700 px-4 my-2">
                    {{ __('Opciones de Sesión') }}
                </div>

                @livewire('cart-mobil')

                <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('login') }}">
                    {{ __('Iniciar Sesión') }}
                </x-jet-dropdown-link>

                <x-jet-dropdown-link class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" href="{{ route('register') }}">
                    {{ __('Registrarse') }}
                </x-jet-dropdown-link>
            @endauth
            
        </div>

    </nav>

</header>


{{-- <nav class="bg-blue-900" x-data="{open: false}">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
        
            <!-- Mobile menu button-->
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button x-on:click="open = true" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed. -->
                    <!--
                    Heroicon name: outline/menu
        
                    Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open. -->
                    <!--
                    Heroicon name: outline/x
        
                    Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">

                <!-- Logotipo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        <img class="block lg:hidden h-8 w-auto" src="{{asset('DI_logo.png')}}" alt="DIUNSa">
                        <img class="hidden lg:block h-8 w-auto" src="{{asset('DI_logo.png')}}" alt="DIUNSa">
                    </a>
                </div>

                <!-- Menu  -->
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="/" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">INICIO</a>
                        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">ARTICULOS</a>
                        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">CONTACTO</a>
                    </div>
                </div>
            </div>
            
            @auth
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    
                    <!-- Boton Notificacion -->
                    <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
        
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button x-on:click="open = true" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url}}" alt="">
                            </button>
                        </div>
                        <!--
                        Profile dropdown panel, show/hide based on dropdown state.
            
                        Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                        Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                        -->
                        <div x-show="open" x-on:click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            
                            @can('articulos')
                                <a href="{{ route('articulos.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mis Articulos</a>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Cuenta</a>
                            @endcan

                            @can('usuarios')
                                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Panel de Control</a>
                            @endcan

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" 
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    Cerrar Sesión 
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            
            @else
                <div>
                    <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarse</a>
                </div>

            @endauth

        </div>
    </div>
  
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away="open = false">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">INICIO</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">ARTICULOS</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">CONTACTO</a>
        </div>
    </div>
</nav> --}}
  
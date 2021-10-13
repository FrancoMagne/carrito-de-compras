<div>
    <x-jet-dropdown-link 
        class="px-6 text-gray-900 hover:bg-blue-300 hover:text-gray-700 justify-center" 
        href="{{ route('shopping-cart') }}">
        <span class="relative inline-block pr-4">
            {{ __('Carrito de Compras') }}
            @if (Cart::count())
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{Cart::count()}}</span>
            @else 
                <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
            @endif 
        </span>
    </x-jet-dropdown-link>
</div>

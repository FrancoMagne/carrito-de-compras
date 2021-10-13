<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <x-cart size="30" color="white"/>
                    @if (Cart::count())
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{Cart::count()}}</span>
                    @else 
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                    @endif 
            </span>
        </x-slot>

        <x-slot name="content">
            <ul class="overflow-y-auto {{ Cart::content()->count() > 4 ? 'h-80' : 'h-auto'}}">
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{asset($item->options->image)}}" alt="{{$item->name}}">
                        <article class="flex-1">
                            <h1 class="font-bold"> {{ $item->name }}</h1>
                            <p class="text-md text-sm"> Cantidad: {{ $item->qty }}</p>
                            <p class="text-sm"> $ {{ $item->price }}</p>
                        </article>

                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700"> NO HAY ARTICULOS EN EL CARRITO </p>
                    </li>
                @endforelse
            </ul>
            
            @if (Cart::count())
                <div class="py-2 px-3">
                    <p class="text-lg text-gray-700 mt-2 mb-2"> <span class="font-bold">Total:</span> $ {{ Cart::subtotal() }}</p>
                
                    <x-button-enlace 
                        href="{{ route('shopping-cart')}}" 
                        class="w-full bg-blue-600 hover:bg-blue-400">
                            <span class="fas fa-shopping-cart mr-2"></span> 
                            Ver Carrito
                    </x-button-enlace>
                </div>
            @endif
            
        </x-slot>
    </x-jet-dropdown>
</div>

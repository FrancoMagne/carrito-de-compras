<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="text-lg font-semibold text-center"> Mi Carrito de Compras</h1>

            @if (Cart::count())
                <div class="flex items-center justify-center">
                    <div class="container w-full">
                        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                            <thead class="text-white">

                                @foreach (Cart::content() as $item)
                                    <tr class="bg-gray-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                        <th class="p-3 text-center">Articulo</th>
                                        <th class="p-3 text-center">Precio</th>
                                        <th class="p-3 text-center">Cantidad</th>
                                        <th class="p-3 text-center">Total</th>
                                    </tr>
                                @endforeach

                              </tr>
                            </thead>

                            <tbody class="flex-1 sm:flex-none text-center">

                                @foreach (Cart::content() as $item)
                                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                    <td class="border-grey-light border hover:bg-gray-100 p-3">
                                        <div class="flex items-center justify-center md:justify-start">
                                            <img class="hidden md:block md:h-15 md:w-20 object-cover md:mr-4" src="{{asset($item->options->image)}}" alt="{{$item->name}}">
                                            <div>
                                                <p class="font-bold"> {{$item->name}}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">
                                        <a class="cursor-pointer hover:text-red-600" 
                                            wire:click="delete('{{$item->rowId}}')"
                                            wire:loading.class="text-red-600 opacity-25"
                                            wire:target="delete('{{$item->rowId}}')"> 
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <span class="ml-6"> $ {{$item->price}}</span>
                                    </td>

                                    <td class="border-grey-light border p-2 hover:font-medium">
                                        <div class="flex justify-center">
                                            @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                        </div>
                                    </td>

                                    <td class="border-grey-light border p-3 hover:font-medium">
                                        <div class="flex justify-center">
                                            $ {{ $item->price * $item->qty }}
                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
        
                <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" wire:click="destroy">
                    <i class="fas fa-trash"></i> 
                    Borrar Carrito de Compras 
                </a>

            @else
                <div class="flex flex-col items-center mt-4">
                    <x-cart />
                    <p class="text-lg text-gray-700 mt-4 text-center"> No tienes articulos agregados al carrito</p>
                    <x-button-enlace href="/" class="mt-4 px-16">
                        Ir al Inicio
                    </x-button-enlace>
                </div>
            @endif
        
    </section>

    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700"> 
                        <span class="font-bold text-lg "> Total: </span> 
                        $ {{Cart::subtotal()}}
                    </p>
                </div>
                <div>
                    <x-button-enlace href="{{ route('orders.create') }}">
                        Continuar
                    </x-button-enlace>
                </div>
            </div>
        </div>
        
    @endif
    
    <style>
        html,
        body {
          height: 100%;
        }
      
        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }
        
            thead tr:not(:first-child) {
                display: none;
            }
        }
      
        td:not(:last-child) {
          border-bottom: 0;
        }
      
        th:not(:last-child) {
          border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
      </style>

</div>

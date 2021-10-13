<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">
            
            <div class="relative">
                <div class="{{ ($orden->status >= 2 && $orden->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-credit-card text-white"></i>
                </div>

                <div class="absolute mt-0.5">
                    <p> Espera </p>
                </div>
            </div>

            <div class="{{ ($orden->status >= 3 && $orden->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} h-1 flex-1 mx-2"> </div>

            <div class="relative">
                <div class="{{ ($orden->status >= 3 && $orden->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>

                <div class="absolute mt-0.5 -ml-1">
                    <p> Enviado </p>
                </div>
            </div>

            <div class="{{ ($orden->status >= 4 && $orden->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} h-1 flex-1 mx-2"> </div>

            <div class="relative">
                <div class="{{ ($orden->status >= 4 && $orden->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>

                <div class="absolute mt-0.5 -ml-3">
                    <p> Entregado </p>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex items-center">
            <p class="text-gray-700 uppercase font-semibold">
                Orden #{{ $orden->id }} 
            </p>

            @if ($orden->status == 1)
                <x-button-enlace href="{{ route('orders.payment', $orden)}}" class="ml-auto">
                    Pagar
                </x-button-enlace>
            @endif

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                <div> 
                    <p class="text-lg font-semibold uppercase"> Envío </p>

                    @if ($orden->shipping_type == 1)
                        <p class="text-sm"> Los articulos deben ser retirados en la tienda </p>
                        <p class="text-sm"> Calle False 123 </p>
                    @else
                    <p class="text-sm"> Los articulos serán enviados a: </p>
                    <p class="text-sm"> {{$orden->address}} </p>
                    <p class="text-sm"> {{$orden->provincia->name}} - {{$orden->departamento->name}}</p>
                    @endif
                </div>
                <div>
                    <p class="text-lg font-semibold uppercase"> Datos de Contacto </p>
                    <p class="text-sm"> Nombre: {{$orden->contact}} </p>
                    <p class="text-sm"> Telefono: {{$orden->phone}} </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6 text-gray-700">
            <p class="text-xl font-semibold mb-4"> Resumen</p>

            <div class="flex items-center justify-center">
                <div class="container w-full">
                    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                        <thead class="text-white">

                            @foreach ($items as $item)
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

                            @foreach ($items as $item)
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
                                    <span class="ml-6"> USD$ {{$item->price}}</span>
                                </td>

                                <td class="border-grey-light border p-3 hover:font-medium">
                                    <div class="flex justify-center">
                                        {{$item->qty}}
                                    </div>
                                </td>

                                <td class="border-grey-light border p-3 hover:font-medium">
                                    <div class="flex justify-center">
                                        USD$ {{ $item->price * $item->qty }}
                                    </div>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
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
</x-app-layout>
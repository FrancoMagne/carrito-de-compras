<div>
    @php
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un objeto de envio
        $shipment = new MercadoPago\Shipments();
        $shipment->cost = $orden->shipping_cost;
        $shipment->mode = 'not_specified';

        $preference->shipments = $shipment;

        // Crea una lista de ítem que tengamos en el carrito en la preferencia
        foreach ($items as $articulo) {
            $item = new MercadoPago\Item();
            $item->title = $articulo->name;
            $item->quantity = $articulo->qty;
            $item->unit_price = $articulo->price;

            $articulos[] = $item;
        }
        
        $preference->back_urls = array(
            "success" => route('orders.success', $orden)
            //"failure" => "http://www.tu-sitio/failure",
            //"pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";

        $preference->items = $articulos;
        $preference->save();

    @endphp
    
    <div class="container py-8">
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex items-center">
            <p class="text-gray-700 uppercase font-semibold">
                Orden #{{ $orden->id }} 
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                <div> 
                    <p class="text-lg font-semibold uppercase"> Envío </p>

                    @if ($orden->shipping_type == 1)
                        <p class="text-sm"> Los articulos deben ser retirados en la tienda </p>
                        <p class="text-sm"> Calle Falsa 123 </p>
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
                                    <span class="ml-6"> $ {{$item->price}}</span>
                                </td>

                                <td class="border-grey-light border p-3 hover:font-medium">
                                    <div class="flex justify-center">
                                        {{$item->qty}}
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
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6 flex justify-between items-center">
            <img class="h-14" src="{{asset('mp.png')}}" alt="Paypal y Mercado Pago">
            <div class="text-gray-700">
                <p class="text-sm font-semibold">
                    Subtotal: $ {{$orden->total - $orden->shipping_cost}}
                </p>

                <p class="text-sm font-semibold">
                    Envío: $ {{$orden->shipping_cost}}
                </p>

                <p class="text-lg font-semibold uppercase">
                    Total: $ {{$orden->total}}
                </p>

                <div class="cho-container">

                </div>
            </div>
            
        </div>


    </div>

    @push('script')
        {{-- SDK MercadoPago.js V2 --}}
        <script src="https://sdk.mercadopago.com/js/v2"></script>

        <script>
            // Agrega credenciales de SDK
            const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                    locale: 'es-AR'
            });
            
            // Inicializa el checkout
            mp.checkout({
                preference: {
                    id: "{{ $preference->id }}"
                },
                render: {
                        container: '.cho-container', // Indica dónde se mostrará el botón de pago
                        label: 'Pagar', // Cambia el texto del botón de pago (opcional)
                }
            });
            </script>
    @endpush
    

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

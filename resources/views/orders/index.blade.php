<x-app-layout>
    <div class="container p-12">
        <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 text-white">
            <a href="{{ route('orders.index')}}" class="bg-blue-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl"> {{$todas}} </p>
                <p class="uppercase text-center"> Todas </p>
                <p class="text-center text-2xl mt-2"> 
                    <i class="fas fa-folder"></i>
                </p>
            </a>

            <a href="{{ route('orders.index').'?status=1'}}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl"> {{$pendiente}} </p>
                <p class="uppercase text-center"> Pendiente </p>
                <p class="text-center text-2xl mt-2"> 
                    <i class="fas fa-business-time"></i>
                </p>
            </a>

            <a href="{{ route('orders.index').'?status=2'}}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl"> {{$recibido}} </p>
                <p class="uppercase text-center"> Espera </p>
                <p class="text-center text-2xl mt-2"> 
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('orders.index').'?status=3'}}" class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl"> {{$enviado}} </p>
                <p class="uppercase text-center"> Enviado </p>
                <p class="text-center text-2xl mt-2"> 
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('orders.index').'?status=4'}}" class="bg-pink-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl"> {{$entregado}} </p>
                <p class="uppercase text-center"> Entregado </p>
                <p class="text-center text-2xl mt-2"> 
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('orders.index').'?status=5'}}" class="bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl"> {{$anulado}} </p>
                <p class="uppercase text-center"> Anulado </p>
                <p class="text-center text-2xl mt-2"> 
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        <section class="bg-white shadow-lg rounded-lg px-4 md:px-8 lg:px-12 py-8 mt-12 text-gray-section">
            <h1 class="text-2xl mb-4 text-center md:text-left"> Mis Comprás </h1>

            <ul>                    
                @forelse ($orders as $order)
                    <li>
                        <a href="{{ route('orders.show', $order) }}" class="flex items-center py-2 px-4 hover:bg-gray-100">
                            <span class="w-12 text-center">
                                @switch($order->status)
                                    @case(1)
                                        <i class="fas fa-business-time text-red-500 opacity-75"></i>
                                        @break
                                    @case(2)
                                        <i class="fas fa-credit-card text-gray-500 opacity-75"></i>
                                        @break
                                    @case(3)
                                        <i class="fas fa-truck text-yellow-500 opacity-75"></i>
                                        @break
                                    @case(4)
                                        <i class="fas fa-check-circle text-pink-500 opacity-75"></i>
                                        @break
                                    @default
                                        <i class="fas fa-times-circle text-green-500 opacity-75"></i>
                                @endswitch
                            </span>

                            <span>
                                Orden: {{$order->id}}
                                <br>
                                {{$order->created_at->format('d/m/Y')}}
                            </span>

                            <div class="ml-auto">
                                <span class="font-bold">
                                    @switch($order->status)
                                        @case(1)
                                            Pendiente
                                            @break
                                        @case(2)
                                            Espera
                                            @break
                                        @case(3)
                                            Enviado
                                            @break
                                        @case(4)
                                            Entregado
                                            @break
                                        @default
                                            Anulado
                                    @endswitch
                                </span>

                                <br>

                                <span class="text-sm">
                                    $ {{$order->total}}
                                </span>
                            </div>

                            <span>
                                <i class="fas fa-angle-right ml-6"></i>
                            </span>
                        </a>
                    </li>
                @empty
                    <h2 class="mb-4 text-lg text-center md:text-left"> Sin comprás </h2>
                @endforelse
            </ul>
        </section>
    </div>
</x-app-layout>
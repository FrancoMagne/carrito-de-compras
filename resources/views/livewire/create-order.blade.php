<div class="container py-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de Contacto"/>
                <x-jet-input class="w-full"
                    wire:model.defer="contact"
                    type="text" 
                    placeholder="Ingrese el nombre de la persona que recibirá el articulo"/>
                <x-jet-input-error for="contact"/>
            </div>

            <div>
                <x-jet-label value="Telefono de Contacto"/>
                <x-jet-input class="w-full" 
                    wire:model.defer="phone"
                    type="text" 
                    placeholder="Ingrese un número de telefono"/>
                    <x-jet-input-error for="phone"/>
            </div>
        </div>

        <div x-data="{envio : @entangle('envio')}">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold text-center md:text-left">
                Envios
            </p>
    
            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                <input x-model="envio" type="radio" value="1" name="envio" class="text-gray-600">
                <span class="ml-2 text-gray-700"> 
                    Retiro en Tienda (Calle False 123) 
                </span>
    
                <span class="font-semibold text-gray-600 ml-auto"> 
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="envio" type="radio" value="2" name="envio" class="text-gray-600">
                    <span class="ml-2 text-gray-700"> 
                        Envio a Domicilio 
                    </span>
                </label>

                <div class="px-6 pb-6 grid grid-cols-1 md:grid-cols-2 gap-6" :class="{hidden: envio != 2}">
                    <div>
                        {{-- Provincias --}}
                        <x-jet-label value="Provincias"/>
                        <select class="mt-2 w-full" wire:model="province_id">

                            <option value="" selected hidden>Seleccione una Provincia</option>

                            @foreach ($provinces as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="province_id"/>
                    </div>
                    
                    <div>
                        {{-- Departamentos --}}
                        <x-jet-label value="Departamentos"/>
                        <select class="mt-2 w-full" wire:model="departament_id">

                            <option value="" selected hidden>Seleccione un Departamento</option>

                            @foreach ($departaments as $departament)
                                <option value="{{$departament->id}}">{{$departament->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="departament_id"/>
                    </div>

                    <div>
                        <x-jet-label value="Dirección"/>
                        <x-jet-input class="w-full" type="text" wire:model="address"/>
                        <x-jet-input-error for="address"/>
                    </div>

                    <div>
                        <x-jet-label value="Referencia"/>
                        <x-jet-input class="w-full" type="text" wire:model="reference"/>
                        <x-jet-input-error for="reference"/>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center md:text-left">
            <x-jet-button 
                class="mt-6 mb-4 bg-red-700" 
                wire:loading.attr="disabled"
                wire:target="create_order"
                wire:click="create_order">
                Continuar con la compra
            </x-jet-button>

            <hr>

            {{-- Politicas de Privacidad --}}
        </div>
        
    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul class="overflow-y-auto {{ Cart::content()->count() > 4 ? 'h-60' : 'h-auto'}}">
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{asset($item->options->image)}}" alt="{{$item->name}}">
                        <article class="flex-1">
                            <h1 class="font-bold"> {{ $item->name }}</h1>
                            <p class="text-md text-sm"> Cantidad: {{ $item->qty }}</p>
                            <p class="text-sm"> US$ {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700"> NO HAY ARTICULOS EN EL CARRITO </p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal:  
                    <span class="font-semibold"> $ {{Cart::subtotal()}}</span>
                </p>

                <p class="flex justify-between items-center">
                    Envio:  
                    <span class="font-semibold"> 
                        @if ($envio == 1 || $costo == 0)
                            Gratis
                        @else
                            $ {{ $costo }}
                        @endif    
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total:</span>
                    @if ($envio == 1)
                        $ {{Cart::subtotal()}}
                    @else
                        $ {{Cart::subtotal() + $costo}}
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

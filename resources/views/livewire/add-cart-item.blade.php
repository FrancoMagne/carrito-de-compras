<div x-data>
    @if ($flag)
        <h2 class="text-xl font-bold text-black-600 mb-4"> 
            Stock Disponible: ({{ $quantity }}) 
        </h2>
        <div class="flex flex-col md:flex-row ">
            <div class="mr-4">
                <x-jet-secondary-button 
                    disabled
                    x-bind:disabled="$wire.qty == 1"
                    wire:loading.attr="disabled"
                    wire:target="decrement"
                    wire:click="decrement">
                    -
                </x-jet-secondary-button>

                <span class="mx-2"> {{ $qty }}</span>

                <x-jet-secondary-button 
                    x-bind:disabled="$wire.qty >= $wire.quantity"
                    wire:loading.attr="disabled"
                    wire:target="increment"
                    wire:click="increment">
                    +
                </x-jet-secondary-button>
            </div>

            <div class="flex-1 mt-2 md:mt-0">
                @if ($quantity > 0)
                    <x-jet-danger-button
                        x-bind:disabled="$wire.qty > $wire.quantity"
                        wire:click="addItem"
                        wire:loading.attr="disabled"
                        wire:target="addItem"
                        class="w-full cursor-pointer">
                        <span class="fas fa-shopping-cart mr-2"></span> 
                        AGREGAR AL CARRITO 
                    </x-jet-danger-button>
                @endif
            </div>
        </div>
    @else
        @if ($quantity > 0)
        <x-danger-enlace 
            wire:click="addItem"
            wire:loading.attr="disabled"
            wire:target="addItem"
            class="w-full cursor-pointer px-2 mb-2">
            <span class="fas fa-shopping-cart mr-2"></span> 
            AGREGAR AL CARRITO 
        </x-danger-enlace>
        @endif

    @endif
</div>

<div class="flex-1 relative" x-data>
    
    <form action="{{ route('search') }}" autocomplete="off">
        <x-jet-input name="name" wire:model="search" type="text" class="w-full" placeholder="¿Estás buscando algun producto?" />

        <button class="absolute top-0 right-0 w-12 h-full bg-blue-500 flex items-center justify-center rounded-r-md"> 
            <x-search size="35" color='white'/> 
        </button>
    </form>

    <div class="absolute w-full mt-1 hidden z-50" :class="{'hidden': !$wire.open}" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow">
            <div class="px-4 py-3 space-y-1">
                @forelse ($articulos as $articulo)
                    <a href="{{ route('article.show', $articulo) }}" class="flex">
                        <img class="w-16 h-12 object-cover" src="{{asset($articulo->image)}}" alt="{{asset($articulo->name)}}">
                        <div class="ml-4 text-gray-700">
                            <p class="text-lg font-semibold leading-5"> {{$articulo->name}}</p>
                            <p> Categoria: {{$articulo->categoria->name}}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-lg leading-5"> No hay coincidencias </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

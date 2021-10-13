<x-app-layout>
    
    <div class="container py-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <div>
                <img class="w-full h-80 object-cover object-center" src="{{asset($articulo->image)}}">
            </div>

            <div class="text-center md:text-left">
                <h1 class="text-4xl font-bold text-black-600"> {{ $articulo->name }}</h1>
                <h2 class="text-xl font-bold text-black-600"> Precio: $ {{ $articulo->price }} </h2>
                <h2 class="text-xl font-bold text-black-600"> Categoria: {{ $articulo->categoria->name }} </h2>
                <h2 class="text-xl font-bold text-black-600"> Vendedor: {{ $articulo->user->name }} </h2>
                
                @livewire('add-cart-item', ['articulo' => $articulo])
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-white rounded-lg shadow-lg col-span-1 md:col-span-2 lg:col-span-4 mt-16 text-2xl text-center font-bold text-black py-2">
                Articulos Relacionados con Categoria {{$articulo->categoria->name}}
            </div>

            @forelse ($relacionados as $relacionado)
                <article class="bg-white mt-4">
                    <div>
                        <img class="h-60 w-full object-cover object-center" src="{{asset($relacionado->image)}}">
                        <div class="w-full h-full px-4 flex flex-col justify-center">
                            <h1 class="text-xl text-black leading-8 font-bold text-center"> 
                                <a href="{{ route('article.show', $relacionado) }}">
                                    {{$relacionado->name}} 
                                </a>
                            </h1>
                            <h1 class="text-xl text-black leading-8 font-bold text-center"> 
                                $ {{$relacionado->price}}
                            </h1>
                        </div>
                    </div>
                </article>
            @empty
                <h1 class="col-span-3 text-2xl font-bold text-black-600 text-center"> No hay articulos relacionados</h1>
            @endforelse
        </div>
    </div>

</x-app-layout>
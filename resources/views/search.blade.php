<x-app-layout>
    <div class="container py-8">
{{--         <p class="text-lg text-gray-700 font-semibold mb-4">
            Resultados de la busqueda de: "{{$name}}"
        </p> --}}
        <ul class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @forelse ($articulos as $articulo)
                <x-article-list :articulo="$articulo"/>
            @empty
                <li class="bg-white rounded-lg shadow-2xl col-span-1 lg:col-span-2"> 
                    <div class="p-4">
                        <p class="text-lg text-gray-700 font-semibold">
                            No hay articulos que coincidan con el texto ingresado
                        </p>
                    </div>
                </li>
            @endforelse
        </ul>

        <div class="mt-4">
            {{$articulos->links()}}
        </div>
    </div>

    

</x-app-layout>
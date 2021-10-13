@props(['articulo'])

<li class="bg-white rounded-lg shadow">
    <article class="flex">
        <figure>
            <img class="h-48 w-56 object-cover object-center" 
            src="{{asset($articulo->image)}}" alt="{{$articulo->name}}">
        </figure>

        <div class="flex-1 py-4 px-6 flex flex-col">
            <div class="flex">
                <div>
                    <h1 class="text-lg font-semibold text-gray-700">
                        <a href="{{ route('article.show', $articulo)}}">
                            {{ Str::limit($articulo->name, 15)}}
                        </a>
                    </h1>
                    <p class="font-bold text-gray-700"> 
                        $ {{$articulo->price}}
                    </p>
                </div>
            </div>
            
            <div class="mt-auto mb-2">
                @livewire('add-cart-item', ['articulo' => $articulo, 'flag' => false])
            </div> 
        </div>
    </article>
</li>
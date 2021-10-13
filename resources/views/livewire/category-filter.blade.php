<div>
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-2 flex justify-between items-center">
            
            <h1 class="font-semibold text-gray-700 uppercase"> 
                {{$category->name}}
            </h1>
            
            <div class="hidden md:grid md:grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500"> 
                <i class="fas fa-border-all p-3 cursor-pointer {{ $view == 'grid' ? 'text-blue-500' : ''}}"
                    wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list p-3 cursor-pointer {{ $view == 'list'? 'text-blue-500' : ''}}" 
                    wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>

    <div class="py-4">
        @if ($view == 'grid')
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($articulos as $articulo)
                    <li class="bg-white rounded-lg shadow">
                        <article>
                            <figure>
                                <img class="h-48 w-full object-cover object-center" 
                                    src="{{asset($articulo->image)}}" alt="{{$articulo->name}}">
                            </figure> 
                            
                            <div class="py-4 px-6">
                                <h1 class="text-lg font-semibold">
                                    <a href="{{ route('article.show', $articulo)}}">
                                        {{ Str::limit($articulo->name, 15)}}
                                    </a>
                                </h1>

                                <p class="font-bold text-gray-700"> 
                                    $ {{$articulo->price}}
                                </p>
                            </div>

                            <div class="px-2">
                                @livewire('add-cart-item', ['articulo' => $articulo, 'flag' => false])
                            </div>  
                        </article>
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @foreach ($articulos as $articulo)
                    <x-article-list :articulo="$articulo" />
                @endforeach
            </ul>
        @endif
            
        <div class="mt-4">
            {{ $articulos->links()}}
        </div>
    </div>
</div>

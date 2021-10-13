<div wire:init="loadArticle">

    @if (count($articulos))
        <div class="glider-contain">
            <ul class="glider-{{$category->id}}">
                @foreach ($articulos as $articulo)
                    <li class="bg-white rounded-lg shadow {{ $loop->last ? '' : 'mr-4'}}">
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
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>
    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-blue-500"></div>
        </div>
    @endif

</div>
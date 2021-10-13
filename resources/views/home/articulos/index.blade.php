<x-app-layout>
    <div class="container py-8">
        @foreach ($categorias as $categoria)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{$categoria->name}}
                    </h1>

                    <a href="{{ route('category.show', $categoria)}}" class="text-red-600 ml-2 font-semibold hover:text-red-500 hover:underline">
                        Ver más
                    </a>
                </div>

                @livewire('category-article', ['category' => $categoria])
            </section>
        @endforeach

    </div>

     @push('script')    
        <script>
            Livewire.on('glider', function(category_id) {
                new Glider(document.querySelector('.glider-'+category_id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-'+category_id+'~ .dots',
                    arrows: {
                        prev: '.glider-'+category_id+'~ .glider-prev',
                        next: '.glider-'+category_id+'~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 5
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>
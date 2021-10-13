@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Editar Articulo</h1>
        </div>
        <div class="card-body">
            <form action=" {{route('articulos.update', $articulo)}}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
        
                {{--<div class="mb-3">
                    <label for="" class="form-label"> Código </label>
                    <input type="text" id="codigo" name="codigo" class="form-control" value="{{ $articulo->codigo}}">
                </div> --}}
                <div class="mb-3">
                    <label for="" class="form-label"> Nombre </label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$articulo->name}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label"> Cantidad </label>
                    <input type="text" id="quantity" name="quantity" class="form-control" value="{{$articulo->quantity}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label"> Precio </label>
                    <input type="text" id="price" name="price" class="form-control" value="{{$articulo->price}}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="combo">Categoria</label>
                    <div class="input-group">
                        <select class="form-control" name="combo" id="combo">
                            @foreach ($categorias as $categoria)
                                @if ($articulo->category_id == $categoria->id)
                                    <option value="{{$categoria->id}}" selected> {{$categoria->name}}</option>
                                @else
                                    <option value="{{$categoria->id}}"> {{$categoria->name}}</option>
                                @endif
                            @endforeach
                        </select>
                      </div>
                </div>

                <input type="text" id="slug" name="slug" class="form-control" value="{{$articulo->slug}}" hidden>

                <label for="" class="form-label"> Imagen </label>
                <div class="row mb-3">
                    <div class="col">
                        <div class="image-wrapper"> 
                            <img id="picture" 
                                 src= @if($articulo->image) {{asset($articulo->image)}}
                                     @else {{"https://cms-assets.tutsplus.com/uploads/users/769/posts/25334/preview_image/get-started-with-laravel-6-400x277.png"}} 
                                     @endif
                                 alt=""
                            >
                        </div>
                    </div>
                    <div class="col">
                        <label for="" class="form-label"> Seleccione una imagen para su articulo </label>
                        <div class="form-group">
                            <input class="form-control-file mb-3" type="file" id="file" name="file" accept="image/*">
                            @error('file')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <input type="checkbox" id="check" name="check" tabindex="5" 
                    @if ($articulo->visible == 1) checked
                    @endif
                    >
                    <label for="" class="form-label"> ¿Articulo visible para vender? </label>
                </div>

                <a href="{{ route('articulos.index')}}" class="btn btn-secondary"> Cancelar </a>
                <button type="submit" class="btn btn-primary"> Guardar </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>

        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

    </style>
@stop

@section('js')
    <script>

        //Cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];
            var inputFile = event.target;

            if(!(/\.(jpg|png|gif|jpeg)$/i).test(file.name)) {
                inputFile.value = '';
                alert('El archivo a adjuntar no es una imagen');
            } else {
                var reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById("picture").setAttribute('src', event.target.result); 
                };
                reader.readAsDataURL(file);
            }
        }

    </script>

    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
        
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>

@stop
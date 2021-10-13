@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="text-center">Editar Categoria</h1>
    </div>
    
    <div class="card-body">
        {!! Form::model($categoria, ['route' => ['admin.categories.update', $categoria], 'method' => 'put']) !!}
            <div class="form group mb-3">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria']) !!}
                
                @error('name')
                    <span class="text-danger"> {{$message}} </span>
                @enderror
                
            </div>
            
            <div class="form group mb-3">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'readonly']) !!}
                
                @error('slug')
                    <span class="text-danger"> {{$message}} </span>
                @enderror
            
            </div>

            {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
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
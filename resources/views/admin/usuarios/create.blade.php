@extends('adminlte::page')

@section('title', 'Crear')

@section('content_header')
    
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="text-center">Crear Usuario</h1>
    </div>
    
    <div class="card-body">
        <form action="{{route('admin.users.store')}}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="" class="form-label"> Email </label>
                <input type="text" id="email" name="email" class="form-control" value="{{old('email')}}" required>
                @error('email')
                    <span class="text-danger"> {{$message}} </span>
                @enderror

            </div>

            <div class="mb-3">
                <label for="" class="form-label"> Contraseña </label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                    <span class="text-danger"> {{$message}} </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label" for="combo">Rol</label>
                <div class="input-group">
                    <select class="form-control" name="rol" id="rol">
                        @foreach ($roles as $rol)
                            <option value="{{$rol->name}}"> {{$rol->name}}</option>      
                        @endforeach
                    </select>
                  </div>
            </div>
            
            <a href="{{ route('admin.users.index')}}" class="btn btn-secondary"> Cancelar </a>
            <button type="submit" class="btn btn-primary"> Guardar </button>

    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
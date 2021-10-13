@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    
@stop

@section('content')
    
    <div class="card">
        <div class="card-header">
            <h2 class="text-center">Resumen de la Orden #{{$venta->id}}</h2>

            <table class="table table-striped table-responsive-sm table-bordered shadow-lg">
                <thead class="bg-primary text-white">
                    <tr align="center">
                        <th scope="col"> Articulo </th>
                        <th scope="col"> Cantidad </th>
                        <th scope="col"> Precio </th>
                        <th scope="col"> Total </th>
                    </tr>
    
                </thead>
                <tbody>
                    @foreach ($my_articles as $article)
                    <tr class="text-center">
                        <td align="left" width="30%">
                            <img class=".d-none" src="{{ asset($article->options->image) }}" alt="{{ $article->name }}" width="100" height="80">
                            {{ $article->name }}
                        </td>
                        <td> {{ $article->qty }}</td>
                        <td> $ {{ $article->price }} </td>
                        <td> $ {{ $article->price * $article->qty}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-8">
                @if ($venta->shipping_type == 1)
                    <h5> Tipo de Envío: Retira en Local</h5>
                @else
                    <h5> Tipo de Envío: Envio a Domicilio</h5>
                    <h5> Costo de Envío: {{$venta->shipping_cost}}</h5>
                    <h5> Provincia - Departamento: {{$venta->provincia->name}} - {{$venta->departamento->name}}</h5>
                    <h5> Dirección: {{$venta->address}}</h5>
                    <h5> Referencia: {{$venta->reference}}</h5>
                @endif
                
                <h5> Estado Actual: 
                    @switch($venta->status)
                        @case(1)
                            Pendiente
                            @break
                        @case(2)
                            Espera
                            @break
                        @case(3)
                            Enviado
                            @break
                        @case(4)
                            Entregado
                            @break
                        @default
                            Anulado      
                    @endswitch
                </h5>

                <h5> Total a Pagar: $ {{$total}}</h5>

            </div>
        </div>
        
        @if ($venta->status == 2 || $venta->status == 3)
        <div class="card-body">
            <form action=" {{route('ventas.update', $venta)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="status">Seleccione un nuevo estado</label>
                    <select class="form-control" id="status" name="status">

                        <option value='2' 
                            @if ($venta->status == 2)
                                selected
                            @endif> Espera
                        </option>

                        <option value='3' 
                            @if ($venta->status == 3)
                                selected
                            @endif> Enviado
                        </option>

                        <option value='4' 
                            @if ($venta->status == 4)
                                selected
                            @endif> Entregado
                        </option>

                        <option value='5' 
                            @if ($venta->status == 5)
                                selected
                            @endif> Anulado
                        </option>
                    </select>
                  </div>

                <a href="{{ route('ventas.index')}}" class="btn btn-secondary"> Cancelar </a>
                <button type="submit" class="btn btn-primary"> Guardar </button>
            </form>
        </div>
        @endif
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
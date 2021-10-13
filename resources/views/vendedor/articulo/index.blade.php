@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    {{-- @if (auth()->user()->enabled == 0)
        <h1 class="bg-green mt-4 mb-4" align="center"> Cuenta Re-Habilitada </h1>
        <p hidden> {{ auth()->user()->enabled = 1 }} {{ auth()->user()->save() }} </p>
    @endif --}}
@stop

@section('content')

    <div class="container">
        <h1 class="text-center"> Lista de Articulos </h1>
        <a href="{{ route('articulos.create')}}" class="btn btn-primary "> NUEVO ARTICULO </a>
        <div style="float: right;">
            <a id="pdf" href="{{ route('descargarPDF')}}" target="_blank" class="btn bg-red mb-4" title="Descargar PDF"> <i class="far fa-file-pdf"></i> </a>
            <a id="excel" href="{{ route('descargarExcel')}}" class="btn bg-green mb-4" title="Descargar EXCEL"> <i class="far fa-file-excel"></i> </a>
        </div>
    </div>
    
    <div class="container my-4">
        
        <table id="articulos" class="table table-striped table-responsive-sm table-bordered shadow-lg" style="width: 100%">
            <thead class="bg-primary text-white">
                <tr align="center">
                    <th scope="col"> # </th>
                    <th scope="col"> Nombre </th>
                    <th scope="col"> Categoria </th>
                    <th scope="col"> Cantidad </th>
                    <th scope="col"> Precio </th>
                    <th scope="col"> Imagen </th>
                    <th scope="col"> Visible </th>
                    <th scope="col"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <td  align="center" class="text-center" > {{ ++$contador }} </td>
                        <td > {{$articulo->name}} </td>
                        <td align="center" class="text-center"> {{$articulo->categoria->name}} </td>
                        <td align="center" class="text-center"> {{$articulo->quantity}} </td>
                        <td align="center"> $ {{$articulo->price}} </td>
                        {{-- <td align="center">
                            @if($articulo->image != null)
                                <a href="{{asset($articulo->image)}}" target="_blank"> <i class="fas fa-eye"> </i> </a>
                            @else
                                <a href="#"> <i class="fas fa-eye-slash"></i> </a>
                            @endif 
                        </td> --}}
                        <td>
                            @if($articulo->image != null)
                            <center>
                            {{-- rel="noopener" impide que la nueva página pueda acceder a la window.openerpropiedad 
                                    y asegura que se ejecute en un proceso separado.
                                rel="noreferrer" tiene el mismo efecto pero también previene la Refererencabezado 
                                    e ser enviado a la nueva página.
                            --}}
                                <a href="{{asset($articulo->image)}}" target="_blank" rel="noreferrer"> 
                                    <img src="{{asset($articulo->image)}}" width="100" height="80"> 
                                </a>
                            </center>
                            @else
                                <p align="center"> Sin Imagen </p>
                            @endif 
                        </td>
                        <td align="center"> 
                            @if ($articulo->visible == 0)
                                No
                            @else
                                Si
                            @endif
                        </td>
                        <td align="center"> 
                            <div class="row">
                                
                                <a href="{{route('articulos.edit', $articulo)}}" class="btn btn-info ml-1 mb-1" title="Editar">
                                    <i class="fas fa-edit" ></i> 
                                </a>
    
                                <form class="form-deleted" action="{{ route('articulos.destroy', $articulo->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input input="text" name="name" value="{{$articulo->name}}" hidden>
                                    <button type="submit" class="btn btn-danger ml-1 mb-1" title="Eliminar"> <i class="fas fa-trash"></i> </button>
                                </form> 
    
                                {{-- @if($articulo->imagen != null)
                                    <a href="{{asset($articulo->imagen)}}" target="_blank" class="btn bg-green ml-1 mb-1" title="Ver Imagen"> 
                                        <i class="fas fa-image"></i>
                                    </a>
                                @endif --}}
                            </div> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>   
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado con exito!',
                'El producto fue eliminado.',
                'success'
            )
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#articulos').DataTable({
                responsive: true,
                "lengthMenu": [[5,10,50,-1],[5,10,50,'All']],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Sin articulos cargados",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate":{
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });

        $('.form-deleted').submit(function(e){
            e.preventDefault();
            //console.log(e.target[2].value);
            var nombre = e.target[2].value;

            Swal.fire({
            title: '¿Eliminar el producto '+nombre+" ?",
            text: "No podrá deshacer los cambios",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

@stop
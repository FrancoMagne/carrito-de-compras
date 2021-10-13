@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    
@stop

@section('content')

    <div class="container">
        <h1 class="text-center">Lista de Categorias</h1>
        <a href="{{ route('admin.categories.create')}}" class="btn btn-primary mb-4"> NUEVA CATEGORIA </a>
    </div>

    <div class="container">
        <table id="categorias" class="table table-striped table-bordered shadow-lg" style="width:100%;">
            <thead class="bg-primary text-white">
                <tr align="center">
                    <th scope="col"> Nombre </th>
                    <th scope="col"> Slug </th>
                    <th scope="col"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="text-center">
                        <td> {{$categoria->name}}</td>
                        <td> {{$categoria->slug}}</td>
                        <td align="rigth">
                            <div class="row justify-content-center">
                            
                                <a href="{{route('admin.categories.edit', $categoria)}}" class="btn btn-info ml-1 mb-1" title="Editar">
                                    <i class="fas fa-edit" ></i> 
                                </a>
    
                                <form class="form-deleted" action="{{ route('admin.categories.destroy', $categoria->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input input="text" name="name" value="{{$categoria->name}}" hidden>
                                    <button type="submit" class="btn btn-danger ml-1 mb-1" title="Eliminar"> <i class="fas fa-trash"></i> </button>
                                </form> 
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
                'La categoria fue eliminada.',
                'success'
            )
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#categorias').DataTable({
                responsive: true,
                "lengthMenu": [[5,10,20,-1],[5,10,20,'All']],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Sin categorias cargadas",
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
            title: '¿Eliminar la categoria '+nombre+" ?",
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
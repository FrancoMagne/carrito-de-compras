@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    
@stop

@section('content')
    <div class="container">
        <h1 class="text-center">Lista de Usuarios</h1>
        <a href="{{ route('admin.users.create')}}" class="btn btn-primary mb-4"> NUEVO USUARIO </a>
    </div>

    <div class="container">
        <table id="categorias" class="table table-striped table-responsive-sm table-bordered shadow-lg" style="width:100%;">
            <thead class="bg-primary text-white">
                <tr align="center">
                    <th scope="col"> ID </th>
                    <th scope="col"> Nombre </th>
                    <th scope="col"> Correo </th>
                    <th scope="col"> Habilitado </th>
                    <th scope="col"> Rol </th>
                    <th scope="col"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr class="text-center">
                        <td> {{$usuario->id}}</td>
                        <td> {{$usuario->name}}</td>
                        <td> {{$usuario->email}}</td>
                        <td> @if ($usuario->enabled == 1)
                                Si
                            @else
                                No                            
                            @endif
                        </td>
                        <td> {{ $usuario->rol }}</td>
                        <td>
                            @if ($usuario->enabled == 1)
                                <form class="form-deleted" action="{{ route('admin.users.destroy', $usuario)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input input="text" name="name" value="{{$usuario->name}}" hidden>
                                    <button type="submit" class="btn btn-danger ml-1 mb-1" title="Deshabilitar"> <i class="fas fa-trash"></i> </button>
                                </form>
                            @else
                                <form class="form-update" action="{{ route('admin.users.update', $usuario)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input input="text" name="name" value="{{$usuario->name}}" hidden>
                                    <button type="submit" class="btn btn-success ml-1 mb-1" title="Habilitar"> <i class="fas fa-edit"></i> </button>
                                </form>                   
                            @endif
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

    @if (session('actualizado') == 'ok')
        <script>
            Swal.fire(
                'Actualizado con exito!',
                'Se actualizo el estado del usuario',
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
                    "zeroRecords": "Sin usuarios cargados",
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

        
        $('.form-update').submit(function(e){
            e.preventDefault();
            var nombre = e.target[2].value;

            Swal.fire({
            title: '¿Habilitar al usuario '+nombre+" ?",
            text: "Al habilitarlo el usuario podrá ingresar nuevamente a su cuenta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });

        $('.form-deleted').submit(function(e){
            e.preventDefault();
            //console.log(e.target);
            var nombre = e.target[2].value;

            Swal.fire({
            title: '¿Deshabilitar al usuario '+nombre+" ?",
            text: "Al deshabilitarlo el usuario no podrá ingresar a su cuenta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@stop  
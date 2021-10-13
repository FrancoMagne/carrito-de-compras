@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    
@stop

@section('content')
    <div class="container">
        <h1 class="text-center">Mis Ordenes</h1>
    </div>

    <div class="container">
        <table id="ordenes" class="table table-striped table-responsive-sm table-bordered shadow-lg" style="width:100%;">
            <thead class="bg-primary text-white">
                <tr align="center">
                    <th scope="col"> Orden #</th>
                    <th scope="col"> Nombre </th>
                    <th scope="col"> Telefono </th>
                    <th scope="col"> Estado </th>
                    <th scope="col"> Total </th>
                    <th scope="col"> Acción </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($my_orders as $order)
                    <tr class="text-center">
                        <td> {{$order->id}}</td>
                        <td> {{$order->contact}}</td>
                        <td> {{$order->phone}}</td>
                        <td> 
                            @switch($order->status)
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
                        </td>
                        <td> $ {{$order->total_order}}</td>
                        <td align="rigth">
                            <div class="row justify-content-center">
                                <a href="{{route('ventas.edit', $order)}}" class="btn btn-info ml-1 mb-1" title="ver">
                                @if ($order->status == 2 || $order->status == 3)
                                    <i class="fas fa-edit" ></i> 
                                @else 
                                    <i class="fas fa-eye" ></i> 
                                @endif
                                </a>
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

    @if (!empty(session('status')))
        <script>
            Swal.fire(
                'Cambio de estado exitoso',
                "Se actualizó con éxito el estado de la {{session('status')}}",
                'success'
            )
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#ordenes').DataTable({
                responsive: true,
                "lengthMenu": [[5,10,50,-1],[5,10,50,'All']],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Sin ordenes",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay ordenes disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate":{
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>

@stop  
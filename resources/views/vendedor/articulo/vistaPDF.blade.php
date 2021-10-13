<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="{{ asset('css.estilosPDF') }}">--}}
    {{--<style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em;
        }
        body {
            margin: 3cm 2cm 2cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 30px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style> --}}
    <title> Articulos de {{auth()->user()->name}}</title>
</head>
<body> 

    <div class="container">
        <h3 class="text-center mt-4"> Articulos de {{auth()->user()->name}} </h3>
    </div>

    {{-- <p> Total de Ventas: ${{$ventas}}</p> --}}
    
    <table class="table table-striped table-bordered shadow-lg">
        <thead>
            <tr class="text-center"> 
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Creado </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $articulo)
            <tr class="text-center"> 
                <td>{{$articulo->name}}</td>
                <td>{{$articulo->categoria->name}}</td>
                <td>{{$articulo->quantity}}</td>
                <td>$ {{$articulo->price}}</td>
                <td>{{$articulo->created_at->format('d/m/Y')}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

</body>
</html>
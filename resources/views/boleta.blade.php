{{-- @extends('layouts.app')

@section('content') --}}

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<div class="container">

<div class="row"> 
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Notas de venta - Histórico</h1>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Boleta</th>
                    <th>Cajero</th>
                    <th>DNI</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                    <th>Descargar</th>
                </tr>
                </thead>

                @foreach ($tickets as $ticket)

                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->user_id}}</td>
                        <td>{{$ticket->dni}}</td>
                        <td>{{$ticket->total}}</td>
                        <td>{{$ticket->created_at}}</td>
                        <td><a class="btn btn-primary" target="_blank" href="{{route('detalle',$ticket->id)}}"> Ver </a></td>
                        <td><a class="btn btn-primary" target="_blank" href="{{route('pdf',$ticket->id)}}"> Ver PDF</a></td>
                    </tr>
                
                @endforeach
            </table>

            

            
        </div>        
    </div>
</div>  



</div>
{{-- @endsection --}}
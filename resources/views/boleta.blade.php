{{-- @extends('layouts.app')

@section('content') --}}


<div class="container">

<div class="row"> 
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Tickets</h1>

            <table>

                <tr>
                    <th>Boleta</th>
                    <th>Cajero</th>
                    <th>DNI</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                </tr>

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

<div class="col-3" style="width: 25%">

<div class="col-11">
    <h2>Factura</h2>

    <div class="row my-3">
        <div class="col-10" style="text-align: center">
            <h1 >"Cupidos Bar"</h1>
            <p>RUC: 202111221</p>
            <p>Av. XXX - XXX Lima-Surco</p>
        </div>
    </div>

    <div class="col-2">
        
    </div>

</div>

<hr/>

<div class="row fact-info mt-3">
    <div class="col-3">
        {{-- @foreach ($ticket as $ticket)
        <h5>DNI: {{$ticket->dni}}</h5>
        @endforeach --}}
        <table>
    
            <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">Detalle</th>
                <th style="text-align: center">Cant.</th>
                <th style="text-align: center">Precio</th>
                <th style="text-align: center">Total</th>
            </tr>

            <tbody>
            @foreach ($ticket as $ticket)

                <tr>
                    <td>{{$ticket->id}}</td>
                    <td>{{$ticket->nombre}}</td>
                    <td style="text-align: right">{{$ticket->cantidad}}</td>
                    <td style="text-align: right">{{$ticket->precio}}</td>
                    <td style="text-align: right">{{($ticket->cantidad)*($ticket->precio)}}</td>                 
                </tr> 
            
            @endforeach
            </tbody>
        </table>

        <div style="text-align: right">
            <p>Subtotal: {{$ticket->subtotal}}</p>
            <p>IGV 18%: {{$ticket->igv}}</p>
            <p>Total: {{$ticket->total}}</p>
        </div>

        <hr/>

        

        <p>DNI: {{$ticket->dni}}</p>
        <p>Fecha: {{date('d-m-Y')}}</p>
        <p>Fecha: {{$date}}</p>
        <p>Fecha: {{$fecha1}}</p>


    </div>

</div>
</div>


{{-- <div class="container">

    <div class="row"> 
        <div class="row justify-content-center">
            <div class="col-md-8">
    
                <h1>Detalle</h1>
    
                <table>
    
                    <tr>
                        <th>ID</th>
                        <th>Detalle</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
    
                    @foreach ($ticket as $ticket)
    
                        <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->nombre}}</td>
                            <td>{{$ticket->cantidad}}</td>
                            <td>{{$ticket->precio}}</td>
                            <td>{{($ticket->cantidad)*($ticket->precio)}}</td>
                            
                        </tr> 
                    
                    @endforeach
                </table>
    
            <h3>Subtotal:</h1>
            <h1>TOTAL: {{$ticket->total}}</h1>         
                
            </div>        
        </div>
    </div>  
</div> --}}

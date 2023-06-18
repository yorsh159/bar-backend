<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoletaPedido extends Model
{
    use HasFactory;

    public function boleta(){
        return $this->belongsTo(Boleta::class);
    }

    public function pedido(){
        return $this->belongsToMany(PedidoDetalle::class,'pedido_detalles');
    }
}

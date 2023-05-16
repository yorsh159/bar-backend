<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pedidos(){
        return $this->belongsToMany(Pedido::class,'boleta_pedidos');
    }
    public function productos(){
        return $this->belongsToMany(Producto::class,'boleta_pedidos')->withPivot('pedido');
    }

}

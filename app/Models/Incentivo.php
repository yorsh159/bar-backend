<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentivo extends Model
{
    use HasFactory;

    protected $table='incentivo';
    //protected $primaryKey='id';


    public function productos(){
        return $this->belongsToMany(Producto::class,'incentivo');
    }
}

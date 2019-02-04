<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class SeguroVehiculo extends Model
{
    use HashIdTrait;
    
    protected $table = 'seguros_vehiculos';
    protected $fillable = ['vehiculo_id','fecha_vencimiento','nombre'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
}

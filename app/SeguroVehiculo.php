<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeguroVehiculo extends Model
{
    protected $table = 'seguros_vehiculos';
    protected $fillable = ['vehiculo_id','fecha_vencimiento','nombre'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
}

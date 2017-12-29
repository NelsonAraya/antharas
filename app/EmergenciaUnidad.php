<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergenciaUnidad extends Model
{
    protected $table = 'emergencia_unidads';
    protected $fillable = ['emergencia_id','vehiculo_id'];

    public function parte(){
        return $this->belongsTo(Emergencia::class,'emergencia_id','id');
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
}

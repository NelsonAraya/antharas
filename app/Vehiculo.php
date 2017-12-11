<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = ['patente','clave','modelo','marca','anio'];

    public function cia(){
        return $this->belongsTo(Cia::class,'cia_id','id');
    }

}

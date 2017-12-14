<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermisoCirculacion extends Model
{
    protected $table = 'permisos_circulaciones';
    protected $fillable = ['vehiculo_id','fecha_vencimiento'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
}

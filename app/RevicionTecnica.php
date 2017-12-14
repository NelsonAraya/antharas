<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevicionTecnica extends Model
{
    protected $table = 'revisiones_tecnicas';
    protected $fillable = ['vehiculo_id','fecha_vencimiento'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
}

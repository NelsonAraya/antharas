<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    protected $table = 'emergencias';
    protected $fillable = ['fecha_emergencia','hora_emergencia','direccion','usuario_id','clave_id','comuna'];

    public function clave(){
        return $this->belongsTo(Clave::class,'clave_id','id');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }
    public function cias(){
        return $this->hasMany(EmergenciaCia::class,'emergencia_id','id');
    }
    public function unidades(){
        return $this->hasMany(EmergenciaUnidad::class,'emergencia_id','id');
    }

    public function partes(){
        return $this->hasMany(ParteOnline::class,'emergencia_id','id');
    }
}

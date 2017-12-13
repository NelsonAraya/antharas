<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = ['patente','clave','modelo','marca','anio','cia_id'];

    public function cia(){
        return $this->belongsTo(Cia::class,'cia_id','id');
    }

    public function usuarios(){
        return $this->belongsToMany(Usuario::class)->withTimestamps();
    }

    public function activaciones(){
        return $this->hasMany(Activacion::class,'vehiculo_id','id');
    }

    public function scopeClave($query, $name) {
      if($name != "") {
        return $query->where('clave', "LIKE", "%$name%");  
      }  
    }

}

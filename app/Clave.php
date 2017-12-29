<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clave extends Model
{
    protected $table = 'claves';
    protected $fillable = ['clave','descripcion'];

    public function scopeClave($query, $name) {
      if($name != "") {
        return $query->where('clave', "LIKE", "%$name%");  
      }  
    }
    public function emergencias(){
        return $this->hasMany(Emergencia::class,'clave_id','id');
    }
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidads';
    protected $fillable = ['id','clave','descripcion'];

    public function scopeEspecialidad($query, $name) {
      if($name != "") {
        return $query->where('descripcion', "LIKE", "%$name%");  
      }  
    }
    public function usuarios(){
        return $this->belongsToMany(Usuario::class)->withTimestamps();
    }
}

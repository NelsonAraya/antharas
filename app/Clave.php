<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clave extends Model
{
    protected $table = 'claves';
    protected $fillable = ['clave','descripcion'];

    public function emergencias(){
        return $this->hasMany(Emergencia::class,'clave_id','id');
    }
    
}

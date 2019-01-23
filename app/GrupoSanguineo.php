<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoSanguineo extends Model
{
    protected $table = 'grupo_sanguineos';
    protected $fillable = ['id','nombre'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'cia_id','id')->orderBy('rol','ASC');
    }
}

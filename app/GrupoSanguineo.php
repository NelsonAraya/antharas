<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class GrupoSanguineo extends Model
{
    use HashIdTrait;
    
    protected $table = 'grupo_sanguineos';
    protected $fillable = ['id','nombre'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'cia_id','id')->orderBy('rol','ASC');
    }
}

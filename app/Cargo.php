<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $fillable = ['nombre'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'cargo_id','id');
    }
}

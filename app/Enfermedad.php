<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'enfermedades';
    protected $fillable = ['id','nombre'];

    public function usuarios(){
        return $this->belongsToMany(Usuario::class)->withTimestamps();
    }
}

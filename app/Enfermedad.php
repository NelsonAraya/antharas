<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Enfermedad extends Model
{
    use HashIdTrait;
    
    protected $table = 'enfermedades';
    protected $fillable = ['id','nombre'];

    public function usuarios(){
        return $this->belongsToMany(Usuario::class)->withTimestamps();
    }
}

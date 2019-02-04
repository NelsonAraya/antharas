<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Cargo extends Model
{
    use HashIdTrait;
    
    protected $table = 'cargos';
    protected $fillable = ['nombre'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'cargo_id','id');
    }
}

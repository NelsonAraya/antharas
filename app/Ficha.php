<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Ficha extends Model
{
    use HashIdTrait;
    
    protected $table = 'fichas';
    protected $fillable = ['peso','talla','imc','quirurgicos','alergias','tratamientos','otras','contacto1','fono1','contacto2','fono2'];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }

}

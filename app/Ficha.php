<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $table = 'fichas';
    protected $fillable = ['peso','talla','imc','quirurgicos','alergias','tratamientos'];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }

}

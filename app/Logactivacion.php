<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logactivacion extends Model
{
    protected $table = 'logactivaciones';
    protected $fillable = ['usuario_id','estado'];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }
}

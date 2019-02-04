<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Logactivacion extends Model
{
    use HashIdTrait;
    
    protected $table = 'logactivaciones';
    protected $fillable = ['usuario_id','estado'];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }
}

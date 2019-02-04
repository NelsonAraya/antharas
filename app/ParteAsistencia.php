<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class ParteAsistencia extends Model
{
    use HashIdTrait;
    
    protected $table = 'parte_asistencias';
    protected $fillable = ['usuario_id'];

    public function parte(){
        return $this->belongsTo(ParteOnline::class,'parte_id','id');
    }
    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }
}

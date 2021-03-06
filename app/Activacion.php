<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Activacion extends Model
{
    use HashIdTrait;
    
    protected $table = 'activaciones';
    protected $fillable = ['usuario_id','vehiculo_id','estado','operador_id','tipo'];

    public function horaActivacion(){
    	return date('d-m-Y H:i:s',strtotime($this->created_at)); 
    }
    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
    
    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }

}

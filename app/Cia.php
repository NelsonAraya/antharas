<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Cia extends Model
{
    use HashIdTrait;
    
    protected $table = 'cias';
    protected $fillable = ['numero','nombre'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'cia_id','id')->orderBy('rol','ASC');
    }

    public function usuariosCargoVisor(){
        return $this->hasMany(Usuario::class,'cia_id','id')
        ->orderByRaw("FIELD(cargo_id ,5,6,7,8,9,13,14,15) DESC")->orderBy('rol','ASC');
    }
    
    public function nombreCompleto(){

    	if($this->numero==100){
           return $this->nombre;  
        }else{
        return $this->nombre.' N° '.$this->numero;
        }
    }

    public function vehiculos(){
        return $this->hasMany(Vehiculo::class,'cia_id','id')->orderBy('orden','ASC');
    }
       
}

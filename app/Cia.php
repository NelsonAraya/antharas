<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia extends Model
{
    protected $table = 'cias';
    protected $fillable = ['numero','nombre'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'cia_id','id')->orderBy('rol','ASC');
    }
    
    public function nombreCompleto(){

    	if($this->numero==100){
           return $this->nombre;  
        }else{
        return $this->nombre.' N° '.$this->numero;
        }
    }

    public function vehiculos(){
        return $this->hasMany(Vehiculo::class,'cia_id','id');
    }
       
}

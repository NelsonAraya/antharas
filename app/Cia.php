<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cia extends Model
{
    protected $table = 'cias';
    protected $fillable = ['numero','nombre'];

    public function usuarios(){
        return $this->hasMany(Usuario::class,'cia_id','id');
    }
    
    public function nombreCompleto(){

    	return $this->nombre.' N° '.$this->numero;
    }
       
}

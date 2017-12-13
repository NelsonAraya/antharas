<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol','nombres','apellidop','apellidom','telefono','direccion','cia_id','cargo_id','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function nombreSimple(){

        $this->nombres=explode(' ',$this->nombres)[0];

        return $this->nombres.' '.$this->apellidop.' '.$this->apellidom;
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class,'cargo_id','id');
    }

    public function cia(){
        return $this->belongsTo(Cia::class,'cia_id','id');
    }

    public function runCompleto() {
      return number_format($this->id, 0,'.','.') . '-' . $this->dv;
    }

    public function vehiculos(){
        return $this->belongsToMany(Vehiculo::class)->withTimestamps();
    }

    public function scopeNombres($query, $name) {
      if($name != "") {
        return $query->where('nombres', "LIKE", "%$name%")
        ->orWhere('apellidop',"LIKE","%$name%")
        ->orWhere('apellidom',"LIKE","%$name%");  
      }  
    }
}

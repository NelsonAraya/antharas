<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergenciaCia extends Model
{
    protected $table = 'emergencia_cias';
    protected $fillable = ['emergencia_id','cia_id'];

    public function emergencia(){
        return $this->belongsTo(Emergencia::class,'emergencia_id','id');
    }
    public function cia(){
        return $this->belongsTo(Cia::class,'cia_id','id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class EmergenciaCia extends Model
{
    use HashIdTrait;
    
    protected $table = 'emergencia_cias';
    protected $fillable = ['emergencia_id','cia_id'];

    public function emergencia(){
        return $this->belongsTo(Emergencia::class,'emergencia_id','id');
    }
    public function cia(){
        return $this->belongsTo(Cia::class,'cia_id','id');
    }

}

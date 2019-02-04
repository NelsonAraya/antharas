<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class RevicionTecnica extends Model
{
    use HashIdTrait;
    
    protected $table = 'revisiones_tecnicas';
    protected $fillable = ['vehiculo_id','fecha_vencimiento'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
}

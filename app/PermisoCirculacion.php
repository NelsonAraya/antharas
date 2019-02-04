<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class PermisoCirculacion extends Model
{
    use HashIdTrait;
    
    protected $table = 'permisos_circulaciones';
    protected $fillable = ['vehiculo_id','fecha_vencimiento'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }
}

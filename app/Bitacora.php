<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Bitacora extends Model
{
    use HashIdTrait;
    
    protected $table = 'bitacoras';
    protected $fillable = ['fecha_salida','fecha_llegada','hora_salida','hora_llegada','kmsalida','kmllegada',
                        'conductor_id','obac_id','servicio','direccion'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id','id');
    }

    public function conductor(){
        return $this->belongsTo(Usuario::class,'conductor_id','id');
    }

    public function obac(){
        return $this->belongsTo(Usuario::class,'obac_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParteOnline extends Model
{
    protected $table = 'parte_onlines';
    protected $fillable = ['obac_cia','obac_cbi','anexo_direccion','tipo','afectado','relacion','seguro','causa',
							'origen','danio','info','trabajo','op_rescate','lesionados','vehiculos'];

    public function obacCia(){
        return $this->belongsTo(Usuario::class,'obac_cia','id');
    }
    public function obacCbi(){
        return $this->belongsTo(Usuario::class,'obac_cbi','id');
    }
    public function responsable(){
        return $this->belongsTo(Usuario::class,'usuario_responsable','id');
    }
}

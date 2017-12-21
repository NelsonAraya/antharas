<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergenciaCia extends Model
{
    protected $table = 'emergencia_cias';
    protected $fillable = ['emergencia_id','cia_id'];

}

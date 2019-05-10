<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Tono extends Model {

	use HashIdTrait;

    protected $table = 'tonos';
    protected $fillable = ['nombre','estado'];
    
}

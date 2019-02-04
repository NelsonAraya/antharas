<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HashIdTrait;

class Role extends Model
{
    use HashIdTrait;
    
    protected $table = 'roles';
    
    public function users(){
		return $this->belongsToMany(User::class);
	}
}

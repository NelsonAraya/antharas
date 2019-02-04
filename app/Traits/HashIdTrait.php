<?php

namespace App\Traits;

trait HashIdTrait
{
    public function getHashId() {
    	
      return \Hashids::encode($this->id);
   }
}
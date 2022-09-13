<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function apartment() {
        return $this->hasMany('App\Apartment');
    }
}

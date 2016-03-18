<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area_dictionary";
    public function casas() {
        $this->hasMany('App\Casa');
    }
}

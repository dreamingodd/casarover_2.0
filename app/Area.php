<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area_dictionary";
    public function casas() {
        return $this->hasMany('App\Casa','dictionary_id');
    }

}

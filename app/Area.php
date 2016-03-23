<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area_dictionary";
    public function casas() {
        return $this->hasMany('App\Casa', 'dictionary_id');
    }
    public function supArea() {
        return $this->belongsTo('App\Area', 'parentid');
    }
    public function subAreas() {
        return $this->hasMany('App\Area', 'parentid');
    }
}

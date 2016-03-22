<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tag";

    public function casas() {
        return $this->belongsToMany('App\Casa', 'casa_tag');
    }
}

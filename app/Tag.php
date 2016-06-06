<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    const DELETED_AT = 'update_time';
    const UPDATED_AT = 'update_time';
    const CREATED_AT = 'update_time';
    protected $table = "tag";

    public function casas() {
        return $this->belongsToMany('App\Casa', 'casa_tag');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    protected $table = "casa";
    public function area()
    {
        return $this->belongTo('App\Area','dictionary_id');
    }
    public function attachment()
    {
        return $this->belongsTo('App\Attachment');
    }
    public function tags() {
        return $this->belongsToMany('App\Tag', 'casa_tag');
    }
    public function contents() {
        return $this->hasMany('App\Content');
    }

}

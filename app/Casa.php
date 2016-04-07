<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    const DELETED_AT = 'updated_at';
	const UPDATED_AT = 'updated_at';
	const CREATED_AT = 'updated_at';
    protected $table = "casa";
    public function area()
    {
        return $this->belongsTo('App\Area', 'dictionary_id');
    }

    public function areaRecoms()
    {
        return $this->belongsToMany('App\Area');
    }
    public function attachment()
    {
        return $this->belongsTo('App\Attachment');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'casa_tag');
    }
    public function contents()
    {
        return $this->hasMany('App\Content');
    }

}

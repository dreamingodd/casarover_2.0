<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    const DELETED_AT = 'updated_at';
    const UPDATED_AT = 'update_time';
    const CREATED_AT = 'updated_at';
    protected $table = "area_dictionary";
    public function casas()
    {
        return $this->hasMany('App\Casa', 'dictionary_id');
    }
    public function casaRecoms()
    {
        return $this->belongsToMany('App\Casa');
    }
    public function supArea()
    {
        return $this->belongsTo('App\Area', 'parentid');
    }
    public function subAreas()
    {
        return $this->hasMany('App\Area', 'parentid');
    }
    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }
    public function attachment()
    {
        return $this->belongsTo('App\Attachment');
    }
}

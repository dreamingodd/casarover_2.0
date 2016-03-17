<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    protected $table = "casa";
    public function area()
    {
        return $this->belongTo('App\Area');
    }
}

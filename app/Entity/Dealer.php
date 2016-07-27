<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    const KEY_LENGTH = 18;

    protected $table = 'dealer';
    protected $fillable = ['name', 'code', 'key', 'dev_key'];
}

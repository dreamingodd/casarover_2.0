<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class PcLoginRequest extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;
    protected $table = 'pc_login_request';
}

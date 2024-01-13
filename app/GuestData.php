<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestData extends Model
{
    protected $connection = 'tenant';
    protected $table = 'guest_data';
}

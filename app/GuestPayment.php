<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestPayment extends Model
{
    protected $connection = 'tenant';
    protected $table = 'guest_payments';
}

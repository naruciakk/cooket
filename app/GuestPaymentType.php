<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestPaymentType extends Model
{
    protected $connection = 'tenant';
    protected $table = 'guest_payment_types';
}

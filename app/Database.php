<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    protected $connection = 'main';
    protected $table = 'dbs';
}

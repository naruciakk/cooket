<?php

namespace App;

use App\Support\TenantConnector;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	use TenantConnector;
	
    protected $connection = 'main';

    public function connect() {
        $this->reconnect($this);
        return $this;
    }
}

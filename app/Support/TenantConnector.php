<?php

namespace App\Support;

use App\Database;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait TenantConnector {
   
   /**
    * Switch the Tenant connection to a different organization.
    * @param Database $database
    * @return void
    * @throws
    */
   public function reconnect(Database $database) {
      DB::purge('tenant');

      Config::set('database.connections.tenant.host', $database->host);
      Config::set('database.connections.tenant.database', $database->name);
      Config::set('database.connections.tenant.username', $database->username);
      Config::set('database.connections.tenant.password', $database->password);
      
      DB::reconnect('tenant');
      
      // Ping the database. This will throw an exception in case the database does not exists or the connection fails
      Schema::connection('tenant')->getConnection()->reconnect();
   }
   
}
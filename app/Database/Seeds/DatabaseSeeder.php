<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('PermissionSeeder');
        $this->call('GroupSeeder');
		$this->call('CompanySeeder');
		$this->call('StoreSeeder');
		// $this->call('TransactionSeeder');
		$this->call('UserSeeder');
		$this->call('TypeAccountSeeder');
		$this->call('AccountSeeder');
    }
}

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
		$this->call('GroupAccountSeeder');
		$this->call('SubGroupAccountSeeder');
		$this->call('AccountSeeder');
		$this->call('JournalTypeSeeder');
		$this->call('JournalSeeder');
		$this->call('BusinessPartnerSeeder');
		$this->call('ItemSeeder');
		$this->call('PurchaseOrderSeeder');
		$this->call('SalesOrderSeeder');
    }
}

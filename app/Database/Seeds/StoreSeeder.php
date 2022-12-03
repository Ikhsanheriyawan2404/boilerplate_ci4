<?php

namespace App\Database\Seeds;

use App\Models\StoreModel;
use CodeIgniter\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $stores = new StoreModel();

		$stores->insert([
			'name' => 'Agen Cabang SMS 1',
            'company_id' => 1
		]);

        $stores->insert([
			'name' => 'Agen Cabang SMS 2',
            'company_id' => 1
		]);

        $stores->insert([
			'name' => 'Agen Cabang Jasa Marga 1',
            'company_id' => 2
		]);

        $stores->insert([
			'name' => 'Agen Cabang Jasa Marga 2',
            'company_id' => 2
		]);
    }
}

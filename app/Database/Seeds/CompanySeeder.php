<?php

namespace App\Database\Seeds;

use App\Models\CompanyModel;
use CodeIgniter\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $companies = new CompanyModel();

		$companies->insert([
			'name' => 'PT Surya Marga Sarana',
		]);

        $companies->insert([
			'name' => 'PT Jasa Marga',
		]);
    }
}

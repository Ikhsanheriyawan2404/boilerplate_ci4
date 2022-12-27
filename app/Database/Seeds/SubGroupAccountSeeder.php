<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\SubGroupAccountModel;

class SubGroupAccountSeeder extends Seeder
{
    public function run()
    {
        $model = new SubGroupAccountModel();
          $data = [
            [
                'group_account_id' => 1,
                'code' => 1,
                'name' => 'Asset/Harta',
            ],
            [
                'group_account_id' => 2,
                'code' => 2,
                'name' => 'Liability/Hutang',
            ],
            [
                'group_account_id' => 3,
                'code' => 3,
                'name' => 'Equity/Modal',
            ],
            [
                'group_account_id' => 4,
                'code' => 4,
                'name' => 'Revenue/Pendapatan',
            ],
            [
                'group_account_id' => 5,
                'code' => 5,
                'name' => 'Expenses/Beban',
            ],
            [
                'group_account_id' => 6,
                'code' => 6,
                'name' => 'Operating Revenue/Biaya Operasional',
            ],
            [
                'group_account_id' => 7,
                'code' => 7,
                'name' => 'Pendapatan Lainnya',
            ],
            [
                'group_account_id' => 8,
                'code' => 8,
                'name' => 'Beban Lainnya',
            ],
            [
                'group_account_id' => 9,
                'code' => 9,
                'name' => 'Beban Pajak',
            ],
        ];
        $model->insertBatch($data);
    }
}

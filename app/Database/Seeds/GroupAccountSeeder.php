<?php

namespace App\Database\Seeds;

use App\Models\GroupAccountModel;
use CodeIgniter\Database\Seeder;

class GroupAccountSeeder extends Seeder
{
    public function run()
    {
        $model = new GroupAccountModel();
        $data = [
            [
                'name' => 'Asset/Harta',
            ],
            [
                'name' => 'Liability/Hutang',
            ],
            [
                'name' => 'Equity/Modal',
            ],
            [
                'name' => 'Revenue/Pendapatan',
            ],
            [
                'name' => 'Expenses/Beban',
            ],
            [
                'name' => 'Operating Revenue/Biaya Operasional',
            ],
            [
                'name' => 'Pendapatan Lainnya',
            ],
            [
                'name' => 'Beban Lainnya',
            ],
            [
                'name' => 'Beban Pajak',
            ],
        ];
        $model->insertBatch($data);
    }
}

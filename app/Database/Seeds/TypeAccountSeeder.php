<?php

namespace App\Database\Seeds;

use App\Models\TypeAccountModel;
use CodeIgniter\Database\Seeder;

class TypeAccountSeeder extends Seeder
{
    public function run()
    {
        $model = new TypeAccountModel();
        $data = [
            [
                'code' => 1,
                'name' => 'Asset/Harta',
            ],
            [
                'code' => 2,
                'name' => 'Liability/Hutang',
            ],
            [
                'code' => 3,
                'name' => 'Equity/Modal',
            ],
            [
                'code' => 4,
                'name' => 'Revenue/Pendapatan',
            ],
            [
                'code' => 5,
                'name' => 'Expenses/Beban',
            ],
            [
                'code' => 6,
                'name' => 'Operating Revenue/Biaya Operasional',
            ],
            [
                'code' => 7,
                'name' => 'Pendapatan Lainnya',
            ],
            [
                'code' => 8,
                'name' => 'Beban Lainnya',
            ],
            [
                'code' => 9,
                'name' => 'Beban Pajak',
            ],
        ];
        $model->insertBatch($data);
    }
}

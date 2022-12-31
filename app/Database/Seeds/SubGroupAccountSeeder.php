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
                'code' => '10000',
                'name' => 'Kas & Bank',
            ],
            [
                'group_account_id' => 1,
                'code' => '10100',
                'name' => 'Akun Piutang',
            ],
            [
                'group_account_id' => 1,
                'code' => '10200',
                'name' => 'Persediaan',
            ],
            [
                'group_account_id' => 1,
                'code' => '10300',
                'name' => 'Aktiva Lancar Lainnya',
            ],
            [
                'group_account_id' => 1,
                'code' => '10700',
                'name' => 'Aktiva Tetap',
            ],
            [
                'group_account_id' => 1,
                'code' => '10750',
                'name' => 'Depresiasi & Amortisasi',
            ],
            // =========================================
            [
                'group_account_id' => 2,
                'code' => '20100',
                'name' => 'Akun Hutang',
            ],
            [
                'group_account_id' => 2,
                'code' => '20200',
                'name' => 'Kewajiban Lancar Lainnya',
            ],
            // ===================================
            [
                'group_account_id' => 3,
                'code' => '30000',
                'name' => 'Ekuitas',
            ],
            // =======================================
            [
                'group_account_id' => 4,
                'code' => '40000',
                'name' => 'Pendapatan',
            ],
            // =========================================
            [
                'group_account_id' => 5,
                'code' => '50000',
                'name' => 'HPP',
            ],
            // =======================================
            [
                'group_account_id' => 6,
                'code' => '60000',
                'name' => 'Beban',
            ],
            // ================================================
            [
                'group_account_id' => 7,
                'code' => '70000',
                'name' => 'Pendapatan Lainnya',
            ],
            // =============================================
            [
                'group_account_id' => 8,
                'code' => '80000',
                'name' => 'Beban Lainnya',
            ],
        ];
        $model->insertBatch($data);
    }
}

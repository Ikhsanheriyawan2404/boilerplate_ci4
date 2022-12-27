<?php

namespace App\Database\Seeds;

use App\Models\JournalTypeModel;
use CodeIgniter\Database\Seeder;

class JournalTypeSeeder extends Seeder
{
    public function run()
    {
        $model = new JournalTypeModel();
        $data = [
            [
                'code' => 'JB',
                'name' => 'Jurnal Pembelian',
            ],
            [
                'code' => 'JJ',
                'name' => 'Jurnal Penjualan',
            ],
            [
                'code' => 'JKM',
                'name' => 'Jurnal Penerimaan Kas',
            ],
            [
                'code' => 'JKK',
                'name' => 'Jurnal Pengeluaran Kas',
            ],
            [
                'code' => 'JU',
                'name' => 'Jurnal Umum',
            ],
            [
                'code' => 'AJP',
                'name' => 'Ayat Jurnal Penyesuaian',
            ],
        ];
        $model->insertBatch($data);
    }
}

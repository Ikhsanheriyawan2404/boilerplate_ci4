<?php

namespace App\Database\Seeds;

use App\Models\AccountModel;
use CodeIgniter\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $model = new AccountModel();
        $data = [
            [
                'code' => '1-11000',
                'type_account_id' => 1,
                'name' => 'Kas Operasional',
            ],
            [
                'code' => '1-11201',
                'type_account_id' => 1,
                'name' => 'Kas Bank BRI',
            ],
            [
                'code' => '1-11202',
                'type_account_id' => 1,
                'name' => 'Kas Bank Mandiri',
            ],
            [
                'code' => '1-11301',
                'type_account_id' => 1,
                'name' => 'Piutang Usaha',
            ],
            [
                'code' => '1-10300',
                'type_account_id' => 1,
                'name' => 'Persediaan Barang',
            ],
            [
                'code' => '1-10301',
                'type_account_id' => 1,
                'name' => 'Persediaan Elpiji 3 Kg',
            ],
            [
                'code' => '1-10302',
                'type_account_id' => 1,
                'name' => 'Persediaan Tabung Elpiji 3 Kg',
            ],
            [
                'code' => '1-10400',
                'type_account_id' => 1,
                'name' => 'Piutang Karyawan',
            ],
            [
                'code' => '1-11901',
                'type_account_id' => 1,
                'name' => 'Kredit Pajak - PPH 23',
            ],
            [
                'code' => '1-11902',
                'type_account_id' => 1,
                'name' => 'Kredit Pajak - Angsuran PPH 25 Badan',
            ],
            [
                'code' => '1-12001',
                'type_account_id' => 1,
                'name' => 'Tanah',
            ],
            [
                'code' => '1-12002',
                'type_account_id' => 1,
                'name' => 'Bangunan',
            ],
            [
                'code' => '1-12003',
                'type_account_id' => 1,
                'name' => 'Peralatan Kantor',
            ],
            [
                'code' => '1-12004',
                'type_account_id' => 1,
                'name' => 'Mesin & Peralatan',
            ],
            [
                'code' => '1-12005',
                'type_account_id' => 1,
                'name' => 'Kendaraan Operasional',
            ],
            [
                'code' => '1-13001',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan Bangunan',
            ],
            [
                'code' => '1-13002',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan Peralatan Kantor',
            ],
            [
                'code' => '1-13003',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan Peralatan',
            ],
            [
                'code' => '1-13004',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan kendaraan Operasional',
            ],
            [
                'code' => '2-21000',
                'type_account_id' => 2,
                'name' => 'Hutang Usaha',
            ],
            [
                'code' => '2-21100',
                'type_account_id' => 2,
                'name' => 'Hutang Lainnya',
            ],
            [
                'code' => '2-22000',
                'type_account_id' => 2,
                'name' => 'Hutang Bank',
            ],
            [
                'code' => '3-31000',
                'type_account_id' => 3,
                'name' => 'Modal',
            ],
            [
                'code' => '3-32000',
                'type_account_id' => 3,
                'name' => 'Laba Ditahan',
            ],
            [
                'code' => '3-33000',
                'type_account_id' => 3,
                'name' => 'Laba Tahun Berjalan',
            ],
            [
                'code' => '4-41000',
                'type_account_id' => 4,
                'name' => 'Penjualan Elpiji 3 Kg',
            ],
            [
                'code' => '4-41100',
                'type_account_id' => 4,
                'name' => 'Penjualan Tabung Elpiji 3 Kg',
            ],
               [
                'code' => '5-51000',
                'type_account_id' => 5,
                'name' => 'HPP Elpiji 3 Kg',
            ],
            [
                'code' => '5-51100',
                'type_account_id' => 5,
                'name' => 'HPP Tabung Elpiji 3 Kg',
            ],
        ];
        $model->insertBatch($data);
    }
}

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
                'store_id' => 1,
                'code' => '11000',
                'type_account_id' => 1,
                'name' => 'Kas Operasional',
            ],
            [
                'store_id' => 1,
                'code' => '11201',
                'type_account_id' => 1,
                'name' => 'Kas Bank BRI',
            ],
            [
                'store_id' => 1,
                'code' => '11202',
                'type_account_id' => 1,
                'name' => 'Kas Bank Mandiri',
            ],
            [
                'store_id' => 1,
                'code' => '11301',
                'type_account_id' => 1,
                'name' => 'Piutang Usaha',
            ],
            [
                'store_id' => 1,
                'code' => '10300',
                'type_account_id' => 1,
                'name' => 'Persediaan Barang',
            ],
            [
                'store_id' => 1,
                'code' => '10301',
                'type_account_id' => 1,
                'name' => 'Persediaan Elpiji 3 Kg',
            ],
            [
                'store_id' => 1,
                'code' => '10302',
                'type_account_id' => 1,
                'name' => 'Persediaan Tabung Elpiji 3 Kg',
            ],
            [
                'store_id' => 1,
                'code' => '10400',
                'type_account_id' => 1,
                'name' => 'Piutang Karyawan',
            ],
            [
                'store_id' => 1,
                'code' => '11901',
                'type_account_id' => 1,
                'name' => 'Kredit Pajak - PPH 23',
            ],
            [
                'store_id' => 1,
                'code' => '11902',
                'type_account_id' => 1,
                'name' => 'Kredit Pajak - Angsuran PPH 25 Badan',
            ],
            [
                'store_id' => 1,
                'code' => '12001',
                'type_account_id' => 1,
                'name' => 'Tanah',
            ],
            [
                'store_id' => 1,
                'code' => '12002',
                'type_account_id' => 1,
                'name' => 'Bangunan',
            ],
            [
                'store_id' => 1,
                'code' => '12003',
                'type_account_id' => 1,
                'name' => 'Peralatan Kantor',
            ],
            [
                'store_id' => 1,
                'code' => '12004',
                'type_account_id' => 1,
                'name' => 'Mesin & Peralatan',
            ],
            [
                'store_id' => 1,
                'code' => '12005',
                'type_account_id' => 1,
                'name' => 'Kendaraan Operasional',
            ],
            [
                'store_id' => 1,
                'code' => '13001',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan Bangunan',
            ],
            [
                'store_id' => 1,
                'code' => '13002',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan Peralatan Kantor',
            ],
            [
                'store_id' => 1,
                'code' => '13003',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan Peralatan',
            ],
            [
                'store_id' => 1,
                'code' => '13004',
                'type_account_id' => 1,
                'name' => 'Akumulasi Penyusutan kendaraan Operasional',
            ],
            [
                'store_id' => 1,
                'code' => '21000',
                'type_account_id' => 2,
                'name' => 'Hutang Usaha',
            ],
            [
                'store_id' => 1,
                'code' => '21100',
                'type_account_id' => 2,
                'name' => 'Hutang Lainnya',
            ],
            [
                'store_id' => 1,
                'code' => '22000',
                'type_account_id' => 2,
                'name' => 'Hutang Bank',
            ],
            [
                'store_id' => 1,
                'code' => '31000',
                'type_account_id' => 3,
                'name' => 'Modal',
            ],
            [
                'store_id' => 1,
                'code' => '32000',
                'type_account_id' => 3,
                'name' => 'Laba Ditahan',
            ],
            [
                'store_id' => 1,
                'code' => '33000',
                'type_account_id' => 3,
                'name' => 'Laba Tahun Berjalan',
            ],
            [
                'store_id' => 1,
                'code' => '41000',
                'type_account_id' => 4,
                'name' => 'Penjualan Elpiji 3 Kg',
            ],
            [
                'store_id' => 1,
                'code' => '41100',
                'type_account_id' => 4,
                'name' => 'Penjualan Tabung Elpiji 3 Kg',
            ],
               [
                'store_id' => 1,
                'code' => '51000',
                'type_account_id' => 5,
                'name' => 'HPP Elpiji 3 Kg',
            ],
            [
                'store_id' => 1,
                'code' => '51100',
                'type_account_id' => 5,
                'name' => 'HPP Tabung Elpiji 3 Kg',
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61000', 'name' => 'Biaya Gaji Karyawan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61100', 'name' => 'Biaya Tunjangan Karyawan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61200', 'name' => 'Biaya BPJS Kesehatan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61400', 'name' => 'Insentif Sopir & Kernet'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61500', 'name' => 'Biaya Konsumsi Karyawan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61600', 'name' => 'Biaya BBM Kendaraan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61700', 'name' => 'Biaya Listrik, Air Telepon'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61800', 'name' => 'Biaya Transportasi / Perjalanan Dinas'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '61900', 'name' => 'Biaya ATK & Perlengkapan Kantor'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62000', 'name' => 'Biaya Pergantian Sparepart & Pelumas Kendaraan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62100', 'name' => 'Biaya Service Kendaraan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62200', 'name' => 'Biaya Pergantian Sparepart  Peralatan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62300', 'name' => 'Biaya Service Peralatan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62400', 'name' => 'Biaya Pemeliharaan Bangunan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62501', 'name' => 'Beban Penyusutan Peralatan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62502', 'name' => 'Beban Penyusutan Kendaraan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62503', 'name' => 'Beban Penyusutan Bangunan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62600', 'name' => 'Biaya Pajak, Izin & Retribusi'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62700', 'name' => 'Biaya Adm & Umum Lainnya'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 6,
                'code' => '62800', 'name' => 'PPN DPP Nilai lain'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 8,
                'code' => '81000', 'name' => 'Pendapatan Bunga / Jasa Giro'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 8,
                'code' => '81100', 'name' => 'Pendapatan lain-lain'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 8,
                'code' => '82000', 'name' => 'Pajak atas Bunga dan Jasa Giro'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 8,
                'code' => '82100', 'name' => 'Beban Administrasi Bank'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 8,
                'code' => '82200', 'name' => 'Beban Bunga Pinjaman Bank'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 8,
                'code' => '82300', 'name' => 'Biaya Sumbangan'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 8,
                'code' => '89900', 'name' => 'Beban PPh Pasal 22 - Final'
            ],
            [
                'store_id' => 1,
                'type_account_id' => 9,
                'code' => '90000', 'name' => 'Beban PPh Badan - Non Final'
            ],
        ];
        

        $model->insertBatch($data);
    }
}

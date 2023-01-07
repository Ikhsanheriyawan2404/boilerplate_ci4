<?php

namespace App\Database\Seeds;

use App\Models\BusinessPartnerModel;
use CodeIgniter\Database\Seeder;

class BusinessPartnerSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('group_business_partners')->insert([
            'name' => 'PT Group'
        ]);

        $model = new BusinessPartnerModel();

        $data = [
            [
                'name' => 'PT Indofood',
                'email' => 'indofod@yahoo.co',
                'phone_number' => '08212312321',
                'address' => '-',
                'type' => 'vendor'
            ],
            [
                'name' => 'Ikhsan Heriyawan',
                'email' => 'ikhsan@yahoo.co',
                'phone_number' => '08124345533',
                'address' => '-',
                'type' => 'customer'
            ]
        ];

        $model->insertBatch($data);
    }
}

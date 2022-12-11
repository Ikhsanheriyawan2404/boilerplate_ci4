<?php

namespace App\Database\Seeds;

use App\Models\WarehouseModel;
use CodeIgniter\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        $model = new WarehouseModel();
        
        $model->insert([
            'name' => 'Gudang 1 Sektor Timur',
            'description' => 'loc bandung timur',
        ]);
        $model->insert([
            'name' => 'Gudang 2 Sektor Barat',
            'description' => 'loc bandung barat',
        ]);
    }
}

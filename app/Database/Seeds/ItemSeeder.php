<?php

namespace App\Database\Seeds;

use App\Models\ItemModel;
use CodeIgniter\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $items = new ItemModel();

        $items->insert([
            'name' => 'Tabung Gas LPG 3kg',
            'item_code' => 'ITM#00001',
            'purchase_price' => 110000,
            'selling_price' => 120000,
        ]);

        $items->insert([
            'name' => 'Gas LPG 3kg',
            'item_code' => 'ITM#00002',
            'purchase_price' => 15000,
            'selling_price' => 16000,
        ]);
    }
}

<?php

namespace App\Database\Seeds;

use App\Models\TransactionModel;
use CodeIgniter\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        
        $transactions = new TransactionModel();
        for ($i = 0; $i < 10; $i++) {
            $transactions->insert([
                'title' => 'pemasukan Agent 1 PT JSM',
                'amount' => 10000.00,
                'store_id' => 3
            ]);

            $transactions->insert([
                'title' => 'pemasukan Agent 1 PT SMS',
                'amount' => 10000.00,
                'store_id' => 1
            ]);
        }
    }
}

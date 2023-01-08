<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
			'developer-module',
			'client-module',
			'manager-module',
			'auditor-module',
		];

		foreach ($data as $value) {
			$this->db->table('auth_permissions')->insert(['name' => $value]);
		}
    }
}

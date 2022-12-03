<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
			'post-module',
			'category-module',
			'user-module',
			'group-module',
		];

		foreach ($data as $value) {
			$this->db->table('auth_permissions')->insert(['name' => $value]);
		}
    }
}

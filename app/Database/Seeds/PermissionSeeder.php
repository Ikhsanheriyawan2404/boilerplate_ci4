<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
			'developer-module',
			'example1-module',
			'example2-module',
			'example3-module',
			'user-module',
			'group-module',
		];

		foreach ($data as $value) {
			$this->db->table('auth_permissions')->insert(['name' => $value]);
		}
    }
}

<?php

namespace App\Database\Seeds;

use Myth\Auth\Password;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\GroupModel;

class UserSeeder extends Seeder
{
    public function run()
    {
		$db = \Config\Database::connect();
        $user = new UserModel();
		$groups = new GroupModel();
		// AKUN ADMIN ===================================
		$user->insert([
			'username' => 'admin',
			'email' => 'admin@gmail.com',
			'password_hash' => Password::hash('admin'),
			'active' => 1,
		]);

		$groups->addUserToGroup($user->getInsertId(), 1);

		// AKUN Manager ===================================
		$user->insert([
			'username' => 'manager',
			'email' => 'manager@gmail.com',
			'password_hash' => Password::hash('manager'),
			'active' => 1,
		]);

		$groups->addUserToGroup($user->getInsertId(), 2);

		for ($i = 1; $i <= 4; $i++) {
			$db->table('user_store')->insert([
				'user_id'  => $user->getInsertID(),
				'store_id' => $i,
			]);
		}

		// AKUN Manager ===================================
		$user->insert([
			'username' => 'kuncoro123',
			'email' => 'ikhsan24@gmail.com',
			'password_hash' => Password::hash('admin123'),
			'active' => 1,
		]);

		$db->table('user_store')->insert([
            'user_id'  => $user->getInsertID(),
            'store_id' => 3, // PT JSM Agen 1
        ]);

		$db->table('user_store')->insert([
            'user_id'  => $user->getInsertID(),
            'store_id' => 4, // PT JSM Agen 2
        ]);

		$groups->addUserToGroup($user->getInsertId(), 3);
    }
}

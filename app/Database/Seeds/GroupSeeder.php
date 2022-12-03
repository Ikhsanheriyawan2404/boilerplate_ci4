<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\{GroupModel, PermissionModel};

class GroupSeeder extends Seeder
{
    public function run()
    {
        $groups = new GroupModel();
		$groups->insert([
			'name' => 'Super Admin',
			'description' => 'Level Dewa',
		]);

		$permissions = new PermissionModel();
		$superadmin = $permissions->findAll();
		foreach ($superadmin as $permission) {
			$groups->addPermissionToGroup($permission->id, $groups->getInsertID());
		}

		$groups->insert([
			'name' => 'Admin',
			'description' => 'Level Dewa',
		]);

		$admin = $permissions->whereIn('name', [
			'post-module', 'category-module'
		])->findAll();
		foreach ($admin as $permission) {
			$groups->addPermissionToGroup($permission->id, $groups->getInsertID());
		}
    }
}

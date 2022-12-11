<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\{GroupModel, PermissionModel};

class GroupSeeder extends Seeder
{
    public function run()
    {
		$permissions = new PermissionModel();
		
        $groups = new GroupModel();
		$groups->insert([
			'name' => 'Superadmin',
			'description' => 'Level Dewa',
		]);

		$groups->addPermissionToGroup(1, $groups->getInsertID());
		/////////////////////////////////////////

		$groups->insert([
			'name' => 'Manager',
			'description' => 'Level Manager',
		]);

		$manager = $permissions->findAll();
		foreach ($manager as $permission) {
			$groups->addPermissionToGroup($permission->id, $groups->getInsertID());
		}
		// ================================================

		$groups->insert([
			'name' => 'Audior',
			'description' => 'Level Auditor',
		]);
		$auditor = $permissions->whereIn('name', [
			'post-module', 'category-module'
		])->findAll();

		foreach ($auditor as $permission) {
			$groups->addPermissionToGroup($permission->id, $groups->getInsertID());
		}
		// ================================================
    }
}

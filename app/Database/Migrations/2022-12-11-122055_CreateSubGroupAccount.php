<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubGroupAccount extends Migration
{
    public function up()
    {
		$this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'group_account_id'          => [
				'type'           => 'BIGINT',
				'unsigned' => true,
			],
            'code'          => [
				'type'           => 'BIGINT',
			],
            'name'          => [
				'type'           => 'VARCHAR',
				'constraint'       => '255',
			],
            'description'          => [
				'type'           => 'TEXT',
                'null' => true
			],
		]);
        $this->forge->addKey('id', true);
		$this->forge->addForeignKey('group_account_id', 'group_account', 'id');
        $this->forge->createTable('subgroup_account');
    }

    public function down()
    {
		$this->forge->dropTable('subgroup_account');
        
    }
}

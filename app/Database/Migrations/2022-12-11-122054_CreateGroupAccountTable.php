<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGroupAccountTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
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
		$this->forge->createTable('group_account');
    }

    public function down()
    {
		$this->forge->dropTable('group_account');
    }
}

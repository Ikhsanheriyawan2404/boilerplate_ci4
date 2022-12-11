<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemGroupTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('item_groups');
    }

    public function down()
    {
        $this->forge->dropTable('item_groups');
    }
}

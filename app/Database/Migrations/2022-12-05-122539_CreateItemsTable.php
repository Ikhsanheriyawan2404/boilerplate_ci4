<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'item_code'          => [
				'type'           => 'VARCHAR',
				'constraint'       => '255',
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'item_group_id'       => [
				'type'       => 'BIGINT',
				'unsigned' => true,
			],
			'units'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'default' => 'pcs'
			],
			'description' => [
				'type'       => 'TEXT',
				'null' => true,
			],
			'image' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('item_group_id', 'item_groups', 'id');
		$this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('items');
    }
}

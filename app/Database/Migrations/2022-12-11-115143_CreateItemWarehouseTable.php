<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemWarehouseTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'item_id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
			],
            'warehouse_id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
			],
			'stock' => [
				'type'       => 'DECIMAL',
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('item_id', 'items', 'id');
		$this->forge->addForeignKey('warehouse_id', 'warehouses', 'id');
		$this->forge->createTable('item_warehouse');
    }

    public function down()
    {
        $this->forge->dropTable('item_warehouse');
    }
}

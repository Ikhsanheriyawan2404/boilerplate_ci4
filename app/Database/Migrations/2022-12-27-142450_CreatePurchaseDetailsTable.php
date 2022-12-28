<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'purchase_order_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
			],
            'item_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
			],
			'qty' => [
				'type' => 'DECIMAL',
                'constraint' => '15,2'
			],
			'total_price' => [
				'type' => 'DECIMAL',
                'constraint' => '15,2'
			],
		]);

        $this->forge->addKey('id', true);
		$this->forge->addForeignKey('purchase_order_id', 'purchase_orders', 'id');
		$this->forge->addForeignKey('item_id', 'items', 'id');
		$this->forge->createTable('purchase_details');
    }

    public function down()
    {
		$this->forge->dropTable('purchase_details');
    }
}

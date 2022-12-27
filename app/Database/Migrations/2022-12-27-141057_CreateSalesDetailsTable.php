<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'sales_order_id' => [
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
		]);

        $this->forge->addKey('id', true);
		$this->forge->addForeignKey('sales_order_id', 'sales_orders', 'id');
		$this->forge->addForeignKey('item_id', 'items', 'id');
		$this->forge->createTable('sales_details');
    }

    public function down()
    {
		$this->forge->dropTable('sales_details');
    }
}

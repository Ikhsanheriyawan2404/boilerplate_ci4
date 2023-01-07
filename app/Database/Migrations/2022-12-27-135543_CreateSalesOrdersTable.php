<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'store_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
			],
			'user_id' => [
				'type' => 'INT',
				'unsigned' => true,
			],
			'business_partner_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
			],
			'transaction_date' => [
				'type' => 'DATE',
			],
			'overdue_date' => [
				'type' => 'DATE',
			],
			'payment_date' => [
				'type' => 'DATE',
				'null' => true
			],
            'document' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
            'description' => [
				'type' => 'TEXT',
				'null' => true
			],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'open', 'paid']
            ],
			'discount' => [
				'type' => 'DECIMAL',
                'constraint' => '15,2',
				'unsigned' => true,
			],
			'total_price' => [
				'type' => 'DECIMAL',
                'constraint' => '15,2',
				'unsigned' => true,
			],
			'pay' => [
				'type' => 'DECIMAL',
                'constraint' => '15,2',
				'unsigned' => true,
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);

        $this->forge->addKey('id', true);
		$this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->addForeignKey('business_partner_id', 'business_partners', 'id');
		$this->forge->createTable('sales_orders');
    }

    public function down()
    {
		$this->forge->dropTable('sales_orders');
    }
}

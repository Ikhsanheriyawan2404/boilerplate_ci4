<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJournalsTable extends Migration
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
				'null' => true
			],
			'sales_order_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
				'null' => true
			],
			'store_id' => [
				'type' => 'BIGINT',
				'unsigned' => true
			],
			'user_id' => [
				'type' => 'INT',
				'unsigned' => true
			],
			'journal_type_id' => [
				'type' => 'BIGINT',
				'unsigned' => true
			],
			'transaction_number' => [
				'type'           => 'VARCHAR',
				'constraint'       => '255',
			],
			'date' => [
				'type' => 'DATE',
			],
			'description' => [
				'type' => 'TEXT',
				'null' => true
			],
			'file' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
			'status' => [
				'type' => 'ENUM',
				'constraint' => ['draft', 'final']
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->addForeignKey('journal_type_id', 'journal_type', 'id');
		$this->forge->addForeignKey('purchase_order_id', 'purchase_orders', 'id');
		$this->forge->addForeignKey('sales_order_id', 'sales_orders', 'id');
		$this->forge->createTable('journals');
    }

    public function down()
    {
		$this->forge->dropTable('journals');
    }
}

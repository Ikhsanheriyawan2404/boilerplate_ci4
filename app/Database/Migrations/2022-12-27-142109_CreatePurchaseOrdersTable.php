<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseOrdersTable extends Migration
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
			'journal_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
				'null' => true,
			],
			'business_partner_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
			],
			'date' => [
				'type' => 'DATE',
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
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);

        $this->forge->addKey('id', true);
		$this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->addForeignKey('business_partner_id', 'business_partners', 'id');
		$this->forge->addForeignKey('journal_id', 'journals', 'id');
		$this->forge->createTable('purchase_orders');
    }

    public function down()
    {
		$this->forge->dropTable('purchase_orders');
    }
}

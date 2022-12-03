<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'store_id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
			],
			'title'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
            'amount'       => [
				'type'       => 'DECIMAL',
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}

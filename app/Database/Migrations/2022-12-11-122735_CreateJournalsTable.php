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
			'store_id' => [
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
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->createTable('journals');
    }

    public function down()
    {
		$this->forge->dropTable('journals');
    }
}

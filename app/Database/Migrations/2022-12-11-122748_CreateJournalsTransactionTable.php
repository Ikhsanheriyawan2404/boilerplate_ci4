<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJournalsTransactionTable extends Migration
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
			'account_id' => [
				'type' => 'BIGINT',
				'unsigned' => true
			],
			'credit'          => [
				'type'           => 'DECIMAL',
				'constraint' => '15,2'
			],
			'debit'          => [
				'type'           => 'DECIMAL',
				'constraint' => '15,2'
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->addForeignKey('account_id', 'accounts', 'id');
		$this->forge->createTable('journal_transactions');
    }

    public function down()
    {
		$this->forge->dropTable('journal_transactions');
    }
}

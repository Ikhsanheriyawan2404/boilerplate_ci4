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
			'journal_id' => [
				'type' => 'BIGINT',
				'unsigned' => true
			],
			'account_code' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'credit'          => [
				'type'           => 'DECIMAL',
				'constraint' => '15,2'
			],
			'debit'          => [
				'type'           => 'DECIMAL',
				'constraint' => '15,2'
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('journal_id', 'journals', 'id');
		$this->forge->addForeignKey('account_code', 'accounts', 'code');
		$this->forge->createTable('journal_transactions');
    }

    public function down()
    {
		$this->forge->dropTable('journal_transactions');
    }
}

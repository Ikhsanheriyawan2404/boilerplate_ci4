<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAccountsTable extends Migration
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
			'type_account_id'          => [
				'type'           => 'BIGINT',
				'unsigned' => true,
			],
            'code'          => [
				'type'           => 'VARCHAR',
                'constraint' => '255',
			],
            'name'          => [
				'type'           => 'VARCHAR',
				'constraint'       => '255',
			],
            'description'          => [
				'type'           => 'TEXT',
                'null' => true
			],
            'locked'          => [
				'type'           => 'INT',
                'default' => 0
			],
			'saldo'          => [
				'type'           => 'DECIMAL',
				'constraint' => '15,2'
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
		// $this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->addForeignKey('type_account_id', 'type_account', 'id');
		$this->forge->createTable('accounts');
    }

    public function down()
    {
		$this->forge->dropTable('accounts');
    }
}

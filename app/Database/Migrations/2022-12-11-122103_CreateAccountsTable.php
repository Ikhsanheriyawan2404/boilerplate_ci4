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
            'code'          => [
				'type'           => 'BIGINT',
                'unsigned' => true,
			],
            'type_account_id'          => [
				'type'           => 'BIGINT',
                'unsigned' => true,
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
                'default' => 1
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->createTable('accounts');
    }

    public function down()
    {
		$this->forge->dropTable('accounts');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStoreTable extends Migration
{
	public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
            'company_id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('company_id', 'companies', 'id');
		$this->forge->createTable('stores');
    }

    public function down()
    {
        $this->forge->dropTable('stores');
    }
}

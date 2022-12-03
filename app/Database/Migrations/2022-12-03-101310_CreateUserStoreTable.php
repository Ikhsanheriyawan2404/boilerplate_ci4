<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserStoreTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'user_id'          => [
				'type'           => 'INT',
				'unsigned'       => true,
			],
            'store_id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
			],
		]);

		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->addForeignKey('store_id', 'stores', 'id');
		$this->forge->createTable('user_store');
    }

    public function down()
    {
        $this->forge->dropTable('user_store');
    }
}

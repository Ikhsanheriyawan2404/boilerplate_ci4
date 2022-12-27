<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJournalTypeTable extends Migration
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
				'type'           => 'VARCHAR',
				'constraint'       => '255',
			],
            'name'          => [
				'type'           => 'VARCHAR',
				'constraint'       => '255',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('journal_type');
    }

    public function down()
    {
		$this->forge->dropTable('journal_type');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGroupBusinessPartnerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
		]);
        $this->forge->addKey('id', true);
		$this->forge->createTable('group_business_partners');
    }

    public function down()
    {
		$this->forge->dropTable('group_business_partners');
    }
}

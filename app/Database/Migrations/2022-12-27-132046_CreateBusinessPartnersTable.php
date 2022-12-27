<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusinessPartnersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'group_business_partner_id' => [
				'type' => 'BIGINT',
				'unsigned' => true,
				'null' => true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
            'email' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
            'phone_number' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
			],
            'address' => [
				'type' => 'TEXT',
				'null' => true
			],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['vendor', 'customer']
            ],
			'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);

        $this->forge->addKey('id', true);
		$this->forge->addForeignKey('group_business_partner_id', 'group_business_partners', 'id');
		$this->forge->createTable('business_partners');
    }

    public function down()
    {
		$this->forge->dropTable('business_partners');
    }
}

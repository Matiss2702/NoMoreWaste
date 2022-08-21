<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Jobs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
			],
            'created_at datetime default current_timestamp',
            'modified_at' => [
                'type' => 'datetime',
                'null' => true,
			],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Jobs');
    }

    public function down()
    {
        $this->forge->dropTable('Jobs');
    }
}

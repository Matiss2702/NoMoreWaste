<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Conditions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'question' => [
                'type' => 'varchar',
                'constraint' => '100',
                'auto_increment' => true,
            ],
            'created_at datetime default current_timestamp',
            'modified_at' => [
                'type' => 'datetime',
                'null' => true,
			],
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Conditions');
    }

    public function down()
    {
        $this->forge->dropTable('Conditions');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Benevoles extends Migration{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
			],
             'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
			],
             'mail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
			],
             'address' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
			],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
			],
             'zipcode' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => true,
			],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
			],
            'phone' => [
                'type' => 'INT',
                'constraint' => '10',
                'null' => true,
			],
            'id_jobs' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'valided' => [
                'type' => 'ENUM("0","1")',
                'default' => '0',
                'null' => false,
			],
            'created_at datetime default current_timestamp',
            'modified_at' => [
                'type' => 'datetime',
                'null' => true,
			],
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey('id_jobs', 'jobs', 'id');
        $this->forge->createTable('Benevoles');
    }

    public function down()
    {
        $this->forge->dropTable('Benevoles');
    }
}

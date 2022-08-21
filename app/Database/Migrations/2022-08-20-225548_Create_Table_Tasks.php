<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Tasks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'start' =>[
                'type'=>'datetime',
                'null'=>true,
            ],
            'end' =>[
               'type'=>'datetime',
                'null'=>true,
            ],
            'place_start' =>[
                'type'=>'varchar',
                'constraint' => '100',
                 'null'=>true,
             ],
             'id_benevoles' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
             
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_benevoles', 'benevoles', 'id');
        $this->forge->createTable('Tasks');
    }

    public function down()
    {
        $this->forge->dropTable('Tasks');
    }
}

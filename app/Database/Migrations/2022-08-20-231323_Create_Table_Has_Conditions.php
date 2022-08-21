<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Has_Conditions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_jobs' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_conditions' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_jobs', 'jobs', 'id');
        $this->forge->addForeignKey('id_conditions', 'conditions', 'id');
        $this->forge->createTable('Has_Conditions');
    }

    public function down()
    {
        $this->forge->dropTable('Has_Conditions');
    }
}

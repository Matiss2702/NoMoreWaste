<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Necessitys extends Migration
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
            'id_tasks' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_jobs', 'jobs', 'id');
        $this->forge->addForeignKey('id_tasks', 'tasks', 'id');
        $this->forge->createTable('Necessitys');
    }

    public function down()
    {
        $this->forge->dropTable('Necessitys');
    }
}

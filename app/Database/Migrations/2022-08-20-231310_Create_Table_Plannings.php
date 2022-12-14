<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Plannings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_benevoles' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'lundi' => [
                'type' => 'INT',
                'constraint' => '8',
            ],
            'mardi' => [
                'type' => 'INT',
                'constraint' => '8',
            ],
            'mercredi' => [
                'type' => 'INT',
                'constraint' => '8',
            ],
            'jeudi' => [
                'type' => 'INT',
                'constraint' => '8',
            ],
            'vendredi' => [
                'type' => 'INT',
                'constraint' => '8',
            ],        
            'id_disponibilitys' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_benevoles', 'benevoles', 'id');
        $this->forge->addForeignKey('id_disponibilitys', 'disponibilitys', 'id');
        $this->forge->createTable('Plannings');
    }

    public function down()
    {
        $this->forge->dropTable('Plannings');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Disponibilitys extends Migration
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
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Disponibilitys');
    }

    public function down()
    {
        $this->forge->dropTable('Disponibilitys');
    }
}

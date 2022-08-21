<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_Table_Admins extends Migration {
    public function up() {
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
             'mail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
             ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Admins');
    }

    public function down() {
        $this->forge->dropTable('Admins');
    }
}

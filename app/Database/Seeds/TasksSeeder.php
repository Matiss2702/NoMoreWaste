<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TasksSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
        'start' => '22/08/2022',
        'end' => '22/08/2023',
        'place_start' => '20 rue jean paul',
        'description' => 'commence en tand que cuisinier'
    ],
];
$this->db->table('tasks')->insertBatch($data);
    }
}

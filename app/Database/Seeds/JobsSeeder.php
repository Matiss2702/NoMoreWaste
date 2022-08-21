<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JobsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
        'name' => 'cuisinier',
       ],
];
$this->db->table('jobs')->insertBatch($data);
    }
}

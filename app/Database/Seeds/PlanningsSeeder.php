<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlanningsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
    ],
];
$this->db->table('plannings')->insertBatch($data);
    }
}

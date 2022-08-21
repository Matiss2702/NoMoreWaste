<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Has_ConditionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
    ],
];
$this->db->table('has_conditions')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NecessitysSeeder extends Seeder
{
    public function run()
    {
        $data = [
];
$this->db->table('necessitys')->insertBatch($data);
    }
}

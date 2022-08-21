<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DisponibilitysSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
        'start' => '21/08/2002',
        'end' => '25/09/2004',
    ],
];
$this->db->table('disponibilitys')->insertBatch($data);
    }
}

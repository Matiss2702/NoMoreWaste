<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'password' => sha1('TOTO55'),
                'mail' => 'matiss.haillouy@gmail.com',

            ],
        ];
        $this->db->table('admins')->insertBatch($data);
    }
}

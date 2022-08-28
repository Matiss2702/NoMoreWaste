<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlanningsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
              'id_benevoles'=>'1',   
              'lundi'=> '8',
              'mardi'=> '8',
              'mercredi'=> '8',   
              'jeudi'=> '8',
              'vendredi'=> '8',
              'id_disponibilitys'=>'1',
    ],
];
$this->db->table('plannings')->insertBatch($data);
    }
}

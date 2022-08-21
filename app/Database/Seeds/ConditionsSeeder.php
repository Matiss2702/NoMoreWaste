<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConditionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'question' => 'Avez-vous de l\'experience en tand que cuisinier?',
            ],
            [
                'question' => 'Avez-vous un diplome dans le domaine culinaire?',
            ],
            [
                'question' => 'Pensez-vous etre quelqu\'un de souriant?',
            ],
];
$this->db->table('conditions')->insertBatch($data);
    }
}

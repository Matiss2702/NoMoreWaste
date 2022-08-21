<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BenevolesSeeder extends Seeder
{
    public function run(){
         $data = [
            [
        'password' => sha1('TOTO56'),
        'lastname' => 'fl',
        'firstname' => 'miss',
        'mail' => 'mis@gmail.com',
        'address' => '20 rue jean paul',
        'city' => 'paris',
        'zipcode' => '77000',
        'country' => 'pologne',
        'phone' => '0788489253',
        'valided' => '1',
    ],
];
$this->db->table('benevoles')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GlobalSeeder extends Seeder{
    public function run(){
        $this->call('JobsSeeder');
        $this->call('AdminsSeeder');
        $this->call('BenevolesSeeder');
        $this->call('DisponibilitysSeeder');
        $this->call('TasksSeeder');
        $this->call('ConditionsSeeder');
        $this->call('PlanningsSeeder');
        $this->call('Has_ConditionsSeeder');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanningsModel extends Model
{
  protected $table = 'plannings';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'id_benevoles',
    'id_disponibilitys',
  ];
}

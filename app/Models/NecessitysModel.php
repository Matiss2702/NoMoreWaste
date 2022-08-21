<?php

namespace App\Models;

use CodeIgniter\Model;

class NecessitysModel extends Model
{
  protected $table = 'necessitys';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'id_jobs',
    'id_tasks',
  ];
}

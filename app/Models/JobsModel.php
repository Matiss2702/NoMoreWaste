<?php

namespace App\Models;

use CodeIgniter\Model;

class JobsModel extends Model
{
  protected $table = 'jobs';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'name',
    'created_at',
    'modified_at',
];
}

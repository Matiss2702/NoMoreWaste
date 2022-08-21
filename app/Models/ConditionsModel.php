<?php

namespace App\Models;

use CodeIgniter\Model;

class ConditionsModel extends Model
{
  protected $table = 'conditions';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'question',
    'created_at',
    'modified_at',
  ];
}

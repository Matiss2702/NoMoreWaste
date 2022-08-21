<?php
namespace App\Models;
use CodeIgniter\Model;

class Has_ConditionsModel extends Model{
    protected $table = 'has_conditions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_jobs',
        'id_conditions',
    ];
}

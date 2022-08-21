<?php
namespace App\Models;
use CodeIgniter\Model;

class DisponibilitysModel extends Model{
    protected $table = 'disponibilitys';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'start',
        'end',
    ];
}


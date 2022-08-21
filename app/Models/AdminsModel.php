<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminsModel extends Model{
    protected $table = 'admins';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'password',
        'mail',
    ];
}

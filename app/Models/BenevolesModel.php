<?php
namespace App\Models;
use CodeIgniter\Model;

class BenevolesModel extends Model{
    protected $table = 'benevoles';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'password',
        'lastname',
        'firstname',
        'mail',
        'address',
        'city',
        'phone',
        'zipcode',
        'country',
        'valided',
        'created_at',
        'modified_at',
    ];
}

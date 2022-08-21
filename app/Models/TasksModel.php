<?php
namespace App\Models;
use CodeIgniter\Model;

class TasksModel extends Model{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'start',
        'end',
        'place_start',
        'id_benevoles',
        'description',
    ];
}

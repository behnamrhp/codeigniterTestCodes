<?php
namespace App\Models;

use CodeIgniter\Model;

class apiModel extends Model
{
    protected $table = 'apiusers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email'];
}

<?php
namespace App\Models;

use CodeIgniter\Model;
class fileModel extends Model{

    protected $table='files';
    protected $allowedFields=['image'];
    protected $primaryKey='id';
    protected $returnType='array';
    protected $useTimestamps=true;
    protected $createdField='created_at';
    protected $updatedField='updated_at';


}
<?php
namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model{

    protected $table='editor';
    protected $allowedFields=['descreption'];
    protected $primaryKey='id';
    protected $returnType='array';
    protected $useTimestamps=true;
    protected $createdField='created_at';
    protected $updatedField='updated_at';




}
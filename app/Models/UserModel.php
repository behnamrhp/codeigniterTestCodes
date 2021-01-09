<?php

namespace App\Models;


use CodeIgniter\Model;
use App\Controllers\registerController;
class UserModel extends Model
{
    protected $table = 'users';
    protected $returnType='array';
    protected $allowedFields = [
        'firstname',
        'lastname',
        'username',
        'phone',
        'email',
        'password',
        'password_confirm',
    ];
    protected $primaryKey='id';
    protected $useTimestamps=true;
    protected $createdField='created_at';
    protected $updatedField='updated_at';

    public function deleterecords($id){
        $this->db->query("delete  from users where id='".$id."'");
    }
}
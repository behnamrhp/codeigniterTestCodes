<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class registerController extends BaseController
{
    public function index()
    {
        $model1= new UserModel();

        $data = [
            'users'=> $model1->orderBy('id','DESC')->paginate(2),
            'pager'=>$model1->pager,
            'title' => 'first page built',
        ];

        echo view('templates/header', $data);
        echo view('templates/footer');

    }

    public function create()
    {
        echo view('register.php');
    }

    public function store()
    {

        helper(['form','url']);
        $session=session();
        $error=$this->validate([
           'firstname'=>[
               'rules'=>'required|min_length[4]|max_length[10]',
               'label'=>'First Name',
               'errors'=>[
                   'required'=>'{field} is necessary'
               ]
           ],
           'lastname'=>'required|min_length[4]|max_length[20]',
           'username'=>'required|min_length[4]|max_length[20]|is_unique[users.username]',
           'email'=>'required|valid_email|is_unique[users.email]',
           'password'=>'required',
           'password_confirm'=>'required|matches[password]',
           'phone'=>'required|min_length[10]|max_length[12]|numeric',
        ]);

        if($error){
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'username' => $this->request->getPost('username'),
                'phone' => $this->request->getPost('phone'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT) ,
                'password_confirm' => password_hash($this->request->getPost('password_confirm'),PASSWORD_DEFAULT),
            ];
            $model1111111 = new UserModel();
            $model1111111->insert($data);
            $session->setFlashdata('msg','user created successfully');
            return redirect()->to('index');
        }else{

            echo view('register.php');

        }
    }
    public function edit($id=null){
        $model1=new UserModel();

        $data['users']=$model1->where('id',$id)->first();
        return view('edit.php',$data);
    }
    public function update(){
        helper(['form','url']);
        $session=session();
        $error=$this->validate([
            'firstname'=>'required|min_length[4]|max_length[10]',
            'lastname'=>'required|min_length[4]|max_length[20]',
            'username'=>'required|min_length[4]|max_length[20]',
            'email'=>'required|valid_email',
            'password_confirm'=>'matches[password]',
            'phone'=>'required|min_length[10]|max_length[12]|numeric',
        ]);

        if ($error){
            $model1 = new UserModel();
            $id=$this->request->getPost('id');
            $data=[
                'firstname'=>$this->request->getPost('firstname'),
                'lastname'=>$this->request->getPost('lastname'),
                'email'=>$this->request->getPost('email'),
                'username'=>$this->request->getPost('username'),
                'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                'password_confirm'=>password_hash($this->request->getPost('password_confirm'),PASSWORD_DEFAULT),
                'phone'=>$this->request->getPost('phone'),
            ];
            $data1=[
                'name'=>$this->request->getPost('name'),
                'firstname'=>$this->request->getPost('firstname'),
                'email'=>$this->request->getPost('email'),
                'username'=>$this->request->getPost('username'),
                'phone'=>$this->request->getPost('phone'),
            ];
            if(empty($data['password'])){
                $model1->update($id,$data1);
            }else{
                $model1->update($id,$data);
            }
            $session->setFlashdata('msg','user updated successfully');
            return redirect()->to('/registerController/index');


        }else{
            echo view('edit.php');

        }


    }
    public function destroy($id= null){
       $model1=new UserModel();
      $model1->delete($id);

        return redirect()->to('/registerController/index');

    }
}

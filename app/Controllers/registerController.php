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
            'users'=> $model1->orderBy('id','DESC')->paginate(3),
            'pager'=>$model1->pager,
        ];

        echo view('templates/header', $data);
        echo view('templates/footer');

    }
    public function loaddata(){
        $model1111111 = new UserModel();
        $data = [
            'users'=> $model1111111->orderBy('id','DESC')->paginate(3),
            'pager'=>$model1111111->pager,
        ];
            echo json_encode($data);


    }

    public function create()
    {
        echo view('register.php');
    }

    public function store()
    {

        $validation = \Config\Services::validation();
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
                'password_confirm' => password_hash($this->request->getPost('password_confirm'),PASSWORD_DEFAULT) ,
            ];
            $model1111111 = new UserModel();

            $success=$model1111111->insert($data);

            $data1 = [
                'users'=> $model1111111->orderBy('id','DESC')->paginate(3),

                'pager'=>$model1111111->pager,
            ];


            if($success==true){

                echo json_encode($data1);
            }else{
                $failed='failed';
                echo json_encode($failed);
            }
        }else{
            $msg=[
                'msgs'=>[
                    'firstname'=>$validation->getError('firstname'),
                    'lastname'=>$validation->getError('lastname'),
                    'usernameE'=>$validation->getError('username'),
                    'emailE'=>$validation->getError('email'),
                    'passwordE'=>$validation->getError('password'),
                    'password_confirmE'=>$validation->getError('password_confirm'),
                    'phoneE'=>$validation->getError('phone'),
                ],
            ];

            echo json_encode($msg);
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
    public function ajaxdestroy(){
        $model1=new UserModel();
        $id=$this->request->getPost();
        $model1->delete($id);
        $model1111111 = new UserModel();
        $data1 = [
            'users'=> $model1111111->orderBy('id','DESC')->paginate(3),
            'pager'=>$model1111111->pager,
        ];
        echo json_encode($data1);
    }

    public function ajaxupdateshow()
    {
        $model = new UserModel();
        $id = $this->request->getPost('id');
        $data['user'] = $model->where('id', $id)->first();
        echo json_encode($data);
    }

    public function ajaxupdate(){
        helper(['form','url']);
        $error=$this->validate([
            'firstname'=>'required|min_length[4]|max_length[10]',
            'lastname'=>'required|min_length[4]|max_length[20]',
            'username'=>'required|min_length[4]|max_length[20]',
            'email'=>'required|valid_email',
            'password_confirm'=>'matches[password]',
            'phone'=>'required|min_length[10]|max_length[12]|numeric',
        ]);

        $validation = \Config\Services::validation();
        helper(['form', 'url']);

        if($error) {

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
            $data1 = [
                'users'=> $model1->orderBy('id','DESC')->paginate(3),
                'pager'=>$model1->pager,
            ];
                echo json_encode($data1);
        } else {

            $msg = [
                'msgs' => [
                    'firstname' => $validation->getError('firstname'),
                    'lastname' => $validation->getError('lastname'),
                    'usernameE' => $validation->getError('username'),
                    'emailE' => $validation->getError('email'),
                    'passwordE' => $validation->getError('password'),
                    'password_confirmE' => $validation->getError('password_confirm'),
                    'phoneE' => $validation->getError('phone'),
                ],
            ];

            echo json_encode($msg);
        }
    }


}

<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use  App\Models\apiModel;

class v1userController extends ResourceController{
    use ResponseTrait;


    public function index(){

        $model=new apiModel();
        $data['users']=$model->orderBy('id','DESC')->findAll();
        return $this->respond($data);
    }

    public function create(){
        $model=new apiModel();
        $data=[
            'name'=>$this->request->getPost('name'),
            'email'=>$this->request->getPost('email')
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Employee created successfully'
            ]
        ];
        return $this->respond($response);
    }

    public function show($id=null){
        $model=new apiModel();
        $data=$model->where('id',$id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('the user you want there is not exist');
        }
    }


    public function update($id = null)
    {
        $model=new apiModel();
        $input = $this->request->getRawInput();
        $data=[
            'name'=>$input['name'],
            'email'=>$input['email']
        ];
        $model->update($id,$data);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'the user updated successfully'
                ]
            ];
            return $this->respond($response);

    }

    public function delete($id = null)
    {
     $model=new apiModel();
     $data=$model->where('id',$id)->first();
     if($data){
         $model->delete($data);
         $response = [
             'status'   => 200,
             'error'    => null,
             'messages' => [
                 'success' => 'the user successfully deleted'
             ]
         ];
         return $this->respondDeleted($response);
     }else{
         return $this->failNotFound('the user you want there is not exist');
     }
    }


}

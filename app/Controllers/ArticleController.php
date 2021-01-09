<?php
namespace App\Controllers;

use App\Models\ArticleModel;
use App\Controllers\BaseController;

class ArticleController extends BaseController{

    public function index(){
        $model1=new ArticleModel();
        $data['article']=$model1->orderBy('id','DESC')->findAll();
        echo view('ckeditorShow.php',$data);
    }
    public function create(){
        echo view('ckeditor.php');
    }
    public function store(){
        $model1=new ArticleModel();
        $data=[
            'descreption'=>$this->request->getPost('descreption'),
        ];
        $model1->insert($data);
        $session=session();
        $session->setFlashdata('msg','article saved successfully');
        redirect()->to('/ArticleController/index');
    }

}


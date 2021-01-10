<?php
namespace App\Controllers;

use App\Models\ArticleModel;
use App\Controllers\BaseController;

class ArticleController extends BaseController{

    public function index(){
        $model=new ArticleModel();
        $model1=$model->myPost();

        $data=
            ['article' =>$model->orderBy('id','DESC')->findAll(),
            'username'=>$model1['username']
        ];

        echo view('ckeditorShow.php',$data);
    }
    public function create(){


        echo view('ckeditor.php');
    }
    public function store(){

        $session=session();
        $session1=session();
        $ses=$session->get('logged_in');
        if ($ses==1){
            $model1=new ArticleModel();
            $data=[
                'descreption'=>$this->request->getPost('descreption'),
            ];
            $model1->insert($data);
            $session1->setFlashdata('msg','article saved successfully');
            return redirect()->to('/ArticleController/index');
        }else{
            $session->setFlashdata('msg','you should first log in for input blog');
            return redirect()->back();
        }

    }

}


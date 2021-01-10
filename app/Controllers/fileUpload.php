<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\fileModel;

class fileUpload extends BaseController
{

    public function index()
    {
        $model=new fileModel();
        $data=[
          'image'=>$model->orderBy('id','DESC')->findAll(),
        ];
        echo view('file.php',$data);
    }

    public function store()
    {
$error=$this->validate([
   'image'=>'uploaded[image]|max_size[image,1024]|ext_in[image,jpg,jpeg,png,gif]',
]);


if ($error){

    $file = $this->request->getFile('image');

    if ($file->getSize() > 0) {

        $model1 = new fileModel();
        $fname=$file->getRandomName();
        $data = [
            'image' => base_url('./images/').'/'.$fname,

        ];
        $dfile= $model1->insert($data);

        if ($dfile==true) {

            $file->move('./images',$fname);
        }else{

            $session = session();
            $session->setFlashdata('msg', 'file did not saved');
            return redirect()->to('/fileUpload/index');
        }

        $session = session();
        $session->setFlashdata('msg', 'file saved successfully');
        return redirect()->to('/fileUpload/index');
    }


}else{

echo view('file.php');
}

    }

    public function multipleStore()
    {


    $files = $this->request->getFileMultiple('files');

$model=new fileModel();
    foreach ($files as $file) {
        $checkExt = $file->getClientExtension();
        $checkSize=$file->getSize();

        if ($checkExt == 'jpg' or $checkExt == 'png') {

            if ($checkSize<=1569280){
                $fname=$file->getRandomName();
                $data=[
                    'image'=> base_url('./images/').'/'.$fname,
                ];
                $dfile=$model->insert($data);

                if ($dfile==true){
                    $file->move('./images', $fname);

                }else{
                    $session = session();
                    $session->setFlashdata('msg', 'file did not save');
                    return redirect()->to('/fileUpload/index');
                }

            }else{
                $session = session();
                $session->setFlashdata('msg', 'image file is too large');
                return redirect()->to('/fileUpload/index');
            }


        } else {
            $session = session();
            $session->setFlashdata('msg', 'please put just jpg or png');
            return redirect()->to('/fileUpload/index');
        }
    }
        $session = session();
        $session->setFlashdata('msg', 'all files saved successfully');
        return redirect()->to('/fileUpload/index');



    }


}

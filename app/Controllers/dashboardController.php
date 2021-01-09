<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class dashboardController extends BaseController{

    public function index(){
        $session=session();

        echo 'welcome back '.$session->get('firstname').' '.$session->get('lastname');


    }




}

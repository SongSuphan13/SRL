<?php

namespace App\Controllers;

use CodeIgniter\Controller;
class Calendar extends Controller{

    public function __construct(){

    }
	public function index(){
        

        $data = array(
                    'isHeader' => true,
                    'isTopNav' => true,
                    'isFooter' => true,
                    'isBreadcrumb' => true,
                    'menuCode' => true,
                    'screenNo' => true,
                );

        echo view('calendar/index',$data);
	}
}

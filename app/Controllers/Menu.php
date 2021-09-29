<?php 
    namespace App\Controllers;

    use CodeIgniter\Controller;
    // use App\Models\UserModel;

    class Menu extends Controller{
     
        public function index(){
            helper(['form', 'url']);
            $data['patent_id'] = (int)$this->request->uri->getSegment(2);
         
            return view('menu',$data);
        }
    }

?>
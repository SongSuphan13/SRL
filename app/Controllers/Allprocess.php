<?php 
    namespace App\Controllers;

    use CodeIgniter\Controller;
    // use App\Models\UserModel;

    class Allprocess extends Controller{
     
        function __construct() {
            helper(['func']);
        }
        public function getAmphure(){
            
            $province_code = $this->request->getPostGet('province_code'); 
            $array_a = db2array('amphure_code','amphure_name_th','master_amphure'," 1=1 and province_code = '".$province_code."'",$order='');
            echo json_encode($array_a,JSON_NUMERIC_CHECK);   
        }
        public function getTambon(){
         
            $amphure_code = $this->request->getPostGet('amphure_code'); 
            $array_a = db2array('tambon_code','tambon_name_th','master_tambon'," 1=1 and amphure_code = '".$amphure_code."'",$order='');
            echo json_encode($array_a,JSON_NUMERIC_CHECK);   
        }
        public function getZipcode(){
            $db = db_connect();
            $tambon_code = $this->request->getPostGet('tambon_code');
            $builder = $db->table('master_tambon');
            $builder->select('zipcode');
            $builder->where('tambon_code',$tambon_code);
            $res   = $builder->get()->getResultArray();
            echo $res[0]['zipcode'];
        } 
    }

?>
<?php 
    namespace App\Controllers\UserAccount;

    use CodeIgniter\Controller;
    use App\Models\UserAccount\AutUserModel;
    use App\Models\AutGroupMenuModel;

    class AutUser extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            helper(['func']);
            $this->screenNo = 'A009';
            $this->menuCode = 9;
        }
        public function index(){

            $db = db_connect(); 
            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $page = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $offset = ($page-1)*$limit;

            $province_code = trim($this->request->getPostGet('province_code'));  
            $amphure_code = trim($this->request->getPostGet('amphure_code'));  
            $tambon_name_th = trim($this->request->getPostGet('tambon_name_th'));  
            $tambon_name_en = trim($this->request->getPostGet('tambon_name_en'));  
            
            $f_where = array();
            $f_like = array();
            // if($province_code){
            //     $f_where['master_tambon.province_code'] = $province_code;
            // }
            // if($amphure_code){
            //     $f_where['master_tambon.amphure_code'] = $amphure_code;
            // }
            // if($tambon_name_th){
            //     $f_like['master_tambon.tambon_name_th'] = $tambon_name_th;
            // }
            // if($tambon_name_en){
            //     $f_like['master_tambon.tambon_name_en'] = $tambon_name_en;
            // }
            $f_where['aut_user.delete_flag'] = 0;

            $builder = $db->table('aut_user');
            $builder->select('aut_user.*,master_prefix.prefix_name_th');
            $builder->join('master_prefix', 'master_prefix.prefix_id = aut_user.prefix_id','left');
            $builder->where($f_where);
            $builder->like($f_like);

            $num_rows = $builder->countAllResults(false);
            $builder->limit($limit,$offset);

            $getResult = $builder->get(); 
      
            $data = array (
                        'isContent' => true,
                        'isHeader' => true,
                        'isTopNav' => true,
                        'isFooter' => true,
                        'isBreadcrumb' => true,
                        'isForm' => false,
                        'menuCode' => $this->menuCode,
                        'screenNo' => $this->screenNo,
                        'isPost' => $this->request->getPostGet(),
                        'objData' => $getResult->getResultArray(),
                        'numRows'  => $num_rows,
                        'offset'  => $offset,
                        'pagination' => endPaging($num_rows,$limit,$page),
                     );
            echo view('user_account/aut_user/index',$data);

        }
        public function create($id=0){ 
		   $data = array (
                'isContent' => true,
                'isHeader' => true,
                'isTopNav' => true,
                'isFooter' => true,
                'isBreadcrumb' => true,
                'isForm' => '(เพิ่มข้อมูล)',
                'menuCode' => $this->menuCode,
                'screenNo' => $this->screenNo,
                'objPrefix' => db2array('prefix_id','prefix_name_th','master_prefix',array(),$order=''),
                'isFormType' => 'add'
            );
            if($id){
                $autUserModel = new AutUserModel();
                $data['objData'] = $autUserModel->where('user_id',$id)->first(); 
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
                $data['isFormType'] = 'edit';
            }
            return view('user_account/aut_user/create',$data);
        }
        public function menu($id=0){ 
            $data = array (
                'isContent' => true,
                'isHeader' => true,
                'isTopNav' => true,
                'isFooter' => true,
                'isBreadcrumb' => true,
                'isForm' => '(กำหนดเมนู)',
                'menuCode' => $this->menuCode,
                'screenNo' => $this->screenNo,
            );
            if($id){
                $autUserModel = new AutUserModel();
                $data['objData'] = $autUserModel->where('user_id',$id)->first(); 
            }
            return view('user_account/aut_user/menu',$data);
        }
        public function save_menu(){
            $f = array();
            $arr_txt = array();
            $arr_menu = $this->request->getVar('MENU');
            $srl_id = $this->request->getVar('srl_id');
            try {

                if(count($arr_menu) > 0 ){ 
                    foreach($arr_menu as $k => $v){
                        $arr_per = explode('|',$v);
                        if(isset($arr_per[1]) > 0 ){
                            $arr_txt[$arr_per[1]][] = $arr_per[0];
                        }
                    }
                }
            
                $autGroupMenuModel = new AutGroupMenuModel(); 
                $autGroupMenuModel->where(array('user_id'=> $srl_id,'user_type' =>'G'))->delete();
                if(count($arr_txt) > 0 ){
                    foreach($arr_txt as $k_menu => $v_menu){
                        if($k_menu){
                            $f = array();
                            $f['menu_id'] = $k_menu;
                            $f['group_id'] = $srl_id;
                            $f['user_type'] = 'U';
                            foreach($v_menu as $k => $v){
                                $f['user_'.$v] = 1;
                            }
                            $autGroupMenuModel->save($f);
                        }
                    }
                }

                $response['statusCode'] = '150';
                $response['msg'] = 'บันทึกข้อมูลสำเสร็จ';
            } catch (\Exception $e) {

                $response['statusCode'] = '151';
                $response['msg'] = 'บันทึกข้อมูลไม่สำเสร็จ';
            }
            echo json_encode($response);
        }
        public function save(){
       
            $db = db_connect();
            $response = array();
            $rules = [
                        'prefix_id' =>'required',
                        'fristname' =>'required',
                        'lastname' =>'required',
                        'username' =>'required',
                        'active_status' =>'required',
                    ];
            if($this->validate($rules)) {
                try {
                    $autUserModel = new AutUserModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'username' => $this->request->getVar('username'),
                                    'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
                                    'prefix_id' => $this->request->getVar('prefix_id'),
                                    'fristname' => $this->request->getVar('fristname'),
                                    'lastname' => $this->request->getVar('lastname'),
                                    'email' => $this->request->getVar('email'),
                                    'telephone' => $this->request->getVar('telephone'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0,
                                );
                        $autUserModel->save($data);
                    }else{
                        $data = array(
                                    'username' => $this->request->getVar('username'),
                                    'prefix_id' => $this->request->getVar('prefix_id'),
                                    'fristname' => $this->request->getVar('fristname'),
                                    'lastname' => $this->request->getVar('lastname'),
                                    'email' => $this->request->getVar('email'),
                                    'telephone' => $this->request->getVar('telephone'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0,
                                );
                            if($this->request->getVar('telephone') == 1){
                                $data['password'] = password_hash($this->request->getVar('password'),PASSWORD_DEFAULT);
                            }
                        $autUserModel->update($srl_id,$data);
                    }

                    $response['statusCode'] = '150';
                    $response['msg'] = 'บันทึกข้อมูลสำเสร็จ';
                } catch (\Exception $e) {
                   
                    $response['statusCode'] = '151';
                    $response['msg'] = 'บันทึกข้อมูลไม่สำเสร็จ';
                    $response['msg_error'] = $e->getMessage();
                }
            }else{

                $response['statusCode'] = '152';
                $response['msg'] = 'กรอกข้อมูลไม่ครบถ้วน';
            }
            echo json_encode($response);
        }
        public function delete($id=null){
            if($id){
                try {
                   
                    $autUserModel = new AutUserModel(); 
                    $data['delete_flag'] = 1;
                    $autUserModel->update($id,$data);

                    $response['statusCode'] = '150';
                    $response['msg'] = 'บันทึกข้อมูลสำเสร็จ';
                } catch (\Exception $e) {

                    $response['statusCode'] = '151';
                    $response['msg'] = 'บันทึกข้อมูลไม่สำเสร็จ';
                }
            }else{
                $response['statusCode'] = '153';
                $response['msg'] = 'กรุณาระบุข้อมูลให้ถูกต้อง';
            }
            echo json_encode($response);
        }
    }

?>
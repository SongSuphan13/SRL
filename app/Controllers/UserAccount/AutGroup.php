<?php 
    namespace App\Controllers\UserAccount;

    use CodeIgniter\Controller;
    use App\Models\UserAccount\AutGroupModel;
    use App\Models\AutGroupMenuModel;

    class AutGroup extends Controller{
     
        public function index(){

            helper(['func']);

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $s_group_code = $this->request->getPostGet('group_code');  
            $s_group_name_th = $this->request->getPostGet('group_name_th');  
            $s_group_name_en = $this->request->getPostGet('group_name_en');  
            $s_active_status= $this->request->getPostGet('s_active_status');   
            
            $data = [];
            $autgroupModel = new AutGroupModel();

            if($s_group_code != ''){
                $autgroupModel->where('group_code',$s_group_code);
            }
            if($s_group_name_th != ''){
                $autgroupModel->where('group_name_th',$s_group_name_th);
            }
            if($s_group_name_en != ''){
                $autgroupModel->where('group_name_en',$s_group_name_en);
            }
            if($s_active_status != ''){
                $autgroupModel->where('active_status',$s_active_status);
            }

            $autgroupModel->where('delete_flag',0);
            $num_rows = $autgroupModel->countAllResults(false);
            $limit = ($limit=='all')?$num_rows:$limit;

            $data['data'] = $autgroupModel->paginate($limit,'',$offset); 
            $data['isBreadcrumb'] = true;
            $data['menu_code'] = 3;
            $data['num_rows'] = $num_rows;
            $data['s_post'] = $this->request->getPostGet();
            $data['pagination'] =  $autgroupModel->pager->makeLinks($offset,$limit,$num_rows);
       
            echo view('user_account/aut_group/index',$data);
        }
        public function view($id=0){
            $data = [];
            $data['dataObj'] = array();
            if($id){
                $autgroupModel = new AutGroupModel();
                $data['dataObj'] = $autgroupModel->where('group_id',$id)->first();
            }
            echo view('user_account/aut_group/view',$data);
        }
        public function create($id=0){
            $data = [];
            $data['objData'] = array();
            if($id){
                $autgroupModel = new AutGroupModel();
                $data['objData'] = $autgroupModel->where('group_id',$id)->first();
            }
            echo view('user_account/aut_group/create',$data);
        }
        public function menu($id=0){
            $data = [];
            $data['objData'] = array();
            if($id){
                $autgroupModel = new AutGroupModel();
                $data['objData'] = $autgroupModel->where('group_id',$id)->first();
            }
            echo view('user_account/aut_group/menu',$data);
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
                $autGroupMenuModel->where(array('group_id'=> $srl_id,'user_type' =>'G'))->delete();
                if(count($arr_txt) > 0 ){
                    foreach($arr_txt as $k_menu => $v_menu){
                        if($k_menu){
                            $f = array();
                            $f['menu_id'] = $k_menu;
                            $f['group_id'] = $srl_id;
                            $f['user_type'] = 'G';
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

            helper(['form', 'url','func']);
            $response = array();
            $rules = [
                        'group_seq' =>'required',
                        'group_code' =>'required',
                        'group_name_th' =>'required',
                        'active_status' =>'required',
                    ];
            $messages = [
                "group_seq" => [
                        "required" => "กรุณาระบุลำดับ",
                ],
                "group_code" => [
                        "required" => "กรุณาระบุรหัสกลุ่มสิทธิ",
                 ],
                "group_name_th" => [
                        "required" => "กรุณาระบุกลุ่มสิทธิ (TH)",
                ],
                "active_status" => [
                        "required" => "กรุณาระบุสถานะ",
                ],
            ];
            if($this->validate($rules, $messages)) {
                try {
                    $autgroupModel = new AutGroupModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'group_seq' => $this->request->getVar('group_seq'),
                                    'group_code' => $this->request->getVar('group_code'),
                                    'group_name_th' => $this->request->getVar('group_name_th'),
                                    'group_name_en' => $this->request->getVar('group_name_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $autgroupModel->save($data);
                    }else{
                        $data = array(
                                    'group_seq' => $this->request->getVar('group_seq'),
                                    'group_code' => $this->request->getVar('group_code'),
                                    'group_name_th' => $this->request->getVar('group_name_th'),
                                    'group_name_en' => $this->request->getVar('group_name_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $autgroupModel->update($srl_id,$data);
                    }
                    $response['statusCode'] = '150';
                    $response['msg'] = 'บันทึกข้อมูลสำเสร็จ';
                } catch (\Exception $e) {

                    $response['statusCode'] = '151';
                    $response['msg'] = 'บันทึกข้อมูลไม่สำเสร็จ';
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
                    $autgroupModel = new AutGroupModel(); 
                    $data['delete_flag'] = 1;
                    $autgroupModel->update($id,$data);

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
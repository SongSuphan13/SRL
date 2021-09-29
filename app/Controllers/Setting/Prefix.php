<?php 
    namespace App\Controllers\Setting;

    use CodeIgniter\Controller;
    use App\Models\Setting\MasterPrefixModel;

    class Prefix extends Controller{
     
        public function index(){

            helper(['func']);

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $s_prefix_name_th = $this->request->getPostGet('s_prefix_name_th');  
            $s_prefix_name_en = $this->request->getPostGet('s_prefix_name_en');  
            $s_prefix_nameshort_th = $this->request->getPostGet('s_prefix_nameshort_th');  
            $s_prefix_nameshort_en = $this->request->getPostGet('s_prefix_nameshort_en');  
            $s_active_status= $this->request->getPostGet('s_active_status');   
            
            $data = [];
            $prefixModel = new MasterPrefixModel();

            if($s_prefix_name_th != ''){
                $prefixModel->where('prefix_name_th',$s_prefix_name_th);
            }
            if($s_prefix_name_en != ''){
                $prefixModel->where('prefix_name_en',$s_prefix_name_en);
            }
            if($s_prefix_nameshort_th != ''){
                $prefixModel->where('prefix_nameshort_en',$s_prefix_nameshort_th);
            }
            if($s_prefix_nameshort_en != ''){
                $prefixModel->where('prefix_nameshort_en',$s_prefix_nameshort_en);
            }
            if($s_active_status != ''){
                $prefixModel->where('active_status',$s_active_status);
            }

            $prefixModel->where('delete_flag',0);
            $num_rows = $prefixModel->countAllResults(false);
            $limit = ($limit=='all')?$num_rows:$limit;

            $data['data'] = $prefixModel->paginate($limit,'',$offset); 
            $data['isBreadcrumb'] = true;
            $data['menu_code'] = 3;
            $data['num_rows'] = $num_rows;
            $data['s_post'] = $this->request->getPostGet();
            $data['pagination'] =  $prefixModel->pager->makeLinks($offset,$limit,$num_rows);
       
            echo view('Setting/Prefix/index',$data);
        }
        public function view($id=0){
            $data = [];
            $data['dataObj'] = array();
            if($id){
                $prefixModel = new MasterPrefixModel();
                $data['dataObj'] = $prefixModel->where('prefix_id',$id)->first();
            }
            echo view('setting/prefix/view',$data);
        }
        public function create($id=0){
            $data = [];
            $data['dataObj'] = array();
            if($id){
                $prefixModel = new MasterPrefixModel();
                $data['dataObj'] = $prefixModel->where('prefix_id',$id)->first();
            }
            echo view('setting/prefix/create',$data);
        }
        public function save(){

            helper(['form', 'url','func']);
            $response = array();
            $rules = [
                        'prefix_name_th' =>'required',
                        'active_status' =>'required',
                    ];
            $messages = [
                "prefix_name_th" => [
                        "required" => "กรุณาระบุคำนำหน้า (TH)",
                ],
                "active_status" => [
                        "required" => "กรุณาระบุสถานะ",
                ],
            ];
            if($this->validate($rules, $messages)) {
                try {
                    $prefix = new MasterPrefixModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'seq' => $this->request->getVar('seq'),
                                    'prefix_name_th' => $this->request->getVar('prefix_name_th'),
                                    'prefix_name_en' => $this->request->getVar('prefix_name_en'),
                                    'prefix_nameshort_th' => $this->request->getVar('prefix_nameshort_th'),
                                    'prefix_nameshort_en' => $this->request->getVar('prefix_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $prefix->save($data);
                    }else{
                        $data = array(
                                    'seq' => $this->request->getVar('seq'),
                                    'prefix_name_th' => $this->request->getVar('prefix_name_th'),
                                    'prefix_name_en' => $this->request->getVar('prefix_name_en'),
                                    'prefix_nameshort_th' => $this->request->getVar('prefix_nameshort_th'),
                                    'prefix_nameshort_en' => $this->request->getVar('prefix_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                );
                        // $prefix->where('prefix_id', $srl_id);
                        $prefix->update($srl_id,$data);
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
                    $prefix = new MasterPrefixModel(); 

                    $data['delete_flag'] = 1;
                    $prefix->update($id,$data);

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
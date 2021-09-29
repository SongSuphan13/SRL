<?php 
    namespace App\Controllers\Setting;

    use CodeIgniter\Controller;
    use App\Models\Setting\MasterBankModel;

    class Bank extends Controller{
     
        public function index(){

            helper(['func']);

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;  
            $s_bank_name_th = $this->request->getPostGet('s_prefix_name_th');  
            $s_bank_name_en = $this->request->getPostGet('s_bank_name_en');  
            $s_bank_nameshort_th = $this->request->getPostGet('s_bank_nameshort_th');  
            $s_bank_nameshort_en = $this->request->getPostGet('s_bank_nameshort_en');  
            $s_active_status= $this->request->getPostGet('s_active_status');  
           
            $data = [];
            $bankModel = new MasterBankModel();

            if($s_bank_name_th){
                $bankModel->where('bank_name_th',$s_bank_name_th);
            }
            if($s_bank_name_en){
                $bankModel->where('bank_name_en',$s_bank_name_en);
            }
            if($s_bank_nameshort_th){
                $bankModel->where('bank_nameshort_en',$s_bank_nameshort_th);
            }
            if($s_bank_nameshort_en){
                $bankModel->where('bank_nameshort_en',$s_bank_nameshort_en);
            }
            if($s_active_status){
                $bankModel->where('active_status',$s_active_status);
            }

            $bankModel->where('delete_flag',0);
            $num_rows = $bankModel->countAllResults(false);
            $limit = ($limit=='all')?$num_rows:$limit;
           
    
            $data['data'] = $bankModel->paginate($limit,'',$offset); 
            $data['num_rows'] = $num_rows; 
            $data['pagination'] =  $bankModel->pager->makeLinks($offset,$limit,$num_rows);
       
            echo view('Setting/bank/index',$data);
        }
        public function view($id=0){
            $data = [];
            $data['dataObj'] = array();
            if($id){
                $bankModel = new MasterBankModel();
                $data['dataObj'] = $bankModel->where('bank_id',$id)->first();
            }
            echo view('setting/bank/view',$data);
        }
        public function create($id=0){
            $data = [];
            $data['dataObj'] = array();
            if($id){
                $bankModel = new MasterBankModel();
                $data['dataObj'] = $bankModel->where('bank_id',$id)->first();
            }
            echo view('setting/bank/create',$data);
        }
        public function save(){

            helper(['form', 'url','func']);
            $response = array();
            $rules = [
                        'bank_name_th' =>'required',
                        'active_status' =>'required',
                    ];
            $messages = [
                "bank_name_th" => [
                        "required" => "กรุณาระบุธนาคาร (TH)",
                ],
                "active_status" => [
                        "required" => "กรุณาระบุสถานะ",
                ],
            ];
            if($this->validate($rules, $messages)) {
                try {
                    $bankModel = new MasterBankModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'seq' => $this->request->getVar('seq'),
                                    'bank_code' => $this->request->getVar('bank_code'),
                                    'bank_name_th' => $this->request->getVar('bank_name_th'),
                                    'bank_name_en' => $this->request->getVar('bank_name_en'),
                                    'bank_nameshort_th' => $this->request->getVar('bank_nameshort_th'),
                                    'bank_nameshort_en' => $this->request->getVar('bank_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                  
                        $bankModel->save($data);
                    }else{
                        $data = array(
                                    'seq' => $this->request->getVar('seq'),
                                    'bank_code' => $this->request->getVar('bank_code'),
                                    'bank_name_th' => $this->request->getVar('bank_name_th'),
                                    'bank_name_en' => $this->request->getVar('bank_name_en'),
                                    'bank_nameshort_th' => $this->request->getVar('bank_nameshort_th'),
                                    'bank_nameshort_en' => $this->request->getVar('bank_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                );
                        // $prefix->where('bank_id', $srl_id);
                        $bankModel->update($srl_id,$data);
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
                    $bankModel = new MasterBankModel(); 

                    $data['delete_flag'] = 1;
                    $bankModel->update($id,$data);

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
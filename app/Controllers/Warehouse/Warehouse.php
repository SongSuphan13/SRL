<?php 
    namespace App\Controllers\Warehouse;

    use CodeIgniter\Controller;
    use App\Models\Warehouse\MasterWarehouseModel;

    class Warehouse extends Controller{
     
        public function index(){

            helper(['func']);

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            // $s_prefix_name_th = $this->request->getPostGet('s_prefix_name_th');  
            // $s_prefix_name_en = $this->request->getPostGet('s_prefix_name_en');  
            // $s_prefix_nameshort_th = $this->request->getPostGet('s_prefix_nameshort_th');  
            // $s_prefix_nameshort_en = $this->request->getPostGet('s_prefix_nameshort_en');  
            // $s_active_status= $this->request->getPostGet('s_active_status');   
            
            $data = []; 
            $warehouseModel = new MasterWarehouseModel();

            // if($s_prefix_name_th != ''){
            //     $prefixModel->where('prefix_name_th',$s_prefix_name_th);
            // }
            // if($s_prefix_name_en != ''){
            //     $prefixModel->where('prefix_name_en',$s_prefix_name_en);
            // }
            // if($s_prefix_nameshort_th != ''){
            //     $prefixModel->where('prefix_nameshort_en',$s_prefix_nameshort_th);
            // }
            // if($s_prefix_nameshort_en != ''){
            //     $prefixModel->where('prefix_nameshort_en',$s_prefix_nameshort_en);
            // }
            // if($s_active_status != ''){
            //     $prefixModel->where('active_status',$s_active_status);
            // }

            $warehouseModel->where('delete_flag',0);
            $num_rows = $warehouseModel->countAllResults(false);
            $limit = ($limit=='all')?$num_rows:$limit;

            $data['data'] = $warehouseModel->paginate($limit,'',$offset); 
            $data['num_rows'] = $num_rows;
            $data['s_post'] = $this->request->getPostGet();
            $data['pagination'] =  $warehouseModel->pager->makeLinks($offset,$limit,$num_rows);
       
            echo view('Warehouse/warehouse/index',$data);
        }
        public function view($id=0){
            helper(['func']);
            $data = [];
            $data['objData'] = array();
            if($id){
                $warehouseModel = new MasterWarehouseModel();
                $data['objData'] = $warehouseModel->where('wh_id',$id)->first();
            }
            echo view('warehouse/warehouse/view',$data);
        }
        public function create($id=0){

            helper(['func']);

            $data = [];
            $data['objData'] = array();
         
            if($id){
                $warehouseModel = new MasterWarehouseModel();
                $data['objData'] = $warehouseModel->where('wh_id',$id)->first();
               
            }
           
            $data['objProvince'] = db2array('province_id','province_name_th','master_province',$where='1=1',$order='');
            $data['objAmphure'] = db2array('amphure_id','amphure_name_th','master_amphure'," 1=1 and province_id = '".(isset($data['objData']['province_id'])?$data['objData']['province_id']:'')."' ",$order='');
            $data['objTambon'] = db2array('tambon_id','tambon_name_th','master_tambon'," 1=1 and amphure_id = '".(isset($data['objData']['amphure_id'])?$data['objData']['amphure_id']:'')."' " ,$order='');
            echo view('warehouse/warehouse/create',$data);
        }
        public function save(){

            helper(['form', 'url','func']);
            $response = array();
            $rules = [
                        'wh_name_th' =>'required',
                        'active_status' =>'required',
                    ];
            $messages = [
                "wh_name_th" => [
                        "required" => "กรุณาระบุคลังสินค้า (TH)",
                ],
                "active_status" => [
                        "required" => "กรุณาระบุสถานะ",
                ],
            ];
            
            if($this->validate($rules, $messages)) {
                try {
                    $warehouseModel = new MasterWarehouseModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'wh_name_th' => $this->request->getVar('wh_name_th'),
                                    'wh_name_en' => $this->request->getVar('wh_name_en'),
                                    'address' => $this->request->getVar('address'),
                                    'province_id' => $this->request->getVar('province_id'),
                                    'amphure_id' => $this->request->getVar('amphure_id'),
                                    'tambon_id' => $this->request->getVar('tambon_id'),
                                    'zipcode' => $this->request->getVar('zipcode'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $warehouseModel->save($data); 
                    }else{
                        $data = array(
                                    'wh_name_th' => $this->request->getVar('wh_name_th'),
                                    'wh_name_en' => $this->request->getVar('wh_name_en'),
                                    'address' => $this->request->getVar('address'),
                                    'province_id' => $this->request->getVar('province_id'),
                                    'amphure_id' => $this->request->getVar('amphure_id'),
                                    'tambon_id' => $this->request->getVar('tambon_id'),
                                    'zipcode' => $this->request->getVar('zipcode'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        // $prefix->where('prefix_id', $srl_id);
                        $warehouseModel->update($srl_id,$data);
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
                    $warehouseModel = new MasterWarehouseModel(); 

                    $data['delete_flag'] = 1;
                    $warehouseModel->update($id,$data);

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
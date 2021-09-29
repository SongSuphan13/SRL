<?php 
    namespace App\Controllers\Product;

    use CodeIgniter\Controller;
    use App\Models\Product\ProductTypeModel;
    use App\Models\Product\ChemicalGroupModel;

    class ChemicalGroup extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            helper(['func']);
            $this->screenNo = 'A16';
            $this->menuCode = 16;
        }

        public function index(){

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $s_chemi_code = trim($this->request->getPostGet('s_chemi_code'));  
            $s_chemi_name_th = trim($this->request->getPostGet('s_chemi_name_th'));  
            $s_chemi_name_en = trim($this->request->getPostGet('s_chemi_name_en'));  
            $s_active_status = trim($this->request->getPostGet('s_active_status'));  

            $chemicalGroupModel = new ChemicalGroupModel();   
            if($s_chemi_code != ''){
                $chemicalGroupModel->where('chemi_code',$s_chemi_code);
            }
            if($s_chemi_name_th != ''){
                $chemicalGroupModel->like('chemi_name_th',$s_chemi_name_th);
            }
            if($s_chemi_name_en != ''){
                $chemicalGroupModel->like('province_name_en',$s_chemi_name_en);
            }
            if($s_active_status != ''){
                $chemicalGroupModel->where('active_status',$s_active_status);
            }
            $chemicalGroupModel->where('delete_flag',0);
            $num_rows = $chemicalGroupModel->countAllResults(false);
            $limit = ($limit=='all')?$num_rows:$limit;

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
                        'objData' => $chemicalGroupModel->paginate($limit,'',$offset),
                        'numRows'  => $num_rows,
                        'pagination' => $chemicalGroupModel->pager->makeLinks($offset,$limit,$num_rows),
                     );
            echo view('product/chemical_group/index',$data);
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
                'screenNo' =>$this->screenNo,
            );
            if($id){
                $chemicalGroupModel = new ChemicalGroupModel();   
                $data['objData'] = $chemicalGroupModel->where('chemi_id',$id)->first();
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('product/chemical_group/create',$data);
        }
        public function view($id=0){
            $data = array (
                'isContent' => true,
                'isHeader' => true,
                'isTopNav' => true,
                'isFooter' => true,
                'isBreadcrumb' => true,
                'isForm' => '(รายละเอียดข้อมูล)',
                'menuCode' => $this->menuCode,
                'screenNo' =>$this->screenNo,
            );
            if($id){
                $chemicalGroupModel = new ChemicalGroupModel();
                $data['objData'] = $chemicalGroupModel->where('chemi_id',$id)->first();
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('product/chemical_group/view',$data);

        }
        public function save(){
            $response = array();
            $rules = [
                        'chemi_seq' =>'required',
                        'chemi_code' =>'required',
                        'chemi_name_th' =>'required',
                        'active_status' =>'required',
                    ];
            if($this->validate($rules)) {
                try {
                    $chemicalGroupModel = new ChemicalGroupModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'chemi_seq' => $this->request->getVar('chemi_seq'),
                                    'chemi_code' => $this->request->getVar('chemi_code'),
                                    'chemi_name_th' => $this->request->getVar('chemi_name_th'),
                                    'chemi_name_en' => $this->request->getVar('chemi_name_en'),
                                    'chemi_nameshort_th' => $this->request->getVar('chemi_nameshort_th'),
                                    'chemi_nameshort_en' => $this->request->getVar('chemi_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $chemicalGroupModel->insert($data);
                    }else{
                        $data = array(
                                    'chemi_seq' => $this->request->getVar('chemi_seq'),
                                    'chemi_code' => $this->request->getVar('chemi_code'),
                                    'chemi_name_th' => $this->request->getVar('chemi_name_th'),
                                    'chemi_name_en' => $this->request->getVar('chemi_name_en'),
                                    'chemi_nameshort_th' => $this->request->getVar('chemi_nameshort_th'),
                                    'chemi_nameshort_en' => $this->request->getVar('chemi_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $chemicalGroupModel->update($srl_id,$data);
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
                    $chemicalGroupModel = new ChemicalGroupModel(); 

                    $data['delete_flag'] = 1;
                    $chemicalGroupModel->update($id,$data);

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
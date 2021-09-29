<?php 
    namespace App\Controllers\Product;

    use CodeIgniter\Controller;
    use App\Models\Product\ProductTypeModel;

    class ProductType extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            helper(['func']);
            $this->screenNo = 'A0013';
            $this->menuCode = 13;
        }

        public function index(){

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $s_prodtype_code = trim($this->request->getPostGet('s_prodtype_code'));  
            $s_prodtype_name_th = trim($this->request->getPostGet('s_prodtype_name_th'));  
            $s_prodtype_name_en = trim($this->request->getPostGet('s_prodtype_name_en'));  
            $s_active_status = trim($this->request->getPostGet('s_active_status'));  

            $productTypeModel = new ProductTypeModel();
            if($s_prodtype_code != ''){
                $productTypeModel->where('prodtype_code',$s_prodtype_code);
            }
            if($s_prodtype_name_th != ''){
                $productTypeModel->like('prodtype_name_th',$s_prodtype_name_th);
            }
            if($s_prodtype_name_en != ''){
                $productTypeModel->like('province_name_en',$s_prodtype_name_en);
            }
            if($s_active_status != ''){
                $productTypeModel->where('active_status',$s_active_status);
            }
            $productTypeModel->where('delete_flag',0);
            $productTypeModel->orderBy('prodtype_id', 'asc');
            $num_rows = $productTypeModel->countAllResults(false);
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
                        'objData' => $productTypeModel->paginate($limit,'',$offset),
                        'numRows'  => $num_rows,
                        'pagination' => $productTypeModel->pager->makeLinks($offset,$limit,$num_rows),
                     );
            echo view('product/product_type/index',$data);
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
                $productTypeModel = new ProductTypeModel();
                $data['objData'] = $productTypeModel->where('prodtype_id',$id)->first();
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('product/product_type/create',$data);
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
                $productTypeModel = new ProductTypeModel();
                $data['objData'] = $productTypeModel->where('prodtype_id',$id)->first();
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('product/product_type/view',$data);

        }
        public function save(){
            $response = array();
            $rules = [
                        'prodtype_seq' =>'required',
                        'prodtype_code' =>'required',
                        'prodtype_name_th' =>'required',
                        'active_status' =>'required',
                    ];
            if($this->validate($rules)) {
                try {
                    $productTypeModel = new ProductTypeModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'prodtype_seq' => $this->request->getVar('prodtype_seq'),
                                    'prodtype_code' => $this->request->getVar('prodtype_code'),
                                    'prodtype_name_th' => $this->request->getVar('prodtype_name_th'),
                                    'prodtype_name_en' => $this->request->getVar('prodtype_name_en'),
                                    'prodtype_nameshort_th' => $this->request->getVar('prodtype_nameshort_th'),
                                    'prodtype_nameshort_en' => $this->request->getVar('prodtype_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $productTypeModel->insert($data);
                    }else{
                        $data = array(
                                    'prodtype_seq' => $this->request->getVar('prodtype_seq'),
                                    'prodtype_code' => $this->request->getVar('prodtype_code'),
                                    'prodtype_name_th' => $this->request->getVar('prodtype_name_th'),
                                    'prodtype_name_en' => $this->request->getVar('prodtype_name_en'),
                                    'prodtype_nameshort_th' => $this->request->getVar('prodtype_nameshort_th'),
                                    'prodtype_nameshort_en' => $this->request->getVar('prodtype_nameshort_en'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0
                                );
                        $productTypeModel->update($srl_id,$data);
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
                    $productTypeModel = new ProductTypeModel(); 

                    $data['delete_flag'] = 1;
                    $productTypeModel->update($id,$data);

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
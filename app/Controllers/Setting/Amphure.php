<?php 
    namespace App\Controllers\Setting;

    use CodeIgniter\Controller;
    use App\Models\Setting\MasterAmphureModel;
    use App\Models\Setting\MasterPovinceModel;

    class Amphure extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            
            helper(['func']);
            $this->screenNo = 'A007';
            $this->menuCode = 7;
        }

        public function index(){
            $db = db_connect(); 
            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $page = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $offset = ($page-1)*$limit;

            $province_code = trim($this->request->getPostGet('province_code'));  
            $amphure_name_th = trim($this->request->getPostGet('amphure_name_th'));  
            $amphure_name_en = trim($this->request->getPostGet('amphure_name_en'));  
            
            $f_where = array();
            $f_like = array();
            if($province_code){
                $f_where['master_amphure.province_code'] = $province_code;
            }
            if($amphure_name_th){
                $f_like['master_amphure.amphure_name_th'] = $amphure_name_th;
            }
            if($amphure_name_en){
                $f_like['master_amphure.amphure_name_th'] = $amphure_name_en;
            }
            
            $builder = $db->table('master_amphure');
            $builder->select('province_name_th, master_amphure.*');
            $builder->join('master_province', 'master_amphure.province_code = master_province.province_code');
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
                        'objProvince' => db2array('province_code','province_name_th','master_province',$where='1=1',$order=''),
                     );
            echo view('setting/amphure/index',$data);
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
                'objProvince' => db2array('province_code','province_name_th','master_province',$where='1=1',$order=''),
            );
            if($id){
                $masterAmphureModel = new MasterAmphureModel();
                $data['objData'] = $masterAmphureModel->where('amphure_id',$id)->first();
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('setting/amphure/create',$data);
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
                $masterAmphureModel = new MasterAmphureModel();
                $masterPovinceModel = new MasterPovinceModel();
                $objData =  $masterAmphureModel->where('amphure_id',$id)->first();
                $data['objData'] = $objData;
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
                $data['province_name_th'] = $masterPovinceModel->get_name_code($objData['province_code']);
            }
            echo view('setting/amphure/view',$data);

        }
        public function save(){
            $response = array();
            $rules = [
                        'province_code' =>'required',
                        'amphure_name_th' =>'required',
                        'amphure_name_en' =>'required',
                    ];
            if($this->validate($rules)) {
                try {
                    $productTypeModel = new ProductTypeModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    // if(!$srl_id){
                    //     $data = array(
                    //                 'prodtype_seq' => $this->request->getVar('prodtype_seq'),
                    //                 'prodtype_code' => $this->request->getVar('prodtype_code'),
                    //                 'prodtype_name_th' => $this->request->getVar('prodtype_name_th'),
                    //                 'prodtype_name_en' => $this->request->getVar('prodtype_name_en'),
                    //                 'prodtype_nameshort_th' => $this->request->getVar('prodtype_nameshort_th'),
                    //                 'prodtype_nameshort_en' => $this->request->getVar('prodtype_nameshort_en'),
                    //                 'active_status' => $this->request->getVar('active_status'),
                    //                 'delete_flag' => 0
                    //             );
                    //     $productTypeModel->insert($data);
                    // }else{
                    //     $data = array(
                    //                 'prodtype_seq' => $this->request->getVar('prodtype_seq'),
                    //                 'prodtype_code' => $this->request->getVar('prodtype_code'),
                    //                 'prodtype_name_th' => $this->request->getVar('prodtype_name_th'),
                    //                 'prodtype_name_en' => $this->request->getVar('prodtype_name_en'),
                    //                 'prodtype_nameshort_th' => $this->request->getVar('prodtype_nameshort_th'),
                    //                 'prodtype_nameshort_en' => $this->request->getVar('prodtype_nameshort_en'),
                    //                 'active_status' => $this->request->getVar('active_status'),
                    //                 'delete_flag' => 0
                    //             );
                    //     $productTypeModel->update($srl_id,$data);
                    // }
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
                   
                    $masterAmphureModel = new MasterAmphureModel(); 
                    $masterAmphureModel->where(array('province_id'=> $id))->delete();

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
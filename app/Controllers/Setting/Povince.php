<?php 
    namespace App\Controllers\Setting;

    use CodeIgniter\Controller;
    use App\Models\Setting\MasterPovinceModel;

    class Povince extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            helper(['func']);
            $this->screenNo = 'A006';
            $this->menuCode = '6';
           
        }
        public function index(){

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $province_code = trim($this->request->getPostGet('province_code'));  
            $province_name_th = trim($this->request->getPostGet('province_name_th'));  
            $province_name_en = trim($this->request->getPostGet('province_name_en'));  

            $msterPovinceModel = new MasterPovinceModel();
            if($province_code != ''){
                $msterPovinceModel->where('province_code',$province_code);
            }
            if($province_name_th != ''){
                $msterPovinceModel->like('province_name_th',$province_name_th);
            }
            if($province_name_en != ''){
                $msterPovinceModel->like('province_name_en',$province_name_en);
            }

            $num_rows = $msterPovinceModel->countAllResults(false);
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
                        'objData' => $msterPovinceModel->paginate($limit,'',$offset),
                        'numRows'  => $num_rows,
                        'pagination' => $msterPovinceModel->pager->makeLinks($offset,$limit,$num_rows),
                     );
            echo view('setting/province/index',$data);
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
                $msterPovinceModel = new MasterPovinceModel();
                $data['objData'] = $msterPovinceModel->where('province_id',$id)->first();
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('setting/province/create',$data);
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
                $msterPovinceModel = new MasterPovinceModel();
                $data['objData'] = $msterPovinceModel->where('province_id',$id)->first();
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('setting/province/view',$data);
        }
        public function save(){
            $response = array();
            $rules = [
                        'province_code' =>'required',
                        'province_name_th' =>'required',
                        'province_name_en' =>'required',
                    ];
            $messages = [
                "province_code" => [
                        "required" => "กรุณาระบุรหัสจังหวัด",
                ],
                "province_name_th" => [
                    "required" => "กรุณาระบุจังหวัด (TH)",
                ],
                "province_name_en" => [
                        "required" => "กรุณาระบุจังหวัด (EN)",
                ],
            ];
            if($this->validate($rules, $messages)) {
                try {
                    $msterPovinceModel = new MasterPovinceModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'province_code' => $this->request->getVar('province_code'),
                                    'province_name_th' => $this->request->getVar('province_name_th'),
                                    'province_name_en' => $this->request->getVar('province_name_en'),
                                );
                        $msterPovinceModel->save($data);
                    }else{
                        $data = array(
                            'province_code' => $this->request->getVar('province_code'),
                            'province_name_th' => $this->request->getVar('province_name_th'),
                            'province_name_en' => $this->request->getVar('province_name_en'),
                        );
                        $msterPovinceModel->update($srl_id,$data);
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

                    $msterPovinceModel = new MasterPovinceModel(); 
                    $msterPovinceModel->where(array('province_id'=> $id))->delete();

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
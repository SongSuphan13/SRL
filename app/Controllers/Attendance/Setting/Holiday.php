<?php 
    namespace App\Controllers\Attendance\Setting;

    use CodeIgniter\Controller;
    // use App\Models\Product\ProductTypeModel;
   use App\Models\Attendance\Setting\HolidayModel;

    class Holiday extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            helper(['func']);
            $this->screenNo = 'A19';
            $this->menuCode = 19;
        }

        public function index(){
            $db = db_connect(); 
            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $page = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $offset = ($page-1)*$limit;

            $holiday_date = trim($this->request->getPostGet('holiday_date'));
            $holiday_type = trim($this->request->getPostGet('holiday_type'));
            $holiday_name_th = trim($this->request->getPostGet('holiday_name_th'));
            $holiday_name_en = trim($this->request->getPostGet('holiday_name_en'));
            
            $f_where = array();
            $f_like = array();
            if($holiday_date){
                $f_where['master_holiday.holiday_date'] = d2db($holiday_date);
            }
            if($holiday_type){
                $f_where['master_holiday.holiday_type'] = $holiday_type;
            }
            if($holiday_name_th){
                $f_like['master_holiday.holiday_name_th'] = $holiday_name_th;
            }
            if($holiday_name_en){
                $f_like['master_holiday.holiday_name_en'] = $holiday_name_en;
            }

            $f_like['master_holiday.delete_flag'] = 0;
            $builder = $db->table('master_holiday');
            $builder->select('*');
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
            echo view('attendance/setting/holiday/index',$data);
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
            );
            if($id){
                $holidayModel = new HolidayModel();
                $data['objData'] = $holidayModel->where('holiday_id',$id)->first(); 
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
                echo view('attendance/setting/holiday/create',$data);
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
                $holidayModel = new HolidayModel();
                $objData =  $holidayModel->where('holiday_id',$id)->first();
                $data['objData'] = $objData;
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('attendance/setting/holiday/view',$data);

        }
        public function import(){
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
            echo view('attendance/setting/holiday/import',$data);
        }
        public function save(){
            $db = db_connect();
            $response = array();
            $rules = [
                        'holiday_date' =>'required',
                        'holiday_type' =>'required',
                        'holiday_name_th' =>'required',
                    ];
            if($this->validate($rules)) {
                try {
                    $holidayModel = new HolidayModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){

                        $data = array(
                                    'holiday_date' => d2db($this->request->getVar('holiday_date')),
                                    'holiday_type' => $this->request->getVar('holiday_type'), 
                                    'holiday_name_th' => $this->request->getVar('holiday_name_th'),
                                    'holiday_name_en' => $this->request->getVar('holiday_name_en'),
                                    'remark' => $this->request->getVar('remark'),
                                    'active_status' => 1,
                                    'delete_flag' => 0,
                                );
                        $holidayModel->save($data);
                    }else{
                        $data = array(
                                    'holiday_date' => d2db($this->request->getVar('holiday_date')),
                                    'holiday_type' => $this->request->getVar('holiday_type'), 
                                    'holiday_name_th' => $this->request->getVar('holiday_name_th'),
                                    'holiday_name_en' => $this->request->getVar('holiday_name_en'),
                                    'remark' => $this->request->getVar('remark'),
                                    'active_status' => 1,
                                    'delete_flag' => 0
                                );
                        $holidayModel->update($srl_id,$data);
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
                   
                    $holidayModel = new HolidayModel();
                    $data['delete_flag'] = 1;
                    $holidayModel->update($id,$data);
                
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
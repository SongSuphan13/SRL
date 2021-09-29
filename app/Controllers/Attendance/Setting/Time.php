<?php 
    namespace App\Controllers\Attendance\Setting;

    use CodeIgniter\Controller;
   use App\Models\Attendance\Setting\MasterTimeModel;

    class Time extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            helper(['func']);
            $this->screenNo = 'A20';
            $this->menuCode = 20;
        }

        public function index(){
            $db = db_connect(); 
            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $page = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $offset = ($page-1)*$limit;

            $time_name_th = trim($this->request->getPostGet('time_name_th'));
            $time_nameshort_th = trim($this->request->getPostGet('time_nameshort_th'));
            $employee_type = trim($this->request->getPostGet('employee_type'));
            $active_status = trim($this->request->getPostGet('active_status'));
            
            $f_where = array();
            $f_like = array();

            if($time_name_th != ''){
                $f_like['master_time.time_name_th'] = $time_name_th;
            }
            if($time_nameshort_th != ''){
                $f_like['master_time.time_nameshort_th'] = $time_nameshort_th;
            }
            if($employee_type != ''){
                $f_where['master_time.employee_type'] = $employee_type;
            }
            if($active_status != ''){
                $f_where['master_time.active_status'] = $active_status;
            }
            
            $f_where['master_time.delete_flag'] = 0;
            $builder = $db->table('master_time');
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
            echo view('attendance/setting/time/index',$data);
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
                $masterTimeModel = new MasterTimeModel();
                $data['objData'] = $masterTimeModel->where('time_id',$id)->first(); 
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
                echo view('attendance/setting/time/create',$data);
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
                $masterTimeModel = new MasterTimeModel();
                $objData =  $masterTimeModel->where('time_id',$id)->first();
                $data['objData'] = $objData;
                $data['screenNo'] = $this->screenNo.'-'.$id;
            }
            echo view('attendance/setting/time/view',$data);
        }
        public function save(){
           
            $response = array();
            $rules = [
                        'time_name_th' =>'required',
                        'employee_type' =>'required',
                        'time_day' =>'required',
                        'time_holiday' =>'required',
                        'time_center' =>'required',
                        'time_open' =>'required',
                        'time_late' =>'required',
                        'time_in' =>'required',
                        'time_lunch_in' =>'required',
                        'time_lunch_out' =>'required',
                        'active_status' =>'required',
                    ];
            if($this->validate($rules)) {
                try {
                    $masterTimeModel = new MasterTimeModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    (array)$time_work_day = $this->request->getVar('time_work_day');
                    if(!$srl_id){
                        $data = array(
                                    'time_name_th' => $this->request->getVar('time_name_th'),
                                    'time_name_en' => $this->request->getVar('time_name_en'),
                                    'time_nameshort_th' => $this->request->getVar('time_nameshort_th'),
                                    'time_nameshort_en' => $this->request->getVar('time_nameshort_en'),
                                    'employee_type' => $this->request->getVar('employee_type'),
                                    'time_day' => $this->request->getVar('time_day'),
                                    'time_holiday' => $this->request->getVar('time_holiday'),
                                    'time_center' => $this->request->getVar('time_center'),
                                    'time_open' => $this->request->getVar('time_open'),
                                    'time_late' => $this->request->getVar('time_late'),
                                    'time_in' => $this->request->getVar('time_in'),
                                    'time_out' => $this->request->getVar('time_out'),
                                    'time_lunch_in' => $this->request->getVar('time_lunch_in'),
                                    'time_lunch_out' => $this->request->getVar('time_lunch_out'),
                                    'time_work_day' =>  (is_array($time_work_day) && count($time_work_day)>0)?implode(',',$time_work_day):'',
                                    'remark' => $this->request->getVar('remark'),
                                    'active_status' => $this->request->getVar('active_status'),
                                    'delete_flag' => 0,
                                );
                        $masterTimeModel->save($data);
                    }else{
                        $data = array(
                            'time_name_th' => $this->request->getVar('time_name_th'),
                            'time_name_en' => $this->request->getVar('time_name_en'),
                            'time_nameshort_th' => $this->request->getVar('time_nameshort_th'),
                            'time_nameshort_en' => $this->request->getVar('time_nameshort_en'),
                            'employee_type' => $this->request->getVar('employee_type'),
                            'time_day' => $this->request->getVar('time_day'),
                            'time_holiday' => $this->request->getVar('time_holiday'),
                            'time_center' => $this->request->getVar('time_center'),
                            'time_open' => $this->request->getVar('time_open'),
                            'time_late' => $this->request->getVar('time_late'),
                            'time_in' => $this->request->getVar('time_in'),
                            'time_out' => $this->request->getVar('time_out'),
                            'time_lunch_in' => $this->request->getVar('time_lunch_in'),
                            'time_lunch_out' => $this->request->getVar('time_lunch_out'),
                            'time_work_day' =>  (is_array($time_work_day) && count($time_work_day)>0)?implode(',',$time_work_day):'',
                            'remark' => $this->request->getVar('remark'),
                            'active_status' => $this->request->getVar('active_status'),
                            'delete_flag' => 0,
                        );
                        $masterTimeModel->update($srl_id,$data);
                    }

                    $response['statusCode'] = '150';
                    $response['msg'] = 'บันทึกข้อมูลสำเสร็จ';
                } catch (\Exception $e) {

                    $response['statusCode'] = '151';
                    $response['msg'] = 'บันทึกข้อมูลไม่สำเสร็จ'; 
                    $response['msg_error'] =  $e->getMessage(); 

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
                   
                    $masterTimeModel = new MasterTimeModel();
                    $data['delete_flag'] = 1;
                    $masterTimeModel->update($id,$data);
                
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
<?php 
    namespace App\Controllers\Setting;

    use CodeIgniter\Controller;
    use App\Models\Setting\MasterAmphureModel;
    use App\Models\Setting\MasterPovinceModel;
    use App\Models\Setting\MasterTambonModel;

    class Tambon extends Controller{
        protected $screenNo,$menuCode;

        public function __construct() {
            
            helper(['func']);
            $this->screenNo = 'A008';
            $this->menuCode = 8;
        }

        public function index(){
            $db = db_connect(); 
            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $page = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
            $offset = ($page-1)*$limit;

            $province_code = trim($this->request->getPostGet('province_code'));  
            $amphure_code = trim($this->request->getPostGet('amphure_code'));  
            $tambon_name_th = trim($this->request->getPostGet('tambon_name_th'));  
            $tambon_name_en = trim($this->request->getPostGet('tambon_name_en'));  
            
            $f_where = array();
            $f_like = array();
            if($province_code){
                $f_where['master_tambon.province_code'] = $province_code;
            }
            if($amphure_code){
                $f_where['master_tambon.amphure_code'] = $amphure_code;
            }
            if($tambon_name_th){
                $f_like['master_tambon.tambon_name_th'] = $tambon_name_th;
            }
            if($tambon_name_en){
                $f_like['master_tambon.tambon_name_en'] = $tambon_name_en;
            }
             

            $builder = $db->table('master_tambon');
            $builder->select('master_tambon.tambon_id,master_tambon.tambon_code,master_tambon.tambon_name_th,master_tambon.tambon_name_en,master_amphure.amphure_name_th,master_province.province_name_th');
            $builder->join('master_amphure', 'master_tambon.amphure_code = master_amphure.amphure_code','left');
            $builder->join('master_province', 'master_tambon.province_code = master_province.province_code','left');
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
                        'objProvince' => db2array('province_code','province_name_th','master_province',array(),$order=''),
                        'objAmphure' => db2array('amphure_code','amphure_name_th','master_amphure',array('province_code' => $province_code),$order=''),
                     );
            echo view('setting/tambon/index',$data);
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
                'objAmphure' => array(),
                
            );
            if($id){
                $masterTambonModel = new MasterTambonModel();
                $data['objData'] = $masterTambonModel->where('tambon_id',$id)->first(); 
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
                $data['objProvince'] = db2array('province_code','province_name_th','master_province',array(),$order='');
                $data['objAmphure'] = db2array('amphure_code','amphure_name_th','master_amphure',array('province_code' => $data['objData']['province_code']),$order='');
            }
                echo view('setting/tambon/create',$data);
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
                $masterTambonModel = new MasterTambonModel();
                $objData =  $masterTambonModel->where('tambon_id',$id)->first();
                $data['objData'] = $objData;
                $data['isForm'] = '(แก้ไขข้อมูล)';
                $data['screenNo'] = $this->screenNo.'-'.$id;
                $data['province_name_th'] = $masterPovinceModel->get_name_code($objData['province_code']);
                $data['amphure_name_th'] = $masterAmphureModel->get_name_code($objData['amphure_code']);
            }
            echo view('setting/tambon/view',$data);

        }
        public function save(){
            $db = db_connect();
            $response = array();
            $rules = [
                        'province_code' =>'required',
                        'amphure_code' =>'required',
                        'tambon_name_th' =>'required',
                        'zipcode' =>'required',
                    ];
            if($this->validate($rules)) {
                try {
                    $masterTambonModel = new MasterTambonModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){

                        $builder = $db->table('master_tambon');
                        $builder->select(' MAX(SUBSTRING(tambon_code,5,2)) as num');
                        $builder->where('province_code',$this->request->getVar('province_code'));
                        $builder->where('amphure_code',$this->request->getVar('amphure_code'));
                        $r_max =  $builder->get()->getRowArray();

                        $tambon_code = '';
                        if(isset($r_max['num']) && $r_max['num'] > 0){
                            $tambon_code = $this->request->getVar('amphure_code').sprintf('%02d',($r_max['num']+1));
                        }else{
                            $tambon_code = $this->request->getVar('amphure_code').'01';
                        }
                     
                        $data = array(
                                    'province_code' => $this->request->getVar('province_code'),
                                    'amphure_code' => $this->request->getVar('amphure_code'),
                                    'tambon_code' => $tambon_code,
                                    'tambon_name_th' => $this->request->getVar('tambon_name_th'),
                                    'tambon_name_en' => $this->request->getVar('tambon_name_en'),
                                    'zipcode' => $this->request->getVar('zipcode'),
                                );
                        $masterTambonModel->save($data);
                    }else{
                        $data = array(
                                    'province_code' => $this->request->getVar('province_code'),
                                    'amphure_code' => $this->request->getVar('amphure_code'),
                                    'tambon_name_th' => $this->request->getVar('tambon_name_th'),
                                    'tambon_name_en' => $this->request->getVar('tambon_name_en'),
                                    'zipcode' => $this->request->getVar('zipcode'),
                                );
                        $masterTambonModel->update($srl_id,$data);
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
                   
                    $masterTambonModel = new MasterTambonModel(); 
                    $masterTambonModel->where(array('tambon_id'=> $id))->delete();

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
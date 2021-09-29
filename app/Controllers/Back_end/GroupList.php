<?php 
	

    namespace App\Controllers\Back_end;

    use CodeIgniter\Controller;
    use App\Models\SrlGroupModel;

    class GroupList extends Controller{

        function __construct() {
            helper(['func']); 
        }

        public function index(){
            helper(['func']);

            $limit = ($this->request->getPostGet('limit'))?$this->request->getPostGet('limit'):20;
            $offset = ($this->request->getPostGet('page'))?$this->request->getPostGet('page'):1;
           
            $data = [];
            $groupModel = new SrlGroupModel();

            // $prefixModel->where('delete_flag',0);
            $num_rows = $groupModel->countAllResults(false);
            $limit = ($limit=='all')?$num_rows:$limit;

            // $data['data'] = $groupModel->paginate($limit,'',$offset); 
            $data['data'] = $groupModel->findAll();
            $data['isBreadcrumb'] = true;
            $data['menu_code'] = 3;
            $data['num_rows'] = $num_rows;
            // $data['pagination'] =  $groupModel->pager->makeLinks($offset,$limit,$num_rows);
       
            echo view('back-end/group_list/index',$data);
        }
        public function view($id=0){
            $data = [];
            $data['objData'] = array();
            if($id){
                $groupModel = new SrlGroupModel();
                $data['objData'] = $groupModel->where('group_id',$id)->first();
            }
            echo view('back-end/group_list/view',$data);
        }
        public function create($id=0){
            $data = [];
            $data['objData'] = array();
            if($id){
                $groupModel = new SrlGroupModel();
                $data['objData'] = $groupModel->where('group_id',$id)->first();
            }
            echo view('back-end/group_list/create',$data);
        }
        public function save(){
            helper(['form', 'url','func']);
            $response = array();
            $rules = [
                        'seq' =>'required',
                        'group_name' =>'required',
                        'active_status' =>'required',
                    ];
            $messages = [
                "seq" => [
                        "required" => "กรุณาระบุลำดับ",
                ],
                "group_name" => [
                        "required" => "กรุณาระบุชื่อกลุ่มข้อมูล",
                ],
                "active_status" => [
                    "required" => "กรุณาระบุสถานะ",
            ],
            ];
            if($this->validate($rules, $messages)) {
                try {
                    $groupModel = new SrlGroupModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                   'seq' => $this->request->getVar('seq'),
                                    'group_name' => $this->request->getVar('group_name'),
                                    'active_status' => $this->request->getVar('active_status'),
                                );
                        $groupModel->save($data);
                    }else{
                        $data = array(
                                    'seq' => $this->request->getVar('seq'),
                                    'group_name' => $this->request->getVar('group_name'),
                                    'active_status' => $this->request->getVar('active_status'),
                                );
                        $groupModel->update($srl_id,$data);
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
                    $groupModel = new SrlGroupModel();  
                    $groupModel->delete($id);

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
<?php 
     namespace App\Controllers\Back_end;

    use CodeIgniter\Controller;
    use App\Models\SrlGroupModel;
    use App\Models\SrlTableModel;

    class TableList extends Controller{

        function __construct() {
            helper(['form', 'url','func']);
        }
        public function index(){
            $data = [];
        
            $groupModel = new SrlGroupModel();
            $tableModel = new SrlTableModel();
 
            $data['objData'] = $groupModel->findAll();
            $data['objData2'] = $tableModel->findAll();
            $data['isBreadcrumb'] = true;
            $data['menu_code'] = true;
            $data['num_rows'] = true;
         
            echo view('back-end/table_list/index',$data);
        }
        public function create($id=null){
           
            $data = [];
            $data['objData'] = array();
            $data['objGroupList'] = array();
            $groupModel = new SrlGroupModel();
            if($id){
                $tableModel = new SrlTableModel();
                $data['objData'] = $tableModel->where('table_id',$id)->first();
            }
            $data['objGroupList'] = $groupModel->findAll();
            echo view('back-end/table_list/create',$data);
            
        }
        public function field($id=null){
            $data = [];

            echo view('back-end/table_list/field',$data);
        }
        public function add_field(){
            $html = "";
            $html .= " <form name=\"form_modal_save\" id=\"form_modal_save\" method=\"post\" action=\"#\">
                        <div class=\"form-group row\">
                            <label for=\"srl_field_label\" class=\"col-md-2 col-form-label hm-right\">ข้อความที่แสดง</label>
                            <div class=\"col-md-3\">
                                <input type=\"text\" name=\"srl_field_label\" id=\"srl_field_label\" class=\"form-control\" value=\"\">
                            </div>
                            <label for=\"srl_field_name\" class=\"col-md-2 col-form-label hm-right\">ชื่อ Field ในตาราง</label>
                            <div class=\"col-md-3\">
                                <input type=\"text\" name=\"srl_field_name\" id=\"srl_field_name\" class=\"form-control\" value=\"\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"srl_field_type\" class=\"col-md-2 col-form-label hm-right\">Type</label>
                            <div class=\"col-md-3\">
                                <select name=\"srl_field_type\" id=\"srl_field_type\" class=\"form-control select2\" >
                                    <option value=\"\">กรุณาเลือก</option>
                                    <option value=\"varchar\" size-value=\"255\" >varchar</option>
                                    <option value=\"int\">int</option>
                                    <option value=\"date\">date</option>
                                    <option value=\"text\">text</option>
                                    <option value=\"float\">float</option>
                                    <option value=\"datetime\">datetime</option>
                                </select>
                            </div>
                            <label for=\"srl_field_length\" class=\"col-md-2 col-form-label hm-right\">Size</label>
                            <div class=\"col-md-3\">
                                <input type=\"text\" name=\"srl_field_length\" id=\"srl_field_length\" class=\"form-control\" value=\"\">
                            </div>
                        </div>
                    </form>
                    <script>
                        $( document ).ready(function() { 
                            $('select.select2').select2({
                                allowClear: true,
                                placeholder: function(){
                                $(this).data('placeholder');
                                }
                            });
                        });
                    </script>";
            echo $html;
        }

        public function save_field(){
                
        }
        public function save(){
            $response = array();
            $rules = [
                        'seq' =>'required',
                        // 'group_name' =>'required',
                        'active_status' =>'required',
                    ];
            $messages = [
                "seq" => [
                        "required" => "กรุณาระบุลำดับ",
                ],
                // "group_name" => [
                //         "required" => "กรุณาระบุชื่อกลุ่มข้อมูล",
                // ],
                "active_status" => [
                    "required" => "กรุณาระบุสถานะ",
                ],
            ];

           if($this->validate($rules, $messages)) {
                try {
                    $tableModel = new SrlTableModel();   
                    $srl_id = $this->request->getVar('srl_id');
                    if(!$srl_id){
                        $data = array(
                                    'seq' => $this->request->getVar('seq'),
                                    'group_id' => $this->request->getVar('group_id'),
                                    'table_name_th' => $this->request->getVar('table_name_th'),
                                    'table_detail' => $this->request->getVar('table_detail'),
                                    'table_name' => $this->request->getVar('table_name'),
                                    'table_pk' => $this->request->getVar('table_pk'),
                                    'active_status' => $this->request->getVar('active_status'),
                                );
                        $tableModel->save($data);
                    }else{
                        $data = array(
                                    'seq' => $this->request->getVar('seq'),
                                    'group_id' => $this->request->getVar('group_id'),
                                    'table_name_th' => $this->request->getVar('table_name_th'),
                                    'table_detail' => $this->request->getVar('table_detail'),
                                    'table_name' => $this->request->getVar('table_name'),
                                    'table_pk' => $this->request->getVar('table_pk'),
                                    'active_status' => $this->request->getVar('active_status'),
                                );
                        $tableModel->update($srl_id,$data);
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
		public function excel(){
		
			echo view('back-end/table_list/excel');
		}
		public function import(){
			
		}
        public function delete($id=null){
            if($id){
                try {
                    $tableModel = new SrlTableModel();  
                    $tableModel->delete($id); 

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
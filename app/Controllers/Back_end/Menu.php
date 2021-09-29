<?php 
	

    namespace App\Controllers\Back_end;

    use CodeIgniter\Controller;
    class Menu extends Controller{

        function __construct() {
            helper(['func']); 
		
        }

        public function index(){
       
            $data = array(
                'isHeader' => true,
                'isMenu' => true,
                'isFooter' => true,
                'myModal' => true,
                'screenNo' => 'A-0102',
                // 'objMenu' => get_menu(''),
            );
            echo view('back-end/menu',$data);
        }
        public function add(){
            $db = db_connect();
            
            // header('Content-Type: application/json');
            $parent_id = $this->request->getPostGet('parent_id');  
            $type = $this->request->getPostGet('type');  
            $text = $this->request->getPostGet('text');  
            if($parent_id == "#" OR $parent_id == ""){
                $parent_id = 0; 
            }
            $result_max = $db->query("SELECT MAX(menu_seq) AS MX FROM aut_menu WHERE parent_id = '".$parent_id."' ")->getResultArray();
            if(count($result_max) > 0){
               $order = $result_max[0]['MX']+1;
            }else{
                $order = 0;
            }
         
            $f = array(); 
            $f['menu_name_th'] = $text;
            $f['parent_id'] = $parent_id;
            $f['active_status'] = 1;
            $f['menu_type'] = $type;
            $f['menu_seq'] = $order;
            $builder = $db->table('aut_menu');
            $builder->insert($f);
            $menu_id = $db->insertID();
       
            $array_a['id'] = $menu_id;
			
			header('Content-Type: application/json');
            echo json_encode($array_a,JSON_NUMERIC_CHECK);
        }
        public function rename(){
			
            $db = db_connect(); 
         
            $id =  stripslashes(htmlspecialchars(trim($this->request->getPostGet('id')), ENT_QUOTES ));
            $text = $this->request->getPostGet('text');
         
        
            $builder = $db->table('aut_menu');
            $builder->set('menu_name_th', $text);
            $builder->where('menu_id', $id);
            $builder->update();
        
            $array_a['id'] = $id;
            echo json_encode($array_a,JSON_NUMERIC_CHECK);

        }
        public function remove(){
         
            $id = $this->request->getPostGet('id');  
            $text = $this->request->getPostGet('text'); 

            function del_menu_tmp($mid){
                $db = db_connect();
                $result_menu = $db->query("select menu_id from aut_menu where parent_id = '".$mid."'")->getResultArray();
                foreach($result_menu as $k => $v){
                    del_menu_tmp($v['menu_id']);
                }
                $db->query("delete from aut_menu WHERE menu_id = '".$mid."'");
            } 
            del_menu_tmp($id);
            $array_a['id'] = $id;
            echo json_encode($array_a,JSON_NUMERIC_CHECK);
        }
        public function move(){
        
            $db = db_connect();

            $id = $this->request->getPostGet('id');  
            $parent_id = $this->request->getPostGet('parent_id');
            $position = $this->request->getPostGet('position');

            $m_order = 0;
            if($parent_id == "#" OR $parent_id == ""){ 
                $parent_id = 0; 
            }
            $result_order = $db->query("SELECT menu_id FROM aut_menu WHERE parent_id = '".$parent_id."' AND menu_id != '".$id."' order by menu_seq asc ")->getResultArray();
            foreach($result_order as $k => $v){
                if($position == $m_order){ 
                    $m_order++; 
                }
                $builder = $db->table('aut_menu');
                $builder->set('menu_seq', $m_order);
                $builder->where('menu_id', $v['menu_id']);
                $builder->update();
                $m_order++;

            }
           
            $builder = $db->table('aut_menu');
            $builder->set('parent_id', $parent_id);
            $builder->set('menu_seq', $position);
            $builder->where('menu_id', $id);
            $builder->update();

            $array_a['id'] = $id; 
            echo json_encode($array_a,JSON_NUMERIC_CHECK);
        }  
		 public function save(){
			$db = db_connect();
			
			$id = $this->request->getVar('menu_id');
			$menu_code = $this->request->getVar('menu_code');
			$menu_name_th = $this->request->getVar('menu_name_th');
			$menu_img = $this->request->getVar('menu_img');
			$menu_url = $this->request->getVar('menu_url');
			$menu_permis = $this->request->getVar('menu_permis');
			
			$builder = $db->table('aut_menu');
            $builder->set('menu_code', $menu_code);
            $builder->set('menu_name_th', $menu_name_th);
            $builder->set('menu_img', $menu_img);
            $builder->set('menu_url', $menu_url);
			$builder->set('menu_permis',(count($menu_permis)>0)?implode('|',$menu_permis):'');
            $builder->where('menu_id', $id);
            $builder->update();
			
			 $array_a['id'] = $id; 
			 $array_a['name'] = $menu_name_th; 
			 $array_a['change'] = 'Y'; 
            echo json_encode($array_a);
		}
		
        public function detail(){

            $menu_id = $this->request->getPostGet('menu_id'); 
            $db = db_connect();

            $result_order = $db->query("SELECT * FROM aut_menu WHERE menu_id = '".$menu_id."' ")->getResultArray();
			
			
            $html = '';
                $html .= '
					<form name="form_save" id="form_save">
						<input type="hidden" id="menu_type" value="'.$result_order[0]['menu_type'].'">
						<input type="hidden" name="menu_id" value="'.$result_order[0]['menu_id'].'">
						<div class="card">
                            <div id="wf_space" class="card-body">
                                <div class="form-group row">
                                    <label for="menu_code" class="col-md-2 col-form-label hm-right">Code <span style="color: #f46a6a">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" id="menu_code" name="menu_code" class="form-control" value="'.$result_order[0]['menu_code'].'" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="menu_name_th" class="col-md-2 col-form-label hm-right">ชื่อเมนู (TH) <span style="color: #f46a6a">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" id="menu_name_th" name="menu_name_th" class="form-control" value="'.$result_order[0]['menu_name_th'].'" required="">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label for="menu_img" class="col-md-2 col-form-label hm-right">Image</label>
                                    <div class="col-md-10">
                                        <input type="text" id="menu_img" name="menu_img" class="form-control" value="" required="">
                                    </div>
                                </div> 								';
                    if($result_order[0]['menu_type'] == 'file'){
						
						$arr_permis = array();
						$arr_permis = explode('|',$result_order[0]['menu_permis']);
						
                        $html .= '  <div class="form-group row">
                                        <label for="menu_url" class="col-md-2 col-form-label hm-right">URL <span style="color: #f46a6a">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" id="menu_url" name="menu_url" class="form-control" value="'.$result_order[0]['menu_url'].'" required="">
                                        </div>
                                    </div>
									<div class="form-group row">
										<label for="menu_permis" class="col-md-2 col-form-label hm-right">สถานะ  <span class="text-danger">*</span></label>
										<div class="col-md-10 ">
											<br>
											<div class="custom-control custom-checkbox  custom-checkbox-success mb-3">
												<input type="checkbox" class="custom-control-input" id="menu_permis1" name="menu_permis[]" value="add" required '.(in_array('add',$arr_permis)?'checked':'').' >
												<label class="custom-control-label" for="menu_permis1">เพิ่มข้อมูล</label>
											</div>
											<div class="custom-control custom-checkbox  custom-checkbox-success mb-3">
												<input type="checkbox" class="custom-control-input" id="menu_permis2" name="menu_permis[]" value="edit" required '.(in_array('edit',$arr_permis)?'checked':'').'>
												<label class="custom-control-label" for="menu_permis2">แก้ไขข้อมูล</label>
											</div>
											<div class="custom-control custom-checkbox  custom-checkbox-success mb-3">
												<input type="checkbox" class="custom-control-input" id="menu_permis3" name="menu_permis[]" value="view" required '.(in_array('view',$arr_permis)?'checked':'').'>
												<label class="custom-control-label" for="menu_permis3">ดูรายละเอียด</label>
											</div>
											<div class="custom-control custom-checkbox  custom-checkbox-success mb-3">
												<input type="checkbox" class="custom-control-input" id="menu_permis4" name="menu_permis[]" value="delete" required '.(in_array('delete',$arr_permis)?'checked':'').'>
												<label class="custom-control-label" for="menu_permis4">ลบข้อมูล</label>
											</div>
											<div class="custom-control custom-checkbox  custom-checkbox-success mb-3">
												<input type="checkbox" class="custom-control-input" id="menu_permis5" name="menu_permis[]" value="approve" required '.(in_array('approve',$arr_permis)?'checked':'').'>
												<label class="custom-control-label" for="menu_permis5">อนุมัติข้อมูล</label>
											</div>
											<div class="custom-control custom-checkbox  custom-checkbox-success mb-3">
												<input type="checkbox" class="custom-control-input" id="menu_permis6" name="menu_permis[]" value="print" required '.(in_array('print',$arr_permis)?'checked':'').'>
												<label class="custom-control-label" for="menu_permis6">พิมพ์</label>
											</div>
										</div>
									</div>';
                        }
                $html .= '    
                            </div>
                        </div>
                    </form>
					<div class="row">
						<div class="col-lg-12">
							<div class="text-sm-right">
								<a href="#!" onclick="get_save()" class="btn btn-success">
									<i class="fas fa-check"></i> บันทึก
								</a>
							</div>
						</div> <!-- end col -->
					</div>';
            echo $html;
        }
        
    }

?>
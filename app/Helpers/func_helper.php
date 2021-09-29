<?php 
    
	function check_permission($menu_code){
		if($menu_code){
			
			return true;
		}else{
			return false;
		}
	}
    function getStatus(string $val){
        switch ($val){
			case '1':
				return 'ใช้งาน';
			case '0':
				return 'ไม่ใช้งาน';
		}
    }
    function create_link($link,$get,$unget){
        $arr = array(); 
        foreach($get as $k => $v){
            if(!in_array($k,$unget)){
                $arr[$k] = $k.'='.$v;
            }
        }
        return $link.'?'.implode('&',$arr);
    }
    function d2db($value=''){
        if($value != ""){
            $old_date = explode("/", $value);
            $new_date = ($old_date[2] - 543)."-".$old_date[1]."-".$old_date[0];
        }else{
                $new_date = "";
        }
        return $new_date;
    }
    
    function db2d($value){
        if($value == "" || $value == "0000-00-00"){
            $new_date = "";
        }	else	{
            $ex_datetime = explode(' ', $value);
            $old_date = explode("-", $ex_datetime[0]);
            $new_date = $old_date[2]."/".$old_date[1]."/".($old_date[0] + 543);
        }
        return $new_date;
    }
    function db2array($id='',$name='',$table='',$where = array() ,$order=''){
     
        $db = db_connect();
        $builder = $db->table($table);
        $builder->select($id.' as id, '.$name.' as text');
        $builder->where($where);
        $res = $builder->get()->getResultArray();
        return $res;
    }
    function P($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    function getShowAddress($address,$province_id='',$amphure_id='',$tambon_id='',$zipcode='',$tel=''){
            $txt_address = '';
            $txt_address .= $address;
            $txt1 = ' ตำบล';
            $txt2 = ' อำเภอ';
            $txt3 = ' จังหวัด';
            if($province_id == 1){
                $txt1 = ' แขวง';
                $txt2 = ' เขต';
                $txt3 = ' ';
            }
            $txt_address .= $txt1.getShowTambon($tambon_id);
            $txt_address .= $txt2.getShowAmphure($amphure_id);
            $txt_address .= $txt3.getShowProvince($province_id);
            $txt_address .= ' '.$zipcode;

        return $txt_address;
    }
    function getShowProvince($province_id){
        $db = db_connect();
        $result = $db->table('master_province')->select('province_name_th')->where('province_id',$province_id)->get()->getResultArray();
        return $result[0]['province_name_th'];
    }
    function getShowAmphure($amphure_id){
        $db = db_connect();
        $result = $db->table('master_amphure')->select('amphure_name_th')->where('amphure_id',$amphure_id)->get()->getResultArray();
        return $result[0]['amphure_name_th'];
    }
    function getShowTambon($tambon_id){
        $db = db_connect();
        $result = $db->table('master_tambon')->select('tambon_name_th')->where('tambon_id',$tambon_id)->get()->getResultArray();
        return $result[0]['tambon_name_th'];
    }
    function get_breadcrumb($id,$isForm='',&$arr_txt){
        if(is_numeric($id)){
             $db = db_connect();
            $q_menu =  $db->table('aut_menu')->select('menu_id,menu_name_th,parent_id,menu_url')->where('menu_id',$id)->get()->getResultArray();
            foreach($q_menu as $key => $val){
                if(sizeof($arr_txt) == 0){
                //    $v_array = array('add' => '(เพิ่มข้อมูล)','(แก้ไขข้อมูล)','(รายละเอียดข้อมูล)');
                   $arr_txt[] = '<li class="breadcrumb-item active">'.$val['menu_name_th'].' '.$isForm.'</li>';
                   if($id == $val['menu_id'] && $isForm !=''){
                        $arr_txt[] = '<li class="breadcrumb-item "><a href="'.base_url($val['menu_url']).'" >'.$val['menu_name_th'].'</a></li>';
                    }
                }else{
                    $arr_txt[] = '<li class="breadcrumb-item "><a href="'.base_url("menu/".$val['menu_id']).'" >'.$val['menu_name_th'].'</a></li>';
                }
                get_breadcrumb($val['parent_id'],$isForm,$arr_txt);
            } 
            (array)$arr_txt;
            if(sizeof($arr_txt) > 0){
                krsort($arr_txt);
            }
            return $arr_txt;
        }
    }
    function Text($data){
        return $data;

    }
    function endPaging($num_rows_data,$limit,$page) {
        $page_all = floor($num_rows_data/$limit);
        if(($num_rows_data%$limit) > 0){
            $page_all++;
        }
        $html = "";
        if($num_rows_data > 0){
        $html .='<style>
                .f-right{
                    float: right !important;
                }
                div.dataTables_paginate {
                    margin: 0 !important;
                    white-space: nowrap !important;
                    text-align: right !important;
                }
                div.dataTables_paginate ul.pagination {
                    margin: 2px 0 !important;
                    white-space: nowrap !important;
                    justify-content: flex-end !important;
                }
                @media screen and (max-width: 767px) {
                    div.dataTables_length,div.dataTables_filter,div.dataTables_info,div.dataTables_paginate {
                        text-align: center;
                    }
                    div.dataTables_paginate ul.pagination {
                        justify-content: center !important;
                    }
                }
            </style>
            <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">หน้าที่ '.$page.' จากทั้งหมด '.$page_all.' หน้า จำนวนข้อมูลทั้งหมด '.$num_rows_data.' รายการ 
                            จำนวนแถวต่อหน้า 
                            <span class="page-list">
                                <span class="btn-group dropdown dropup">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <span class="page-size">'.((isset($_GET['limit']) && $_GET['limit'] != '')?$_GET['limit']:'20').'</span>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="'.(create_link(current_url(),$_GET,array('limit')).'&limit=20').'">20</a>
                                        <a class="dropdown-item" href="'.(create_link(current_url(),$_GET,array('limit')).'&limit=50').'">50</a>
                                        <a class="dropdown-item" href="'.(create_link(current_url(),$_GET,array('limit')).'&limit=100').'">100</a>
                                        <a class="dropdown-item" href="'.(create_link(current_url(),$_GET,array('limit')).'&limit=200').'">200</a>
                                        <a class="dropdown-item" href="'.(create_link(current_url(),$_GET,array('limit')).'&limit=500').'">500</a>
                                        <a class="dropdown-item" href="'.(create_link(current_url(),$_GET,array('limit')).'&limit=1000').'">1000</a>
                                    </div>
                                </span>
                            </span> 
                            รายการ
                        </div>  
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"> 
                            <ul class="pagination">';
                            if($page > 1){ 
                                $html .='<li class="paginate_button page-item previous">
                                            <a href="'.create_link(current_url(),$_GET,array('page')).'&page=1" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-double-left"></i></a>
                                        </li>';
                                $html .='<li class="paginate_button page-item previous" >
                                            <a href="'.create_link(current_url(),$_GET,array('page')).'&page='.($page-1).'" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a> 
                                        </li> ';
                            }
                            $c_start = $page-4;
                            if($c_start < 1){ 
                                $c_start = '1'; 
                            }
                            $c_end = $page+4;
                            if($c_end > $page_all){ 
                                $c_end = $page_all;
                            }
                            for($p=$c_start;$p<=$c_end;$p++){ 
								$link = '';
                                if($page == $p){
                                    $act = ' active'; 
                                    $link = '#!';
                                }else{
                                    $act = ''; 
                                    $link = create_link(current_url(),$_GET,array('page')).'&page='.($p);
                                }
                                $html .= ' <li class="paginate_button page-item  '.$act.'"><a href="'.$link.'" aria-controls="datatable" data-dt-idx="'.$p.'" tabindex="0" class="page-link">'.$p.'</a></li>';

                            }
                            if($page != $page_all){
                                $html .='<li class="paginate_button page-item previous">
                                            <a href="'.create_link(current_url(),$_GET,array('page')).'&page='.($page+1).'" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>';
                                        $html .=' <li class="paginate_button page-item previous" >
                                            <a href="'.create_link(current_url(),$_GET,array('page')).'&page='.($page_all).'" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-double-right"></i></a>
                                        </li>';
                            }
           $html .='       </ul>
                        </div>
                    </div>
                </div>';
        }
        return $html;
    }

    /////// function table //////
    function create_table($table_name, $field_name, $field_type, $field_length){
        // $sql_chk = db::query("SELECT COUNT(*) AS TOTAL FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_CATALOG='".strtoupper(db::$_dbName)."' AND TABLE_NAME = '".$table_name."'");
        // $rec_chk = db::fetch_array($sql_chk);
        // if($rec_chk['TOTAL'] > 0)
        // {
        //     echo "<script>alert('ตาราง ".$table_name." ถูกใช้งานแล้ว กรุณาตรวจสอบ'); window.location.href='".$_SERVER['HTTP_REFERER']."';</script>";
        //     db::db_close();
        //     exit;
        // }

        $field_length = $field_length == "" ? "" : "(".$field_length.")";

        $sql_create = " CREATE TABLE [dbo].[".$table_name."]([".$field_name."] ".$field_type." ".$field_length." NOT NULL, PRIMARY KEY ([".$field_name."]))";

    }
    function add_field($table_name, $field_name, $data_type, $length, $comment = ""){
       

        $comment_sql = "IF ((SELECT COUNT(*) from fn_listextendedproperty('MS_Description', 
                                'SCHEMA', N'dbo', 
                                'TABLE', N'".$table_name."', 
                                'COLUMN', N'".$field_name."')) > 0) 
                                EXEC sp_updateextendedproperty @name = N'MS_Description', @value = N'".$comment."'
                                , @level0type = 'SCHEMA', @level0name = N'dbo'
                                , @level1type = 'TABLE', @level1name = N'".$table_name."'
                                , @level2type = 'COLUMN', @level2name = N'".$field_name."'
                                ELSE
                                EXEC sp_addextendedproperty @name = N'MS_Description', @value = N'".$comment."'
                                , @level0type = 'SCHEMA', @level0name = N'dbo'
                                , @level1type = 'TABLE', @level1name = N'".$table_name."'
                                , @level2type = 'COLUMN', @level2name = N'".$field_name."'";
    }

    function rename_field($table,$table_name_new,$table_name_old){

        $rename = "EXEC sp_rename N'[dbo].[".$table."].[".$table_name_old."]', N'".$table_name_new."', 'COLUMN'";

    }
    function modify_field($table_name, $field_name, $field_type, $field_length){

        $modify = "ALTER TABLE [dbo].[".$table_name."] ALTER COLUMN [".$field_name."] ".$field_type.$length;

    }
    function Drop_field($table_name, $field_name){

        $drop_field = "ALTER TABLE [dbo].[".$table_name."] DROP COLUMN [".$field_name."]";

    }
    function rename_table($table_name_old, $table_name_new){

        $rename_table = "sp_rename '".$table_name_old."','".$table_name_new."' ";

    }
   
    ////// enf frunction table //////

?>
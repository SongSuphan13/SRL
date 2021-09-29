<?=$this->extend('master');?>

<?=$this->section('template_user')?>

<?=$this->endSection()?> 


<?=$this->section('content')?> 
<?php 
    $db = db_connect();
    $r_main =  $db->table('aut_menu')->select('menu_id,menu_name_th,parent_id')->where('menu_id',$menuCode)->get()->getRowArray();

    $session = session();
    $arr_menu = $session->get('user_menu');
    $user_displaymenu = $session->get('user_displaymenu');
    if($user_displaymenu == "A"){ 
        foreach($arr_menu as $key=>$val){
            foreach($val as $key2=>$val2){
                if($val2['menu_code'] == $menuCode){
                    if($key > 0){
                        $link_back =  base_url("menu/".$key);	
                    }else{
                        $link_back =  base_url("menu");
                    }
                }
            }
        }
    }else{
        $link_back =  base_url("menu");
    }
    $gtxt_menu = array();
    get_breadcrumb($menuCode,$isForm,$gtxt_menu);
?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18"><?php echo $r_main['menu_name_th'];?></h4>
            </div>
        </div>
    </div>
    <?php 
        if($isBreadcrumb){
    ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('menu/') ?>">หน้าแรก</a></li>
						<?php 
							 echo implode('',$gtxt_menu);
						?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php        
        }
    ?>
    <div class="button-items text-right">
        <a href="<?php echo base_url('attendance/setting/time/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_view" id="form_view" method="post" action="#" autocomplete="off">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['time_id'])?$objData['time_id']:''; ?>" /> 
                        <div class="form-group row">
                            <label for="time_name_th" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงาน (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['time_name_th'])?$objData['time_name_th']:''; ?>
                             </div>
                            <label for="time_name_en" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงาน (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['time_name_en'])?$objData['time_name_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_nameshort_th" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงานย่อ (TH) </label>
                            <div class="col-md-3">
                                <?php echo isset($objData['time_nameshort_th'])?$objData['time_nameshort_th']:''; ?>
                             </div>
                            <label for="time_nameshort_en" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงานย่อ (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['time_nameshort_en'])?$objData['time_nameshort_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employee_type" class="col-md-2 col-form-label hm-right">ประเภทการทำงาน<span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['employee_type'])&& $objData['employee_type'] == 'Office')?'พนักงานประจำ':''; ?> 
                                <?php echo (isset($objData['employee_type'])&& $objData['employee_type'] == 'Shift')?'พนักงานกะ':''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_day" class="col-md-2 col-form-label hm-right">ประเภทเวลาการทำงาน <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['time_day'])&& $objData['time_day'] == 'SameDay')?'วันเดียวกัน':''; ?> 
                                <?php echo (isset($objData['time_day'])&& $objData['time_day'] == 'NextDay')?'วันถัดไป':''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_holiday" class="col-md-2 col-form-label hm-right">สถานะวันทำงาน <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['time_holiday'])&& $objData['time_holiday'] == 'WorkingDay')?'วันทำงาน':''; ?> 
                                <?php echo (isset($objData['time_holiday'])&& $objData['time_holiday'] == 'Holiday')?'วันหยุด':''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_center" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงานกลาง <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['time_center'])&& $objData['time_center'] == 'Yes')?'ใช่':''; ?> 
                                <?php echo (isset($objData['time_center'])&& $objData['time_center'] == 'No')?'ไม่ใช่':''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_open" class="col-md-2 col-form-label hm-right">เวลาเริ่มแสกน <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <?php echo isset($objData['time_open'])?date('H:i',strtotime($objData['time_open'])):''; ?> น.
                            </div>
                            <label for="time_late" class="col-md-1 col-form-label hm-right">สายได้ <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <?php echo isset($objData['time_late'])?$objData['time_late']:''; ?> น.
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_in" class="col-md-2 col-form-label hm-right">เวลาเข้า <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <?php echo isset($objData['time_in'])?date('H:i',strtotime($objData['time_in'])):''; ?> น.
                            </div>
                            <label for="time_out" class="col-md-1 col-form-label hm-right">เวลาออก <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <?php echo isset($objData['time_out'])?date('H:i',strtotime($objData['time_out'])):''; ?> น.
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_lunch_in" class="col-md-2 col-form-label hm-right">เวลพักงาน <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <?php echo isset($objData['time_lunch_in'])?date('H:i',strtotime($objData['time_lunch_in'])):''; ?> น.
                            </div>
                            <label for="time_lunch_out" class="col-md-1 col-form-label hm-right">ถึง <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <?php echo isset($objData['time_lunch_out'])?date('H:i',strtotime($objData['time_lunch_out'])):''; ?>  น.
                            </div>
                        </div>
                        <?php 
                            $arr_day = array();
                            if(isset($objData['time_work_day'])){
                                $arr_day = explode(',',$objData['time_work_day']);
                            }
                        ?>
                        <div class="form-group row" <?php echo (isset($objData['employee_type'])&& $objData['employee_type'] == 'Office')?'':'style="display: none;"'; ?>>
                            <label for="time_work_day" class="col-md-2 col-form-label hm-right">วันปฏิบัติงาน <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-10">
                                <?php echo (in_array('{1}',$arr_day)?'<i class="fas fa-check-square"></i> จันทร์':'<i class="far fa-square"></i> จันทร์'); ?>&nbsp;&nbsp;
                                <?php echo (in_array('{2}',$arr_day)?'<i class="fas fa-check-square"></i> อังคาร':'<i class="far fa-square"></i> อังคาร'); ?>&nbsp;&nbsp;
                                <?php echo (in_array('{3}',$arr_day)?'<i class="fas fa-check-square"></i> พุธ':'<i class="far fa-square"></i> พุธ'); ?>&nbsp;&nbsp;
                                <?php echo (in_array('{4}',$arr_day)?'<i class="fas fa-check-square"></i> หฤหัสบดี':'<i class="far fa-square"></i> หฤหัสบดี'); ?>&nbsp;&nbsp;
                                <?php echo (in_array('{5}',$arr_day)?'<i class="fas fa-check-square"></i> ศุกร์':'<i class="far fa-square"></i> ศุกร์'); ?>&nbsp;&nbsp;
                                <?php echo (in_array('{6}',$arr_day)?'<i class="fas fa-check-square"></i> เสาร์':'<i class="far fa-square"></i> เสาร์'); ?>&nbsp;&nbsp;
                                <?php echo (in_array('{7}',$arr_day)?'<i class="fas fa-check-square"></i> อาทิตย์':'<i class="far fa-square"></i> อาทิตย์'); ?>&nbsp;&nbsp;
                                <?php echo (in_array('{8}',$arr_day)?'<i class="fas fa-check-square"></i> วันนักขัตฤกษ์':'<i class="far fa-square"></i> วันนักขัตฤกษ์'); ?>&nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">สถานะ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['active_status'])&& $objData['active_status'] == '1')?'ใช้งาน':''; ?> 
                                <?php echo (isset($objData['active_status'])&& $objData['active_status'] == '0')?'ไม่ใช้งาน':''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="remark" class="col-md-2 col-form-label hm-right">หมายเหตุ</label>
                            <div class="col-md-4">
                                <?php echo isset($objData['remark'])?$objData['remark']:''; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
  
<?=$this->endSection()?> 

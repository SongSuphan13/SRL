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
                    <form name="form_save" id="form_save" method="post" action="#" autocomplete="off">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['time_id'])?$objData['time_id']:''; ?>" /> 
                        <div class="form-group row">
                            <label for="time_name_th" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงาน (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="time_name_th" name="time_name_th" class="form-control" value="<?php echo isset($objData['time_name_th'])?$objData['time_name_th']:''; ?>" required/>
                             </div>
                            <label for="time_name_en" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงาน (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="time_name_en" name="time_name_en" class="form-control" value="<?php echo isset($objData['time_name_en'])?$objData['time_name_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_nameshort_th" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงานย่อ (TH) </label>
                            <div class="col-md-3">
                                <input type="text" id="time_nameshort_th" name="time_nameshort_th" class="form-control" value="<?php echo isset($objData['time_nameshort_th'])?$objData['time_nameshort_th']:''; ?>" required/>
                             </div>
                            <label for="time_nameshort_en" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงานย่อ (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="time_nameshort_en" name="time_nameshort_en" class="form-control" value="<?php echo isset($objData['time_nameshort_en'])?$objData['time_nameshort_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employee_type" class="col-md-2 col-form-label hm-right">ประเภทการทำงาน<span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="employee_type1" name="employee_type" class="custom-control-input" value="Office" <?php echo (isset($objData['employee_type'])&& $objData['employee_type'] == 'Office')?'checked':''; ?> required />
                                        <label class="custom-control-label" for="employee_type1">พนักงานประจำ</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="employee_type2" name="employee_type" class="custom-control-input" value="Shift" <?php echo (isset($objData['employee_type']) && $objData['employee_type'] == 'Shift')?'checked':''; ?>  required />
                                        <label class="custom-control-label" for="employee_type2">พนักงานกะ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_day" class="col-md-2 col-form-label hm-right">ประเภทเวลาการทำงาน <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="time_day1" name="time_day" class="custom-control-input" value="SameDay" <?php echo (isset($objData['time_day'])&& $objData['time_day'] == 'SameDay')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="time_day1">วันเดียวกัน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="time_day2" name="time_day" class="custom-control-input" value="NextDay" <?php echo (isset($objData['time_day']) && $objData['time_day'] == 'NextDay')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="time_day2">วันถัดไป</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_holiday" class="col-md-2 col-form-label hm-right">สถานะวันทำงาน <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="time_holiday1" name="time_holiday" class="custom-control-input" value="WorkingDay" <?php echo (isset($objData['time_holiday'])&& $objData['time_holiday'] == 'WorkingDay')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="time_holiday1">วันทำงาน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="time_holiday2" name="time_holiday" class="custom-control-input" value="Holiday" <?php echo (isset($objData['time_holiday']) && $objData['time_holiday'] == 'Holiday')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="time_holiday2">วันหยุด</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_center" class="col-md-2 col-form-label hm-right">เวลาปฏิบัติงานกลาง <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="time_center1" name="time_center" class="custom-control-input" value="Yes" <?php echo (isset($objData['time_center'])&& $objData['time_center'] == 'Yes')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="time_center1">ใช่</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="time_center2" name="time_center" class="custom-control-input" value="No" <?php echo (isset($objData['time_center']) && $objData['time_center'] == 'No')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="time_center2">ไม่ใช่</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_open" class="col-md-2 col-form-label hm-right">เวลาเริ่มแสกน <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <label class="input-group">
                                    <input type="text" id="time_open" name="time_open" class="form-control text-right time" value="<?php echo isset($objData['time_open'])?date('H:i',strtotime($objData['time_open'])):''; ?>" required/>
                                    <span class="input-group-append">
                                        <span class="input-group-text btn-primary ">
                                            น.
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <label for="time_late" class="col-md-1 col-form-label hm-right">สายได้ <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <label class="input-group">
                                    <input type="text" id="time_late" name="time_late" class="form-control text-right" onkeypress="return isNumber(event)" value="<?php echo isset($objData['time_late'])?$objData['time_late']:''; ?>" required/>
                                    <span class="input-group-append">
                                        <span class="input-group-text btn-primary ">
                                            น.
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_in" class="col-md-2 col-form-label hm-right">เวลาเข้า <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <label class="input-group">
                                    <input type="text" id="time_in" name="time_in" class="form-control text-right time" onblur="dateRegEx(this.value,this.id)" value="<?php echo isset($objData['time_in'])?date('H:i',strtotime($objData['time_in'])):''; ?>" required/>
                                    <span class="input-group-append">
                                        <span class="input-group-text btn-primary ">
                                            น.
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <label for="time_out" class="col-md-1 col-form-label hm-right">เวลาออก <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <label class="input-group">
                                    <input type="text" id="time_out" name="time_out" class="form-control text-right time"  onblur="dateRegEx(this.value,this.id)" value="<?php echo isset($objData['time_out'])?date('H:i',strtotime($objData['time_out'])):''; ?>" required/>
                                    <span class="input-group-append">
                                        <span class="input-group-text btn-primary ">
                                            น.
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_lunch_in" class="col-md-2 col-form-label hm-right">เวลพักงาน <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <label class="input-group">
                                    <input type="text" id="time_lunch_in" name="time_lunch_in" class="form-control text-right time"  onblur="dateRegEx(this.value,this.id)" value="<?php echo isset($objData['time_lunch_in'])?date('H:i',strtotime($objData['time_lunch_in'])):''; ?>" required/>
                                    <span class="input-group-append">
                                        <span class="input-group-text btn-primary ">
                                            น.
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <label for="time_lunch_out" class="col-md-1 col-form-label hm-right">ถึง <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <label class="input-group">
                                    <input type="text" id="time_lunch_out" name="time_lunch_out" class="form-control text-right time" onblur="dateRegEx(this.value,this.id)" value="<?php echo isset($objData['time_lunch_out'])?date('H:i',strtotime($objData['time_lunch_out'])):''; ?>" required/>
                                    <span class="input-group-append">
                                        <span class="input-group-text btn-primary ">
                                            น.
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <?php 
                            $arr_day = array();
                            if(isset($objData['time_work_day'])){
                                $arr_day = explode(',',$objData['time_work_day']);
                            }
                        ?>
                        <div class="form-group row" id="show_time_work_day" <?php echo (isset($objData['employee_type'])&& $objData['employee_type'] == 'Office')?'':'style="display: none;"'; ?> >
                            <label for="time_work_day" class="col-md-2 col-form-label hm-right">วันปฏิบัติงาน <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-10">
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day1" name="time_work_day[]" value="{1}" <?php echo (in_array('{1}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day1">จันทร์</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day2" name="time_work_day[]" value="{2}" <?php echo (in_array('{2}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day2">อังคาร</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day3" name="time_work_day[]" value="{3}" <?php echo (in_array('{3}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day3">พุธ</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day4" name="time_work_day[]" value="{4}" <?php echo (in_array('{4}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day4">หฤหัสบดี</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day5" name="time_work_day[]" value="{5}" <?php echo (in_array('{5}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day5">ศุกร์</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day6" name="time_work_day[]" value="{6}" <?php echo (in_array('{6}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day6">เสาร์</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day7" name="time_work_day[]" value="{7}" <?php echo (in_array('{7}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day7">อาทิตย์</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline mb-3">
                                    <input type="checkbox" class="custom-control-input" id="time_work_day8" name="time_work_day[]" value="{8}" <?php echo (in_array('{8}',$arr_day)?'checked':''); ?> required>
                                    <label class="custom-control-label" for="time_work_day8">วันนักขัตฤกษ์</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">สถานะ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active_status1" name="active_status" class="custom-control-input" value="1" <?php echo (isset($objData['active_status'])&& $objData['active_status'] == '1')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="active_status1">ใช้งาน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active_status2" name="active_status" class="custom-control-input" value="0" <?php echo (isset($objData['active_status']) && $objData['active_status'] == '0')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="active_status2">ไม่ใช้งาน</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="remark" class="col-md-2 col-form-label hm-right">หมายเหตุ</label>
                            <div class="col-md-4">
                                <textarea id="remark" name="remark" class="form-control" rows="4" cols="50"><?php echo isset($objData['remark'])?$objData['remark']:''; ?></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-sm-right">
                <a href="#!" onclick="get_save()" class="btn btn-success">
                    <i class="fas fa-check"></i> บันทึก
                </a>
            </div>
        </div> <!-- end col -->
    </div>
</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
    <script>
        $('.time').mask('99:99'); 
        function dateRegEx(date,id){
            const pattern = new RegExp("^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$");
            if (date.search(pattern)===0) {
                return true;
            }else {
                $('#'+id).val('');
                return false; 
            }
        } 
        $('[name=employee_type]').click(function(){
            if($(this).val() == 'Office'){
                $('#show_time_work_day').show();
            }else{
                $('#show_time_work_day').hide();
            }
        });
        function get_save(){
            $('#form_save input,select').each(function(){
                if ($(this).hasClass("is-invalid") ){
                    $(this).removeClass("is-invalid")
                }
            });
            $(".invalid-feedback").remove();
            var brfore = '<div class="invalid-feedback">' ;
            var after = '</div>';
            var required = 0;
           

            if($('input[id=time_name_th]:required').val() == ''){
                $('input[id=time_name_th]:required').addClass("is-invalid");
                $('input[id=time_name_th]:required').after(brfore+'กรุณาระบุเวลาปฏิบัติงาน (TH)'+after)
                required++;
            }
            if($('input:radio[name=employee_type]:checked').length == 0){
                $('input:radio[name=employee_type]').addClass("is-invalid");
                $('label[for=employee_type] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุประเภทการทำงาน'+after)
                required++;
            }
            if($('input:radio[name=time_day]:checked').length == 0){
                $('input:radio[name=time_day]').addClass("is-invalid");
                $('label[for=time_day] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุประเภทเวลาการทำงาน'+after)
                required++;
            }
            if($('input:radio[name=time_holiday]:checked').length == 0){
                $('input:radio[name=time_holiday]').addClass("is-invalid");
                $('label[for=time_holiday] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุสถานะวันทำงาน'+after)
                required++;
            }
            if($('input:radio[name=time_center]:checked').length == 0){
                $('input:radio[name=time_center]').addClass("is-invalid");
                $('label[for=time_center] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุเวลาปฏิบัติงานกลาง'+after)
                required++;
            }
            if($('input[id=time_open]:required').val() == ''){
                $('input[id=time_open]:required').addClass("is-invalid");
                $('input[id=time_open] ~ .input-group-append').after(brfore+'กรุณาระบุเวลาเริ่มแสกน'+after)
                required++;
            }
            if($('input[id=time_late]:required').val() == ''){
                $('input[id=time_late]:required').addClass("is-invalid");
                $('input[id=time_late] ~ .input-group-append').after(brfore+'กรุณาระบุสายได้'+after)
                required++;
            }
            if($('input[id=time_in]:required').val() == ''){
                $('input[id=time_in]:required').addClass("is-invalid");
                $('input[id=time_in] ~ .input-group-append').after(brfore+'กรุณาระบุเวลาเข้า'+after)
                required++;
            }
            if($('input[id=time_out]:required').val() == ''){
                $('input[id=time_out]:required').addClass("is-invalid");
                $('input[id=time_out] ~ .input-group-append').after(brfore+'กรุณาระบุเวลาออก '+after)
                required++;
            }
            if($('input[id=time_lunch_in]:required').val() == ''){
                $('input[id=time_lunch_in]:required').addClass("is-invalid");
                $('input[id=time_lunch_in] ~ .input-group-append').after(brfore+'กรุณาระบุเวลพักงาน'+after)
                required++;
            }
            if($('input[id=time_lunch_out]:required').val() == ''){
                $('input[id=time_lunch_out]:required').addClass("is-invalid");
                $('input[id=time_lunch_out] ~ .input-group-append').after(brfore+'กรุณาระบุถึง'+after)
                required++;
            }
            if($('input:radio[name=employee_type]:checked').val() == 'Office'){
                if($('input:checkbox[id^=time_work_day]:checked').length  == 0){
                    $('input:checkbox[id^=time_work_day]').addClass("is-invalid");
                    $('label[for=time_work_day] + div >  div:last-child').after(brfore+'กรุณาระบุวันปฏิบัติงาน'+after)
                    required++; 
                }

            }else{
                $('input:checkbox[id^=time_work_day]').prop('checked',false);
            }
            if($('input:radio[name=active_status]:checked').length == 0){
                $('input:radio[name=active_status]').addClass("is-invalid");
                $('label[for=active_status] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุสถานะ'+after)
                required++;
            }
            if(required > 0){
                return false;
            }
            swal({
                title: "",
                text: "คุณต้องการบันทึกข้อมูลใช่หรือไม่",
                type: "warning",
                confirmButtonClass: "btn-primary",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                showCancelButton: true,
                closeOnConfirm: false,
                // showLoaderOnConfirm: true
            }, function (){
                $.ajaxSetup({async: true});
                $.ajax({
                    type: "POST",
                    url: baseUrl+ "/attendance/setting/time/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('attendance/setting/time/') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

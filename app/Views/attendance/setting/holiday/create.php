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
        <a href="<?php echo base_url('attendance/setting/holiday/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#" autocomplete="off">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['holiday_id'])?$objData['holiday_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="holiday_date" class="col-md-2 col-form-label hm-right">วันที่หยุด <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <label class="input-group">
                                    <input type="text" class="form-control datepicker" name="holiday_date" id="holiday_date" value="<?php echo isset($objData['holiday_date'])?db2d($objData['holiday_date']):''; ?>" maxlength="10" required>
                                    <span class="input-group-append">
                                        <span class="input-group-text btn-primary ">
                                            <span class="fas fa-calendar-alt"></span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-1"></div>
                            <label for="holiday_type" class="col-md-2 col-form-label hm-right">ประเภทวันหยุด <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="holiday_type1" name="holiday_type" class="custom-control-input" value="Announce" <?php echo (isset($objData['holiday_type'])&& $objData['holiday_type'] == 'Announce')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="holiday_type1">วันหยุดตามประกาศ</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="holiday_type2" name="holiday_type" class="custom-control-input" value="More" <?php echo (isset($objData['holiday_type']) && $objData['holiday_type'] == 'More')?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="holiday_type2">วันหยุดเพิ่มเติม</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="holiday_name_th" class="col-md-2 col-form-label hm-right">วันหยุด (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="holiday_name_th" name="holiday_name_th" class="form-control" value="<?php echo isset($objData['holiday_name_th'])?$objData['holiday_name_th']:''; ?>" required/>
                             </div>
                            <label for="holiday_name_en" class="col-md-2 col-form-label hm-right">วันหยุด (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="holiday_name_en" name="holiday_name_en" class="form-control" value="<?php echo isset($objData['holiday_name_en'])?$objData['holiday_name_en']:''; ?>" />
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
        function get_save(){
            $('#form_save input,select').each(function(){
                if ( $(this).prop("required") ){
                    $(this).removeClass("is-invalid")
                }
            });
            $(".invalid-feedback").remove();
            var brfore = '<div class="invalid-feedback">' ;
            var after = '</div>';
            var required = 0;
           
            if($('input[id=holiday_date]:required').val() == ''){
                $('input[id=holiday_date]:required').addClass("is-invalid");
                $('input[id=holiday_date] ~ .input-group-append').after(brfore+'กรุณาระบุวันที่หยุด'+after)
                required++;
            }
            if($('input:radio[name=holiday_type]:checked').length == 0){
                $('input:radio[name=holiday_type]').addClass("is-invalid");
                $('label[for=holiday_type] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุประเภทวันหยุด'+after)
                required++;
            }
            if($('input[id=holiday_name_th]:required').val() == ''){
                $('input[id=holiday_name_th]:required').addClass("is-invalid");
                $('input[id=holiday_name_th]:required').after(brfore+'กรุณาระบุวันหยุด (TH)'+after)
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
                showLoaderOnConfirm: true
            }, function (){
                $.ajaxSetup({async: true});
                $.ajax({
                    type: "POST",
                    url: baseUrl+ "/attendance/setting/holiday/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('attendance/setting/holiday/') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

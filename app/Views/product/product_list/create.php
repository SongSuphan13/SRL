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
        <a href="<?php echo base_url('product/product_type//') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['prodtype_id'])?$objData['prodtype_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="prodtype_seq" class="col-md-2 col-form-label hm-right">ลำดับ <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="prodtype_seq" name="prodtype_seq" class="form-control text-right" value="<?php echo isset($objData['prodtype_seq'])?$objData['prodtype_seq']:''; ?>" onkeypress="return isNumber(event)" required/>
                            </div>
                            <label for="prodtype_code" class="col-md-2 col-form-label hm-right">รหัสรายการสินค้า <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="prodtype_code" name="prodtype_code" class="form-control" value="<?php echo isset($objData['prodtype_code'])?$objData['prodtype_code']:''; ?>" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prodtype_name_th" class="col-md-2 col-form-label hm-right">รายการสินค้า (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="prodtype_name_th" name="prodtype_name_th" class="form-control" value="<?php echo isset($objData['prodtype_name_th'])?$objData['prodtype_name_th']:''; ?>" required/>
                             </div>
                            <label for="prodtype_name_en" class="col-md-2 col-form-label hm-right">รายการสินค้า (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="prodtype_name_en" name="prodtype_name_en" class="form-control" value="<?php echo isset($objData['prodtype_name_en'])?$objData['prodtype_name_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prodtype_nameshort_th" class="col-md-2 col-form-label hm-right">รายการสินค้าย่อ (TH)</label>
                            <div class="col-md-3">
                                <input type="text" id="prodtype_nameshort_th" name="prodtype_nameshort_th" class="form-control" value="<?php echo isset($objData['prodtype_nameshort_th'])?$objData['prodtype_nameshort_th']:''; ?>" required/>
                             </div>
                            <label for="prodtype_nameshort_en" class="col-md-2 col-form-label hm-right">รายการสินค้าย่อ (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="prodtype_nameshort_en" name="prodtype_nameshort_en" class="form-control" value="<?php echo isset($objData['prodtype_nameshort_en'])?$objData['prodtype_nameshort_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">สถานะ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active_status1" name="active_status" class="custom-control-input" value="1" <?php echo (isset($objData['active_status'])&& $objData['active_status'] == 1)?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="active_status1">ใช้งาน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active_status2" name="active_status" class="custom-control-input" value="0" <?php echo (isset($objData['active_status']) && $objData['active_status'] == 0)?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="active_status2">ไม่ใช้งาน</label>
                                    </div>
                                </div>
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
            if($('input[id=prodtype_seq]:required').val() == ''){
                $('input[id=prodtype_seq]:required').addClass("is-invalid");
                $('input[id=prodtype_seq]:required').after(brfore+'กรุณาระบุลำดับ'+after)
                required++;
            }
            if($('input[id=prodtype_code]:required').val() == ''){
                $('input[id=prodtype_code]:required').addClass("is-invalid");
                $('input[id=prodtype_code]:required').after(brfore+'กรุณาระบุรหัสรายการสินค้า'+after)
                required++;
            }
            if($('input[id=prodtype_name_th]:required').val() == ''){
                $('input[id=prodtype_name_th]:required').addClass("is-invalid");
                $('input[id=prodtype_name_th]:required').after(brfore+'กรุณาระบุรายการสินค้า (TH)'+after)
                required++;
            }
            if($('input:radio[name=active_status]:checked').length == 0){
                $('input:radio[name=active_status]').addClass("is-invalid");
                $('label[for=active_status] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุคำนำหน้า (TH)'+after)
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
                    url: baseUrl+ "/product/product_type/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('product/product_type/') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

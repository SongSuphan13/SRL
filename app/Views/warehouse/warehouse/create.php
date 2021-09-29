<?=$this->extend('master');?>

<?=$this->section('template_user')?>

<?=$this->endSection()?> 


<?=$this->section('content')?>
<style>
	/* #wf_space div[class^="col-"] {
		margin-bottom: 1rem;
	}  */
    #wf_space .col-form-label {
        padding-top: 0px !important;
    }
</style>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">ข้อมูลผู้ใช้งาน</h4>
                <!--<div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="index">หน้าแรก</a></li>
                        <li class="breadcrumb-item"><a href="index">User Account</a></li>
                        <li class="breadcrumb-item active">ข้อมูลผู้ใช้งาน</li>
                    </ol>
                </div>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('menu/') ?>">หน้าแรก</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('menu/') ?>">User Account</a></li>
                        <li class="breadcrumb-item active">ข้อมูลผู้ใช้งาน</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="button-items text-right">
        <a href="<?php echo base_url('warehouse/warehouse') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['wh_id'])?$objData['wh_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="wh_name_th" class="col-md-2 col-form-label hm-right">คลังสินค้า (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="wh_name_th" name="wh_name_th" class="form-control" value="<?php echo isset($objData['wh_name_th'])?$objData['wh_name_th']:''; ?>" required/>
                             </div>
                            <label for="wh_name_en" class="col-md-2 col-form-label hm-right">คลังสินค้า (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="wh_name_en" name="wh_name_en" class="form-control" value="<?php echo isset($objData['wh_name_en'])?$objData['wh_name_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label hm-right">ที่อยู่</label>
                            <div class="col-md-3">
                                <textarea id="address" name="address" class="form-control" required><?php echo isset($objData['address'])?$objData['address']:''; ?></textarea>
                            </div>
                            <label for="province_id" class="col-md-2 col-form-label hm-right">จังหวัด</label>
                            <div class="col-md-3">
                                <select id="province_id" name="province_id" class="form-control select2" onchange="get_amphure('province_id','amphure_id','tambon_id','zipcode','')" required>
                                    <option >กรุณาเลือก</option>
                                    <?php 
                                        if(isset($objProvince) && is_array($objProvince)){
                                            foreach($objProvince as $key => $val){

                                               echo '<option value="'.$val['id'].'" '.((isset($objData['province_id']) &&  $objData['province_id'] == $val['id'])?'selected':'').' >'.$val['text'].'</option>';     
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amphure_id" class="col-md-2 col-form-label hm-right">อำเภอ</label>
                            <div class="col-md-3">
                                <select id="amphure_id" name="amphure_id" class="form-control select2" onchange="get_tambon('province_id','amphure_id','tambon_id','zipcode','')" required>
                                    <option >กรุณาเลือก</option>
                                    <?php 
                                        if(isset($objAmphure) && is_array($objAmphure)){
                                            foreach($objAmphure as $key => $val){
                                                echo '<option value="'.$val['id'].'" '.((isset($objData['amphure_id']) && $objData['amphure_id'] == $val['id'])?'selected':'').' >'.$val['text'].'</option>';   
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <label for="tambon_id" class="col-md-2 col-form-label hm-right">ตำบล</label>
                            <div class="col-md-3">
                                <select id="tambon_id" name="tambon_id" class="form-control select2" onchange="get_zipcode('province_id','amphure_id','tambon_id','zipcode','')" required>
                                    <?php 
                                        if(isset($objTambon) && is_array($objTambon)){
                                            foreach($objTambon as $key => $val){
                                                echo '<option value="'.$val['id'].'" '.((isset($objData['tambon_id']) && $objData['tambon_id'] == $val['id'])?'selected':'').' >'.$val['text'].'</option>';   
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zipcode" class="col-md-2 col-form-label hm-right">ไปรษณีย์</label>
                            <div class="col-md-3">
                                <input type="text" name="zipcode" id="zipcode" class="form-control" maxlength="5" onkeypress="return isNumber(event)"  value="<?php echo isset($objData['zipcode'])?$objData['zipcode']:''; ?>" required/>
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
            $('#form_save input,select,textarea').each(function(){
                if ( $(this).prop("required") ){
                    $(this).removeClass("is-invalid")
                }
            });

             $(".invalid-feedback").remove();
            var brfore = '<div class="invalid-feedback">' ;
            var after = '</div>';

            if($('input[id=wh_name_th]:required').val() == ''){
                $('input[id=wh_name_th]:required').addClass("is-invalid");
                $('input[id=wh_name_th]:required').after(brfore+'กรุณาระบุคลังสินค้า (TH)'+after) 
            }
            if($('textarea[id=address]:required').val() == ''){
                $('textarea[id=address]:required').addClass("is-invalid");
                $('textarea[id=address]:required').after(brfore+'กรุณาระบุที่อยู่'+after)
            }
            if($('select[id=province_id]:required').val() == '' || $('select[id=province_id]:required').val() == null){
                $('select[id=province_id]:required').addClass("is-invalid");
                $('select[id=province_id] + .select2-container').after(brfore+'กรุณาระบุคลังสินค้า (TH)'+after) 
            }
            if($('select[id=amphure_id]:required').val() == '' || $('select[id=amphure_id]:required').val() == null){
                $('select[id=amphure_id]:required').addClass("is-invalid");
                $('select[id=amphure_id] + .select2-container').after(brfore+'กรุณาระบุอำเภอ'+after) 
            }
            if($('select[id=tambon_id]:required').val() == '' || $('select[id=tambon_id]:required').val() == null){
                $('select[id=tambon_id]:required').addClass("is-invalid");
                $('select[id=tambon_id] + .select2-container').after(brfore+'กรุณาระบุคตำบล'+after) 
            }
            if($('input[id=zipcode]:required').val() == ''){
                $('input[id=zipcode]:required').addClass("is-invalid");
                $('input[id=zipcode]:required').after(brfore+'กรุณาระบุไปรษณีย์'+after) 
            }
            if($('input:radio[name=active_status]:checked').length == 0){
                $('input:radio[name=active_status]').addClass("is-invalid");
                $('label[for=active_status] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุคำนำหน้า (TH)'+after)
                // $('label[for=active_status] + div > div[class=form-group] > div:last-child>.display').removeClass('display');
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
                    url: baseUrl+ "/warehouse/warehouse/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('warehouse/warehouse/') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

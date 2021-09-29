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
        <a href="<?php echo base_url('user_account/aut_group/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['group_id'])?$objData['group_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="group_seq" class="col-md-2 col-form-label hm-right">ลำดับ <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="group_seq" name="group_seq" class="form-control" value="<?php echo isset($objData['group_seq'])?$objData['group_seq']:''; ?>" required/>
                            </div>
                            <label for="group_code" class="col-md-2 col-form-label hm-right">รหัสกลุ่มสิทธิ<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="group_code" name="group_code" class="form-control" value="<?php echo isset($objData['group_code'])?$objData['group_code']:''; ?>" required/>
                           </div>
                        </div>
                        <div class="form-group row">
                            <label for="group_name_th" class="col-md-2 col-form-label hm-right">กลุ่มสิทธิ (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="group_name_th" name="group_name_th" class="form-control" value="<?php echo isset($objData['group_name_th'])?$objData['group_name_th']:''; ?>" required/>
                             </div>
                            <label for="group_name_en" class="col-md-2 col-form-label hm-right">กลุ่มสิทธิ (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="group_name_en" name="group_name_en" class="form-control" value="<?php echo isset($objData['group_name_en'])?$objData['group_name_en']:''; ?>" />
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
            if($('input[id=group_seq]:required').val() == ''){
                $('input[id=group_seq]:required').addClass("is-invalid");
                $('input[id=group_seq]:required').after(brfore+'กรุณาระบุลำดับ'+after)
                required++;
            }
            if($('input[id=group_code]:required').val() == ''){
                $('input[id=group_code]:required').addClass("is-invalid");
                $('input[id=group_code]:required').after(brfore+'กรุณาระบุรหัสกลุ่มสิทธิ'+after)
                required++;
            }
            if($('input[id=group_name_th]:required').val() == ''){
                $('input[id=group_name_th]:required').addClass("is-invalid");
                $('input[id=group_name_th]:required').after(brfore+'กรุณาระบุกลุ่มสิทธิ (TH)'+after)
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
                    url: baseUrl+ "/user_account/aut_group/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('user_account/aut_group') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

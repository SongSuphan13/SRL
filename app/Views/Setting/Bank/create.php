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
        <a href="<?php echo base_url('setting/bank') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($dataObj['bank_id'])?$dataObj['bank_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="seq" class="col-md-2 col-form-label hm-right">ลำดับ <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="seq" name="seq" class="form-control" value="<?php echo isset($dataObj['seq'])?$dataObj['seq']:''; ?>" required/>
                            </div>
                            <label for="bank_code" class="col-md-2 col-form-label hm-right">รหัสคำนำหน้า</label>
                            <div class="col-md-3">
                                <input type="text" id="bank_code" name="bank_code" class="form-control" value="<?php echo isset($dataObj['bank_code'])?$dataObj['bank_code']:''; ?>" required/>
                           </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_name_th" class="col-md-2 col-form-label hm-right">ธนาคาร (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="bank_name_th" name="bank_name_th" class="form-control" value="<?php echo isset($dataObj['bank_name_th'])?$dataObj['bank_name_th']:''; ?>" required/>
                            </div>
                            <label for="bank_name_en" class="col-md-2 col-form-label hm-right">ธนาคาร (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="bank_name_en" name="bank_name_en" class="form-control" value="<?php echo isset($dataObj['bank_name_en'])?$dataObj['bank_name_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_nameshort_th" class="col-md-2 col-form-label hm-right">ธนาคารย่อ (TH)</label>
                            <div class="col-md-3">
                                <input type="text" id="bank_nameshort_th" name="bank_nameshort_th" class="form-control" value="<?php echo isset($dataObj['bank_nameshort_th'])?$dataObj['bank_nameshort_th']:''; ?>" />
                            </div>
                            <label for="bank_nameshort_en" class="col-md-2 col-form-label hm-right">ธนาคารย่อ (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="bank_nameshort_en" name="bank_nameshort_en" class="form-control" value="<?php echo isset($dataObj['bank_nameshort_en'])?$dataObj['bank_nameshort_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">สถานะ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active_status1" name="active_status" class="custom-control-input" value="1" <?php echo (isset($dataObj['active_status'])&& $dataObj['active_status'] == 1)?'checked':''; ?> required/>
                                        <label class="custom-control-label" for="active_status1">ใช้งาน</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active_status2" name="active_status" class="custom-control-input" value="0" <?php echo (isset($dataObj['active_status']) && $dataObj['active_status'] == 0)?'checked':''; ?> required/>
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

            if($('input[id=seq]:required').val() == ''){
                $('input[id=seq]:required').addClass("is-invalid");
                $('input[id=seq]:required').after(brfore+'กรุณาระบุลำดับ'+after)
                
            }
            if($('input[id=bank_name_th]:required').val() == ''){
                $('input[id=bank_name_th]:required').addClass("is-invalid");
                $('input[id=bank_name_th]:required').after(brfore+'กรุณาระบุธนาคาร (TH)'+after)
            }
            if($('input:radio[name=active_status]:checked').length == 0){
                $('input:radio[name=active_status]').addClass("is-invalid");
                $('label[for=active_status] + div > div[class=form-group] > div:last-child').after(brfore+'กรุณาระบุธนาคาร (TH)'+after)
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
                    url: baseUrl+ "/setting/bank/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('setting/bank') ?>'); 
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

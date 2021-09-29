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
                <h4 class="mb-0 font-size-18">บริหารกลุ่มข้อมูล</h4>
            </div>
        </div>
    </div>
    <div class="button-items text-right">
        <a href="<?php echo base_url('back-end/group_list/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['group_id'])?$objData['group_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="seq" class="col-md-2 col-form-label hm-right">ลำดับ<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="seq" name="seq" class="form-control" value="<?php echo isset($objData['seq'])?$objData['seq']:''; ?>" required/>
                            </div>
                            <label for="group_name" class="col-md-2 col-form-label hm-right">ชื่อกลุ่มข้อมูล <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="group_name" name="group_name" class="form-control" value="<?php echo isset($objData['group_name'])?$objData['group_name']:''; ?>" required/>
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
            var required = '';

            if($('input[id=seq]:required').val() == ''){
                $('input[id=seq]:required').addClass("is-invalid");
                $('input[id=seq]:required').after(brfore+'กรุณาระบุลำดับ'+after);
                required++; 
            }
            if($('input[id=group_name]:required').val() == ''){
                $('input[id=group_name]:required').addClass("is-invalid");
                $('input[id=group_name]:required').after(brfore+'กรุณาระบุชื่อกลุ่มข้อมูล'+after)
                required++;
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
                    url: baseUrl+ "/back-end/group_list/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('back-end/group_list') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

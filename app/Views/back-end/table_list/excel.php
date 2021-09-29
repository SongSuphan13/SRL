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
    .text-lowercase {
        text-transform: lowercase;
    }
</style>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18"> นำเข้า Excel</h4>
            </div>
        </div>
    </div>
    <div class="button-items text-right">
        <a href="<?php echo base_url('back-end/table_list/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">ไฟล์ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-4">  
    
                                <div class="custom-file">
                                    <span class="custom-add-on-file">
                                        <button class="btn btn-primary waves-effect waves-light">
                                            <i class="mdi mdi-attachment"></i> เลือกไฟล์  
                                        </button>
                                    </span>
                                    <div class="md-input-file">
                                        <input type="file" name="ann_file[]" id="ann_file" class="" single/>
                                        <input type="text" class="md-form-control md-form-file">
                                        <label class="md-label-file"></label>
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
        $("input[type='file'][multiple]").change(function (e,v){
            var input = document.getElementById(this.id);
            var img_name = [];
            for (var x = 0; x < input.files.length; x++) {
                    img_name[x] = input.files[x].name;
            }
            $(this).parent().children('.md-form-file').val(img_name.join(', '));
        });
        $("input[type='file'][single]").change(function (e,v){
            var pathArray = $(this).val().split('\\');
            var img_name=pathArray[pathArray.length - 1];
            $(this).parent().children('.md-form-file').val(img_name);
        });


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
            if($('input[id=table_name_th]:required').val() == ''){
                $('input[id=table_name_th]:required').addClass("is-invalid");
                $('input[id=table_name_th]:required').after(brfore+'กรุณาระบุชื่อ'+after);
                required++; 
            }
            if($('input[id=table_name]:required').val() == ''){
                $('input[id=table_name]:required').addClass("is-invalid");
                $('input[id=table_name]:required').after(brfore+'กรุณาระบุ Table Name'+after)
                required++;
            }
            if($('input[id=table_pk]:required').val() == ''){
                $('input[id=table_pk]:required').addClass("is-invalid");
                $('input[id=table_pk]:required').after(brfore+'กรุณาระบุ Primary Key'+after)
                required++;
            }
            if($('select[id=group_id]').val() == '' || $('select[id=group_id]').val() == null){
                $('select[id=group_id]').addClass("is-invalid");
                $('select[id=group_id] + .select2-container').after(brfore+'กรุณาระบุกลุ่ม'+after) 
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
                    url: baseUrl+ "/back-end/table_list/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('back-end/table_list') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

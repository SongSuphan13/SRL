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
                <h4 class="mb-0 font-size-18">บริหารกลุ่มข้อมูล</h4>
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
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['group_id'])?$objData['group_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="seq" class="col-md-2 col-form-label hm-right">ลำดับ<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <input type="text" id="seq" name="seq" class="form-control" value="<?php echo isset($objData['seq'])?$objData['seq']:''; ?>" required onkeypress="return isNumber(event)" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="table_name_th" class="col-md-2 col-form-label hm-right">ชื่อ<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="table_name_th" name="table_name_th" class="form-control" value="<?php echo isset($objData['table_name_th'])?$objData['table_name_th']:''; ?>" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="table_detail" class="col-md-2 col-form-label hm-right">รายละเอียด</label>
                            <div class="col-md-4">
                                <input type="text" id="table_detail" name="table_detail" class="form-control" value="<?php echo isset($objData['table_detail'])?$objData['table_detail']:''; ?>" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="table_name" class="col-md-2 col-form-label hm-right">Table Name <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="table_name" name="table_name" class="form-control text-lowercase" value="<?php echo isset($objData['table_name'])?$objData['table_name']:''; ?>" required/>
                                <small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Lowercase (_) **</small>
                             </div>
                        </div>
                        <div class="form-group row">
                            <label for="table_pk" class="col-md-2 col-form-label hm-right">Primary Key <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="table_pk" name="table_pk" class="form-control text-lowercase" value="<?php echo isset($objData['table_pk'])?$objData['table_pk']:''; ?>" required/>
                                <small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Lowercase (_) **</small>
                             </div>
                        </div> 
                        <div class="form-group row">
                            <label for="group_id" class="col-md-2 col-form-label hm-right">กลุ่ม <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-4">
                               <select name="group_id" id="group_id" class="form-control select2"> 
                                <option value="" >กรุณาเลือก</option>
                                   <?php 
                                        foreach($objGroupList as $key => $val){
                                            echo ' <option value="'.$val['group_id'].'" '.((isset($objData['group_id']) && $objData['group_id'] == $val['group_id'])?'selected':'').' >'.$val['group_name'].'</option>';
                                        }
                                   ?>
                               </select>
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
    $('#table_name').keyup(function(){ 
		if(this.value != "") {
			var chk_key = change_th2eng(this.value);
			 var data = chk_key.replace('-','_');
				 data = data.replace(' ','_');
				//  data = data.toUpperCase();
			 $('#table_name').val(data); 
		}
	});
    $('#table_pk').keyup(function(){ 
		if(this.value != "") {
			var chk_key = change_th2eng(this.value);
			 var data = chk_key.replace('-','_');
				 data = data.replace(' ','_');
				//  data = data.toUpperCase();
			 $('#table_pk').val(data); 
		}
	});
    function change_th2eng(c){
        var th='aๅ/-ภถุึคตจขชๆไำพะัีรนยบลฟหกดเ้่าสวผปแอิืทมใฝ+๑๒๓๔ู฿๕๖๗๘๙๐"ฎฑธํ๊ณฯญฐ,ฅฤฆฏโฌ็๋ษศซ.()ฉฮฺ์?ฒฬฦ';
        var en = 'a1234567890-=qwertyuiop[]asdfghjkl;zxcvbnm,./!@#$%^&*()_+QWERTYUIOP{}|ASDFGHJKL:"ZXCVBNM<>?';
        var len = c.length;
        var txt = "";
        for(var i=0;i<len;i++){
            var data = c.substring(i,(i+1));
            if(data == "?"){
                txt += "M";
            }else if(data == "("){
                txt += "Z";
            }else if(data == ")"){
                txt += "X";
            }else if(data == "+"){
                txt += "!";
            }else{
                var n = th.search(data);
                if(n>0){
                    txt += en.substring(n,(n+1));
                }else{
                    txt += data;
                }
            }
        }
        return txt;
    }
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

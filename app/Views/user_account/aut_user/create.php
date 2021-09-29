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
                        <?php echo count($gtxt_menu)>0?implode('',$gtxt_menu):''?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php        
        }
    ?>
    <div class="button-items text-right">
        <a href="<?php echo base_url('user_account/aut_user/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <style>
        select[readonly].select2 + .select2-container {
            pointer-events: none;
            touch-action: none;
        }
    </style>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['user_id'])?$objData['user_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="prefix_id" class="col-md-2 col-form-label hm-right">คำนำหน้า<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <select id="prefix_id" name="prefix_id" class="form-control select2" required >
                                    <option value="">กรุณาเลือก</option>
                                    <?php 
                                        if(isset($objPrefix) && is_array($objPrefix)){
                                            foreach($objPrefix as $key => $val){
                                               echo '<option value="'.$val['id'].'" '.((isset($objData['prefix_id']) &&  $objData['prefix_id'] == $val['id'])?'selected':'').' >'.$val['text'].'</option>';     
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <label for="fristname" class="col-md-1 col-form-label hm-right">ชื่อ<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="fristname" name="fristname" class="form-control" value="<?php echo isset($objData['fristname'])?$objData['fristname']:''; ?>" required/>
                            </div>
                            <label for="lastname" class="col-md-1 col-form-label hm-right">นามสกุล<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo isset($objData['lastname'])?$objData['lastname']:''; ?>" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label hm-right">Email</label>
                            <div class="col-md-3">
                                <input type="text" id="email" name="email" class="form-control email" value="<?php echo isset($objData['email'])?$objData['email']:''; ?>" required/>
                             </div>
                             <label for="telephone" class="col-md-1 col-form-label hm-right">เบอร์โทรศัพท์</label>
                            <div class="col-md-3">
                                <input type="text" id="telephone" name="telephone" class="form-control" onkeypress="return isNumber(event)" value="<?php echo isset($objData['telephone'])?$objData['telephone']:''; ?>" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label hm-right">Username<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="username" name="username" class="form-control" value="<?php echo isset($objData['username'])?$objData['username']:''; ?>" required/>
                            </div>
                            <?php if($isFormType == 'edit'){ ?>
                            <label for="check_password" class="col-md-1 col-form-label hm-right"></label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check_password" name="check_password" value="1">
                                        <label class="custom-control-label" for="check_password">เปลี่ยนรหัสผ่าน</label>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label hm-right">Password<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="password" id="password" name="password" class="form-control" value="" required <?php echo ($isFormType == 'add')?'':'disabled' ?> required />
                             </div>
                             <label for="confirmpassword" class="col-md-1 col-form-label hm-right">Confirm Password<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" value="" <?php echo ($isFormType == 'add')?'':'disabled' ?> required/>
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
        $(document).ready(function(){
         
        });

        $( "#check_password" ).change(function() {
            if($(this).prop("checked") == true){
                $('input[id=password]').prop("disabled",false)
                $('input[id=confirmpassword]').prop("disabled",false)
            }else{
                $('input[id=password]').prop("disabled",true)
                $('input[id=confirmpassword]').prop("disabled",true)
            }
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
            var required = 0;
          
            if($('select[id=prefix_id]:required').val() == '' || $('select[id=prefix_id]:required').val() == null){
                $('select[id=prefix_id]:required').addClass("is-invalid");
                $('select[id=prefix_id] + .select2-container').after(brfore+'กรุณาระบุคำนำหน้า'+after) 
            }
            if($('input[id=fristname]:required').val() == ''){
                $('input[id=fristname]:required').addClass("is-invalid");
                $('input[id=fristname]:required').after(brfore+'กรุณาระบุชื่อ'+after)
                required++;
            }
            if($('input[id=lastname]:required').val() == ''){
                $('input[id=lastname]:required').addClass("is-invalid");
                $('input[id=lastname]:required').after(brfore+'กรุณาระบุนามสกุล'+after)
                required++;
            }
            if($('input[id=username]:required').val() == ''){
                $('input[id=username]:required').addClass("is-invalid");
                $('input[id=username]:required').after(brfore+'กรุณาระบุ Username'+after)
                required++;
            }
            <?php if($isFormType == 'add'){ ?>
            if($('input[id=password]:required').val() == ''){
                $('input[id=password]:required').addClass("is-invalid");
                $('input[id=password]:required').after(brfore+'กรุณาระบุ Password'+after)
                required++;
            }
            if($('input[id=confirmpassword]:required').val() == ''){
                $('input[id=confirmpassword]:required').addClass("is-invalid");
                $('input[id=confirmpassword]:required').after(brfore+'กรุณาระบุ Password'+after)
                required++;
            }
            <?php }else{ ?>
                if($('input:checkbox[id=check_password]:checked').val() == 1){
                    if($('input[id=password]:required').val() == ''){
                        $('input[id=password]:required').addClass("is-invalid");
                        $('input[id=password]:required').after(brfore+'กรุณาระบุ Confirm Password'+after)
                        required++;
                    }
                    if($('input[id=confirmpassword]:required').val() == ''){
                        $('input[id=confirmpassword]:required').addClass("is-invalid");
                        $('input[id=confirmpassword]:required').after(brfore+'กรุณาระบุ Confirm Password'+after)
                        required++;
                    }
                }
           <?php  } ?> 
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
                showLoaderOnConfirm: true
            }, function (){
                $.ajaxSetup({async: true});
                $.ajax({
                    type: "POST",
                    url: baseUrl+ "/user_account/aut_user/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('user_account/aut_user/') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

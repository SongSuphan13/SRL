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
        <a href="<?php echo base_url('setting/tambon/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['tambon_id'])?$objData['tambon_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="province_code" class="col-md-2 col-form-label hm-right">จังหวัด (TH)<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <select id="province_code" name="province_code" class="form-control select2" onchange="get_amphure('province_code','amphure_code','tambon_code','zipcode','')" required>
                                    <option value="">กรุณาเลือก</option>
                                    <?php 
                                        if(isset($objProvince) && is_array($objProvince)){
                                            foreach($objProvince as $key => $val){
                                               echo '<option value="'.$val['id'].'" '.((isset($objData['province_code']) &&  $objData['province_code'] == $val['id'])?'selected':'').' >'.$val['text'].'</option>';     
                                            }
                                        }
                                    ?>
                                </select>
                             </div>
                             <label for="amphure_code" class="col-md-2 col-form-label hm-right">อำเภอ (TH)<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <select id="amphure_code" name="amphure_code" class="form-control select2" required>
                                    <option value="">กรุณาเลือก</option>
                                    <?php 
                                        if(isset($objAmphure) && is_array($objAmphure)){
                                            foreach($objAmphure as $key => $val){
                                               echo '<option value="'.$val['id'].'" '.((isset($objData['amphure_code']) &&  $objData['amphure_code'] == $val['id'])?'selected':'').' >'.$val['text'].'</option>';     
                                            }
                                        }
                                    ?>
                                </select>
                             </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambon_name_th" class="col-md-2 col-form-label hm-right">ตำบล (TH)<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="tambon_name_th" name="tambon_name_th" class="form-control" value="<?php echo isset($objData['tambon_name_th'])?$objData['tambon_name_th']:''; ?>" required/>
                             </div>
                            <label for="tambon_name_en" class="col-md-2 col-form-label hm-right">ตำบล (EN)</label>
                            <div class="col-md-3">
                                <input type="text" id="tambon_name_en" name="tambon_name_en" class="form-control" value="<?php echo isset($objData['tambon_name_en'])?$objData['tambon_name_en']:''; ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zipcode" class="col-md-2 col-form-label hm-right">รหัสไปรษณีย์<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo isset($objData['zipcode'])?$objData['zipcode']:''; ?>" required/>
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
           
            if($('select[id=province_code]:required').val() == '' || $('select[id=province_code]:required').val() == null){
                $('select[id=province_code]:required').addClass("is-invalid");
                $('select[id=province_code] + .select2-container').after(brfore+'กรุณาระบุจังหวัด (TH)'+after) 
            }
            if($('select[id=amphure_code]:required').val() == '' || $('select[id=amphure_code]:required').val() == null){
                $('select[id=amphure_code]:required').addClass("is-invalid");
                $('select[id=amphure_code] + .select2-container').after(brfore+'กรุณาระบุอำเภอ (TH)'+after) 
            }
            if($('input[id=tambon_name_th]:required').val() == ''){
                $('input[id=tambon_name_th]:required').addClass("is-invalid");
                $('input[id=tambon_name_th]:required').after(brfore+'กรุณาระบุตำบล (TH)'+after)
                required++;
            }
            if($('input[id=zipcode]:required').val() == ''){
                $('input[id=zipcode]:required').addClass("is-invalid");
                $('input[id=zipcode]:required').after(brfore+'กรุณาระบุรหัสไปรษณีย์'+after)
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
                    url: baseUrl+ "/setting/tambon/save",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData($("#form_save")[0]),
                    success: function (response) {
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('setting/tambon/') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }
    </script>
<?=$this->endSection()?> 

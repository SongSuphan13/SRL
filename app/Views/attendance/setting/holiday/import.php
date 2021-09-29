<?=$this->extend('master');?>

<?=$this->section('template_user')?>
<style>
.custom-file-label::after {
    content: "เลือกไฟล์" !important;
    color: #fff;
    background-color: #00c69e;
    border-color: #00c69e;
}
</style>
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
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="card mb-1 p-1 shadow-none border">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-sm">
                                                <span class="avatar-title  font-size-24  rounded">
                                                    <i class="bx bxs-file-doc"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col pl-0">
                                            <a href="#!" target="_blank" class="text-muted font-weight-bold"> <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Skote Landing.Zip</a></h5>
                                            <small>Size : 3.25 MB</small></a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="text-center">
                                                <a href="javascript: void(0);" class="text-dark"><i class="far fa-trash-alt m-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-1 shadow-none border">
                                    <div class="p-1">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title  font-size-24 rounded">
                                                        <i class="bx bxs-file-doc"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col pl-0">
                                                <a href="#!" target="_blank" class="text-muted font-weight-bold"> <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Skote Landing.Zip</a></h5>
                                                <small>Size : 3.25 MB</small></a>
                                            </div>
                                            <div class="col-auto">
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="text-dark"><i class="far fa-trash-alt  m-3"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-1 shadow-none border">
                                    <div class="p-1">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-sm">
                                                    <i class="avatar-sm avatar-title font-size-24 rounded bx bxs-file-doc"></i>
                                                </div>
                                            </div>
                                            <div class="col pl-0">
                                                <a href="#!" target="_blank" class="text-muted font-weight-bold">
                                                 <h5 class="font-size-12 mb-1">
                                                    <a href="#" class="text-dark">Skote Landing.Zip</a>
                                                </h5>
                                                <small>Size : 3.25 MB</small></a>
                                            </div>
                                            <div class="col-auto">
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="text-dark"><i class="far fa-trash-alt m-3"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2"></div>
                            <label for="active_status" class="col-md-2 col-form-label hm-right">ไฟล์ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-4">
                                <div class="md-group-add-on">
                                    <div class="custom-file"> 
                                        <input type="file" class="custom-file-input" id="customFile" multiple="">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">- ไฟล์ Template ที่นำเข้า จะเป็นนามสกุล .xls,.xlsx</small>
                                <small class="form-text text-muted">- แถวแรกของไฟล์ Excel จะเป็นชื่อ Column ของข้อมูล</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="search" class="btn btn-info"><i class="fas fa-check"></i> ตรวจสอบ</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <!-- <div class="row">
        <div class="col-lg-12">
            <div class="text-sm-right">
                <a href="#!" onclick="get_save()" class="btn btn-success">
                    <i class="fas fa-check"></i> บันทึก
                </a>
            </div>
        </div>
    </div>-->

</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
    <script>
        $('input[id=holiday_file]').change(function(){  
            var ext = $('#holiday_file').val().split('.').pop().toLowerCase();
            if($.inArray(ext, ['xls','xlsx']) == -1) {
                alert('The file type is invalid!');
                $('#holiday_file').val("");
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

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
        <a href="<?php echo base_url('product/chemical_group/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_view" id="form_view" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['chemi_id'])?$objData['chemi_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="chemi_seq" class="col-md-2 col-form-label hm-right">ลำดับ <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['chemi_seq'])?$objData['chemi_seq']:''; ?>
                            </div>
                            <label for="chemi_code" class="col-md-2 col-form-label hm-right">รหัสกลุ่มสารเคมี <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['chemi_code'])?$objData['chemi_code']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chemi_name_th" class="col-md-2 col-form-label hm-right">กลุ่มสารเคมี (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['chemi_name_th'])?$objData['chemi_name_th']:''; ?>
                             </div>
                            <label for="chemi_name_en" class="col-md-2 col-form-label hm-right">กลุ่มสารเคมี (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['chemi_name_en'])?$objData['chemi_name_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chemi_nameshort_th" class="col-md-2 col-form-label hm-right">กลุ่มสารเคมีย่อ (TH)</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['chemi_nameshort_th'])?$objData['chemi_nameshort_th']:''; ?>
                             </div>
                            <label for="chemi_nameshort_en" class="col-md-2 col-form-label hm-right">กลุ่มสารเคมีย่อ (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['chemi_nameshort_en'])?$objData['chemi_nameshort_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">สถานะ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['active_status'])&& $objData['active_status'] == 1)?'ใช้งาน':''; ?> 
                                <?php echo (isset($objData['active_status'])&& $objData['active_status'] == 0)?'ไม่ใช้งาน':''; ?> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
   
<?=$this->endSection()?> 

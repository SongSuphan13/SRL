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
        <a href="<?php echo base_url('attendance/setting/holiday/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['holiday_id'])?$objData['holiday_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="holiday_date" class="col-md-2 col-form-label hm-right">วันที่หยุด <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-2">
                                <?php echo isset($objData['holiday_date'])?db2d($objData['holiday_date']):''; ?>
                            </div>
                            <div class="col-md-1"></div>
                            <label for="holiday_type" class="col-md-2 col-form-label hm-right">ประเภทวันหยุด <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['holiday_type'])&& $objData['holiday_type'] == 'Announce')?'วันหยุดตามประกาศ':''; ?> 
                                <?php echo (isset($objData['holiday_type'])&& $objData['holiday_type'] == 'More')?'วันหยุดเพิ่มเติม':''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="holiday_name_th" class="col-md-2 col-form-label hm-right">วันหยุด (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['holiday_name_th'])?$objData['holiday_name_th']:''; ?>
                             </div>
                            <label for="holiday_name_en" class="col-md-2 col-form-label hm-right">วันหยุด (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['holiday_name_en'])?$objData['holiday_name_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="remark" class="col-md-2 col-form-label hm-right">หมายเหตุ</label>
                            <div class="col-md-4">
                                <?php echo isset($objData['remark'])?$objData['remark']:''; ?>
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

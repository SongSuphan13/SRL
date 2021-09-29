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
        <a href="<?php echo base_url('warehouse/warehouse') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['wh_id'])?$objData['wh_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="wh_name_th" class="col-md-2 col-form-label hm-right">คลังสินค้า (TH) <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['wh_name_th'])?$objData['wh_name_th']:''; ?>
                             </div>
                            <label for="wh_name_en" class="col-md-2 col-form-label hm-right">คลังสินค้า (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['wh_name_en'])?$objData['wh_name_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label hm-right">ที่อยู่</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['address'])?$objData['address']:''; ?>
                            </div>
                            <label for="province_id" class="col-md-2 col-form-label hm-right">จังหวัด</label>
                            <div class="col-md-3">
                                <?php echo getShowProvince($objData['province_id']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amphure_id" class="col-md-2 col-form-label hm-right">อำเภอ</label>
                            <div class="col-md-3">
                                <?php echo getShowAmphure($objData['amphure_id']); ?>
                            </div>
                            <label for="tambon_id" class="col-md-2 col-form-label hm-right">ตำบล</label>
                            <div class="col-md-3">
                                <?php echo getShowTambon($objData['tambon_id']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zipcode" class="col-md-2 col-form-label hm-right">ไปรษณีย์</label>
                            <div class="col-md-3">
                                <?php echo isset($objData['zipcode'])?$objData['zipcode']:''; ?>
                             </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">สถานะ <span style="color: #f1556c">*</span></label>
                            <div class="col-md-3">
                                <?php echo (isset($objData['active_status']) && $objData['active_status'] == 1)?'ใช้งาน':''; ?> 
                                <?php echo (isset($objData['active_status']) && $objData['active_status'] == 0)?'ไม่ใช้งาน':''; ?> 
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

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
        <a href="<?php echo base_url('setting/prefix') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_view" id="form_view" method="post" action="#">
                        <div class="form-group row">
                            <label for="seq" class="col-md-2 col-form-label hm-right">ลำดับ</label>
                            <div class="col-md-3">
                                <?php echo isset($dataObj['seq'])?$dataObj['seq']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prefix_name_th" class="col-md-2 col-form-label hm-right">คำนำหน้า (TH)</label>
                            <div class="col-md-3">
                                <?php echo isset($dataObj['prefix_name_th'])?$dataObj['prefix_name_th']:''; ?>
                            </div>
                            <label for="prefix_name_en" class="col-md-2 col-form-label hm-right">คำนำหน้า (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($dataObj['prefix_name_en'])?$dataObj['prefix_name_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prefix_nameshort_th" class="col-md-2 col-form-label hm-right">คำนำหน้าย่อ (TH)</label>
                            <div class="col-md-3">
                                <?php echo isset($dataObj['prefix_nameshort_th'])?$dataObj['prefix_nameshort_th']:''; ?>
                            </div>
                            <label for="prefix_nameshort_en" class="col-md-2 col-form-label hm-right">คำนำหน้าย่อ (EN)</label>
                            <div class="col-md-3">
                                <?php echo isset($dataObj['prefix_nameshort_en'])?$dataObj['prefix_nameshort_en']:''; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-2 col-form-label hm-right">สถานะ</label>
                            <div class="col-md-3">
                                <?php echo (isset($dataObj['active_status'])&& $dataObj['active_status'] == 1)?'ใช้งาน':''; ?> 
                                <?php echo (isset($dataObj['active_status'])&& $dataObj['active_status'] == 0)?'ไม่ใช้งาน':''; ?> 
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

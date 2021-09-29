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
        <a href="#!" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_search" id="form_search" method="get" action="#">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">Username</label>
                            <div class="col-md-3">
                                บุคคลธรรมดา (Individual)
                            </div>
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">ชื่อ - นามสกุล</label>
                            <div class="col-md-3">
                                นายสถาพร  ผิวทองงาม
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">เบอร์โทรศัพท์</label>
                            <div class="col-md-3">
                                090-432-2873
                            </div>
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">อีเมล์</label>
                            <div class="col-md-3">
                                Song.piw23@gmail.com
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
                <a href="#!" onclick="get_back()" class="btn btn-danger ">
                    <i class="fas fa-arrow-left"></i> ย้อนกลับ 
                </a>&nbsp;&nbsp;
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
            }, function () {
                // var url_process = "../save/absent_save.php";
                // var fdata = new FormData($("#form_save")[0]);
                // $.ajaxSetup({ async: true });
                // $.ajax({
                //     type: "POST",
                //     url: url_process,
                //     processData: false,
                //     contentType: false,
                //     data: fdata,
                //     success: function (res) {
                       
                //     }
                // });
            }
        );
     }
     function get_back(){
                swal({
                title: "",
                text: "คุณต้องการย้อนกลับใช่หรือไม่",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                // var url_process = "../save/absent_save.php";
                // var fdata = new FormData($("#form_save")[0]);
                // $.ajaxSetup({ async: true });
                // $.ajax({
                //     type: "POST",
                //     url: url_process,
                //     processData: false,
                //     contentType: false,
                //     data: fdata,
                //     success: function (res) {
                       
                //     }
                // });
            }
        );
     }
    </script>
<?=$this->endSection()?> 

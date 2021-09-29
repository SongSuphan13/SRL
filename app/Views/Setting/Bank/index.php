<?=$this->extend('master');?>

<?=$this->section('template_user')?>

<?=$this->endSection()?> 


<?=$this->section('content')?>
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
        <a href="<?php echo base_url('setting/bank/create') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>
        <a href="#!" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_search" id="form_search" method="post" action="#">
                        <h4><i class="bx bx-search-alt"></i> ค้นหา</h4>
                        <div class="form-group row">
                            <label for="s_bank_name_th" class="col-md-2 col-form-label hm-right">ธนาคาร (TH)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_bank_name_th" id="s_bank_name_th" class="form-control" value="<?= isset($s_post['s_bank_name_th']) ? $s_post['s_bank_name_th'] : null; ?>"/>
                            </div>
                            <label for="s_bank_name_en" class="col-md-2 col-form-label hm-right">ธนาคาร (EN)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_bank_name_en"  id="s_bank_name_en" class="form-control" value="<?= isset($_PSOT['s_bank_name_en']) ? $_PSOT['s_bank_name_en'] : null; ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="s_bank_nameshort_th" class="col-md-2 col-form-label hm-right">ธนาคารย่อ (TH)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_bank_nameshort_th"  id="s_bank_nameshort_th" class="form-control" value="<?= isset($_PSOT['s_bank_nameshort_th']) ? $_PSOT['s_bank_nameshort_th'] : null; ?>"/>
                            </div>
                            <label for="s_bank_nameshort_en" class="col-md-2 col-form-label hm-right">ธนาคารย่อ (EN)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_bank_nameshort_en"  id="s_bank_nameshort_en" class="form-control" value="<?= isset($_PSOT['s_bank_nameshort_en']) ? $_PSOT['s_bank_nameshort_en'] : null; ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="s_active_staus" class="col-md-2 col-form-label hm-right">สถานะ</label>
                            <div class="col-md-3">
                                <select name="s_active_staus" id="s_active_staus" class="form-control select2" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">ทั้งหมด</option>
                                    <option data-select2-id="3">Select</option>
                                    <option data-select2-id="3">Select</option>
                                    <option data-select2-id="3">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="search" class="btn btn-info"><i class="fas fa-search"></i> ค้นหา</button>
                                <button type="button" onclick="window.location.href='<?php echo base_url('setting/bank') ?>';" class="btn btn-warning"><i class="fas fa-undo"></i> ล้างการค้นหา</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-right">
                        <div class="btn-group" role="group" >
                            <button type="button" class="btn btn-sm btn-info"><i class="far fa-file-word"></i> Export Word</button>
                            <button type="button" class="btn btn-sm btn-primary"><i class="far fa-file-excel"></i> Export Excel</button>
                            <button type="button" class="btn btn-sm btn-danger"><i class="far fa-file-pdf"></i> Export Pdf</button> 
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-center" style="width: 5%;">ลำดับ</th>
                                    <th class="text-center" style="width: 20%;">ธนาคาร (TH)</th>
                                    <th class="text-center" style="width: 20%;">ธนาคาร (EN)</th>
                                    <th class="text-center" style="width: 15%;">ธนาคารย่อ (TH)</th>
                                    <th class="text-center" style="width: 15%;">ธนาคารย่อ (EN)</th>
                                    <th class="text-center" style="width: 10%;">สถานะ</th>
                                    <th class="text-center" style="width: 10%;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($data) && count($data) > 0){
                                    $i = 0;
                                    foreach($data as $key => $val){
                                        $i++; 
                            ?>
                                <tr>
                                    <td class="text-center" style="width: 5%;"><?php echo $i; ?></td>
                                    <td class="text-left" ><?php echo $val['bank_name_th']?></td>
                                    <td class="text-left" ><?php echo $val['bank_name_en']?></td>
                                    <td class="text-left" ><?php echo $val['bank_nameshort_th']?></td>
                                    <td class="text-left" ><?php echo $val['bank_nameshort_en'] ?></td>
                                    <td class="text-center" ><?php echo getStatus((string)$val['active_status']);?></td>
                                    <td class="text-center" style="width: 10%;">
                                        &nbsp;<a href="<?php echo base_url('/setting/bank/update/'.$val['bank_id']); ?>" class="btn btn-success btn-sm waves-effect waves-light"><i class="fas fa-pencil-alt"></i></a>
                                        &nbsp;<a href="<?php echo base_url('/setting/bank/view/'.$val['bank_id']); ?>" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-search"></i></a>
                                        &nbsp;<a href="#!" onclick="getDelete('<?php echo $val['bank_id']; ?>');" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }else{
                                echo '<tr>
                                        <td class="text-center" colspan="7">ไม่พบข้อมูล</td>
                                    </tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
                    <?php 
                        echo (isset($num_rows) && $num_rows > 0)?$pagination:'';
                    ?>               
                </div>
            </div>
        </div>
    </div>

</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
<script>
    function getDelete(id){
        if(id != ''){
            swal({
                    title: '',
                    text: "คุณต้องการลบรายการนี้หรือไม่",
                    type: 'warning',
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ยืนยันการลบ",
                    cancelButtonText: "ยกเลิก",
                    showCancelButton: true,
                    closeOnConfirm: false,
                }, function () {
                    var dataString = '';
                    $.ajax({
                        type: "POST",
                        url: baseUrl+ "/setting/bank/delete/"+id,
                        data: dataString,
                        cache: false,
                        dataType: 'json',
                        success: function(response){
                            if(response.statusCode == 150){
                                refresh('<?php echo base_url('setting/bank') ?>');
                            }else{
                                showError(response.msg);
                            } 
                        }
                    });
                }
            );
        }
    }
    function refresh(url){
        if(url){
            window.location.href = url;
        }else{
            window.location.href = '#!';
        }
        
    }
</script>
<?=$this->endSection()?> 

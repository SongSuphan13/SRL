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
    get_breadcrumb($menuCode,'',$gtxt_menu);
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
        <a href="<?php echo base_url('setting/province/create') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>
        <a href="<?php echo $link_back; ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_search" id="form_search" method="post" action="<?php echo base_url('setting/province/') ?>">
                        <h4><i class="bx bx-search-alt"></i> ค้นหา</h4>
                        <div class="form-group row">
                            <label for="province_code" class="col-md-2 col-form-label hm-right">รหัสจังหวัด</label>
                            <div class="col-md-3">
                                <input type="text" name="province_code" id="province_code" class="form-control" value="<?= isset($isPost['province_code']) ? trim($isPost['province_code']) : null; ?>"/>
                            </div>
                            <label for="province_name_th" class="col-md-2 col-form-label hm-right">จังหวัด (TH)</label>
                            <div class="col-md-3">
                                <input type="text" name="province_name_th" id="province_name_th" class="form-control" value="<?= isset($isPost['province_name_th']) ? trim($isPost['province_name_th']) : null; ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="province_name_en" class="col-md-2 col-form-label hm-right">จังหวัด (EN)</label>
                            <div class="col-md-3">
                                <input type="text" name="province_name_en" id="province_name_en" class="form-control" value="<?= isset($isPost['province_name_en']) ? trim($isPost['province_name_en']) : null; ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="search" class="btn btn-info"><i class="fas fa-search"></i> ค้นหา</button>
                                <button type="button" onclick="window.location.href='<?php echo base_url('setting/province') ?>';" class="btn btn-warning"><i class="fas fa-undo"></i> ล้างการค้นหา</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-right">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-hover table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-center" style="width: 5%;">ลำดับ</th>
                                    <th class="text-center" style="width: 15%;">รหัสจังหวัด</th> 
                                    <th class="text-center" style="width: 30%;">จังหวัด (TH)</th>
                                    <th class="text-center" style="width: 30%;">จังหวัด (EN)</th>
                                    <th class="text-center" style="width: 10%;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($objData) && is_array($objData)){
                                    $i = 0;
                                    foreach($objData as $key => $val){
                                        $i++; 
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $val['province_code'];?></td>
                                    <td class="text-left"><?php echo $val['province_name_th'];?></td>
                                    <td class="text-left"><?php echo $val['province_name_en'];?></td>
                                    <td class="text-center">
                                        <nobr>
                                            &nbsp;<a href="<?php echo base_url('/setting/province/edit/'.$val['province_id']); ?>" class="btn btn-success btn-sm waves-effect waves-light"><i class="fas fa-pencil-alt"></i></a>
                                            &nbsp;<a href="<?php echo base_url('/setting/province/view/'.$val['province_id']); ?>" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-search"></i></a>
                                            &nbsp;<a href="#!" onclick="getDelete('<?php echo $val['province_id']; ?>');" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i></a>
                                        </nobr>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }else{
                                echo '<tr>
                                        <td class="text-center" colspan="6">ไม่พบข้อมูล</td>
                                    </tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
                    <?php 
                        echo (isset($numRows) && $numRows > 0)?$pagination:'';
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
                        url: baseUrl+ "/setting/province/delete/"+id,
                        data: dataString,
                        cache: false,
                        dataType: 'json',
                        success: function(response){
                            if(response.statusCode == 150){
                                window.location.href = '<?php echo base_url('setting/province') ?>';
                            }else{
                                showError(response.msg);
                            } 
                        }
                    });
                }
            );
        }
    }
</script>
<?=$this->endSection()?> 

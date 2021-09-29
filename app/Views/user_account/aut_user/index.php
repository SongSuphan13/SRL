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
        <a href="<?php echo base_url('user_account/aut_user/create') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>
        <a href="<?php echo $link_back; ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_search" id="form_search" method="get" action="#">
                        <h4><i class="bx bx-search-alt"></i> ค้นหา</h4>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">Username</label>
                            <div class="col-md-3">
                                <input class="form-control" type="text" value="" id="example-text-input" />
                            </div>
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">ชื่อ - นามสกุล</label>
                            <div class="col-md-3">
                                <input class="form-control" type="text" value="" id="example-text-input" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">เบอร์โทรศัพท์</label>
                            <div class="col-md-3">
                                <input class="form-control" type="text" value="" id="example-text-input" />
                            </div>
                            <label for="example-text-input" class="col-md-2 col-form-label hm-right">อีเมล์</label>
                            <div class="col-md-3">
                                <input class="form-control" type="text" value="" id="example-text-input" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="search" class="btn btn-info"><i class="fas fa-search"></i> ค้นหา</button>
                                <button type="button" onclick="window.location.href='<?php echo base_url('user_account/aut_user') ?>';" class="btn btn-warning"><i class="fas fa-undo"></i> ล้างการค้นหา</button>
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
                                    <th class="text-center" style="width: 20%;">Username</th>
                                    <th class="text-center" style="width: 20%;">ชื่อ - นามสกุล</th>
                                    <th class="text-center" style="width: 15%;">เบอร์โทรศัพท์</th>
                                    <th class="text-center" style="width: 15%;">อีเมล์</th>
                                    <th class="text-center" style="width: 15%;">สถานะ</th>
                                    <th class="text-center" style="width: 10%;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(is_array($objData) && count($objData) > 0 ){
                                        $i = 0;
                                        foreach($objData as $key => $val){
                                            $i++;
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-left" ><?php echo $val['username'] ?></td>
                                        <td class="text-left" ><?php echo $val['prefix_name_th'].$val['fristname'].'  '.$val['lastname'] ?></td> 
                                        <td class="text-left" ><?php echo $val['telephone'] ?></td>
                                        <td class="text-left" ><?php echo $val['email'] ?></td>
                                        <td class="text-center" ><?php echo getStatus((string)$val['active_status']);?></td>
                                        <td class="text-center">
                                            <nobr>
                                                &nbsp;<a href="<?php echo base_url('/user_account/aut_user/menu/'.$val['user_id']); ?>" class="btn btn-warning btn-sm waves-effect waves-light"><i class="fas fa-cogs"></i></a>
                                                &nbsp;<a href="<?php echo base_url('/user_account/aut_user/edit/'.$val['user_id']); ?>" class="btn btn-success btn-sm waves-effect waves-light"><i class="fas fa-pencil-alt"></i></a>
                                                <!-- &nbsp;<a href="<?php echo base_url('/user_account/aut_user/view/'.$val['user_id']); ?>" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-search"></i></a> -->
                                                &nbsp;<a href="#!" onclick="getDelete('<?php echo $val['user_id']; ?>');" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i></a>
                                            </nobr>
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
                        url: baseUrl+ "/user_account/aut_user/delete/"+id,
                        data: dataString,
                        cache: false,
                        dataType: 'json',
                        success: function(response){
                            if(response.statusCode == 150){
                                window.location.href = '<?php echo base_url('user_account/aut_user') ?>';
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

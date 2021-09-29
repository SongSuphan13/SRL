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
            </div>
        </div>
    </div>
    <?php 
		$session = session();
		$arr_menu = $session->get('user_menu');
		$user_displaymenu = $session->get('user_displaymenu');
		if($user_displaymenu == "A"){ 
			foreach($arr_menu as $key=>$val){
				foreach($val as $key2=>$val2){
					if($val2['menu_code'] == $menu_code){
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
		$gtxt_menu = "";
		function m_get_parent($G,$arr_menu){
			global $gtxt_menu;
			foreach($arr_menu  as $k=>$val){
				foreach($val as $kk=>$M){
					if ($M['menu_code'] == $G){ 
						$txt = " <li class=\"breadcrumb-item\"><a href=\"".base_url($M['menu_url'])."\">".$M['menu_name_th']."</a></li> ";
						$gtxt_menu = $txt.$gtxt_menu;
						if($k > 0){
							m_get_parent($k,$arr_menu );
						}
					}
				}
			}
			
		}

        if($isBreadcrumb){
    ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('menu/') ?>">หน้าแรก</a></li>
						<?php 
							 m_get_parent(3,$arr_menu); 
							 echo $gtxt_menu;
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
        <a href="<?php echo base_url('setting/prefix/create') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>
        <a href="<?php echo $link_back; ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_search" id="form_search" method="post" action="#">
                        <h4><i class="bx bx-search-alt"></i> ค้นหา</h4>
                        <div class="form-group row">
                            <label for="s_prefix_name_th" class="col-md-2 col-form-label hm-right">คำนำหน้า (TH)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_prefix_name_th" id="s_prefix_name_th" class="form-control" value="<?= isset($s_post['s_prefix_name_th']) ? $s_post['s_prefix_name_th'] : null; ?>"/>
                            </div>
                            <label for="s_prefix_name_en" class="col-md-2 col-form-label hm-right">คำนำหน้า (EN)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_prefix_name_en"  id="s_prefix_name_en" class="form-control" value="<?= isset($s_post['s_prefix_name_en']) ? $s_post['s_prefix_name_en'] : null; ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="s_prefix_nameshort_th" class="col-md-2 col-form-label hm-right">คำนำหน้าย่อ (TH)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_prefix_nameshort_th"  id="s_prefix_nameshort_th" class="form-control" value="<?= isset($s_post['s_prefix_nameshort_th']) ? $s_post['s_prefix_nameshort_th'] : null; ?>"/>
                            </div>
                            <label for="s_prefix_nameshort_en" class="col-md-2 col-form-label hm-right">คำนำหน้าย่อ (EN)</label>
                            <div class="col-md-3">
                                <input type="text" name="s_prefix_nameshort_en"  id="s_prefix_nameshort_en" class="form-control" value="<?= isset($s_post['s_prefix_nameshort_en']) ? $s_post['s_prefix_nameshort_en'] : null; ?>"/>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="s_active_status" class="col-md-2 col-form-label hm-right">สถานะ</label>
                            <div class="col-md-3">
                                <select name="s_active_status" id="s_active_status" class="form-control select2" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">ทั้งหมด</option>
                                    <option value="1" <?= isset($s_post['s_active_status']) && $s_post['s_active_status']  == '1' ? 'selected' : null; ?>>ใช้งาน</option>
                                    <option value="0" <?= isset($s_post['s_active_status']) && $s_post['s_active_status']  == '0' ? 'selected' : null; ?>>ไม่ใช้งาน</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="search" class="btn btn-info"><i class="fas fa-search"></i> ค้นหา</button>
                                <button type="button" onclick="window.location.href='<?php echo base_url('setting/prefix') ?>';" class="btn btn-warning"><i class="fas fa-undo"></i> ล้างการค้นหา</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-right">
                        <!--<a href="#!" class="btn btn-sm btn-info"><i class="far fa-file-word"></i> Export Word</a>
                        <a href="#!" class="btn btn-sm btn-primary"><i class="far fa-file-excel"></i> Export Excel</a>
                        <a href="#!" class="btn btn-sm btn-danger"><i class="far fa-file-pdf"></i> Export Pdf</a>-->
                        <div class="btn-group" role="group" >
                            <button type="button" class="btn btn-sm btn-info"><i class="far fa-file-word"></i> Export Word</button>
                            <button type="button" class="btn btn-sm btn-primary"><i class="far fa-file-excel"></i> Export Excel</button>
                            <button type="button" class="btn btn-sm btn-danger"><i class="far fa-file-pdf"></i> Export Pdf</button> 
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-hover table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-center" style="width: 5%;">ลำดับ</th>
                                    <th class="text-center" style="width: 20%;">คำนำหน้า (TH)</th>
                                    <th class="text-center" style="width: 20%;">คำนำหน้า (EN)</th>
                                    <th class="text-center" style="width: 15%;">คำนำหน้าย่อ (TH)</th>
                                    <th class="text-center" style="width: 15%;">คำนำหน้าย่อ (EN)</th>
                                    <th class="text-center" style="width: 10%;">สถานะ</th>
                                    <th class="text-center" style="width: 10%;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($data) && is_array($data)){
                                    $i = 0;
                                    foreach($data as $key => $val){
                                        $i++; 
                            ?>
                                <tr>
                                    <td class="text-center" style="width: 5%;"><?php echo $i; ?></td>
                                    <td class="text-left" ><?php echo $val['prefix_name_th']?></td>
                                    <td class="text-left" ><?php echo $val['prefix_name_en']?></td>
                                    <td class="text-left" ><?php echo $val['prefix_nameshort_th']?></td>
                                    <td class="text-left" ><?php echo $val['prefix_nameshort_en'] ?></td>
                                    <td class="text-center" ><?php echo getStatus((string)$val['active_status']);?></td>
                                    <td class="text-center" style="width: 10%;">
                                        &nbsp;<a href="<?php echo base_url('/setting/prefix/update/'.$val['prefix_id']); ?>" class="btn btn-success btn-sm waves-effect waves-light"><i class="fas fa-pencil-alt"></i></a>
                                        &nbsp;<a href="<?php echo base_url('/setting/prefix/view/'.$val['prefix_id']); ?>" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-search"></i></a>
                                        &nbsp;<a href="#!" onclick="getDelete('<?php echo $val['prefix_id']; ?>');" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i></a>
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
                        url: baseUrl+ "/setting/prefix/delete/"+id,
                        data: dataString,
                        cache: false,
                        dataType: 'json',
                        success: function(response){
                            if(response.statusCode == 150){
                                refresh('<?php echo base_url('setting/prefix') ?>');
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

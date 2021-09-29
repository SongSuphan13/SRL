<?=$this->extend('master');?>

<?=$this->section('template_user')?>

<?=$this->endSection()?> 
 
<?=$this->section('content')?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">บริหารกลุ่มข้อมูล</h4>
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
		// $gtxt_menu = "";
		// function m_get_parent($G,$arr_menu){
		// 	global $gtxt_menu;
		// 	foreach($arr_menu  as $k=>$val){
		// 		foreach($val as $kk=>$M){
		// 			if ($M['menu_code'] == $G){ 
		// 				$txt = " <li class=\"breadcrumb-item\"><a href=\"".base_url($M['menu_url'])."\">".$M['menu_name_th']."</a></li> ";
		// 				$gtxt_menu = $txt.$gtxt_menu;
		// 				if($k > 0){
		// 					m_get_parent($k,$arr_menu );
		// 				}
		// 			}
		// 		}
		// 	}
			
		// }
    ?>
    <div class="button-items text-right">
        <a href="<?php echo base_url('back-end/table_list/create') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>
        <a href="<?php echo base_url('back-end/table_list/excel') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> นำเข้า Excel</a>
        <a href="<?php echo base_url('back-end/table_list/import') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> Import Table</a>
        <a href="<?php echo $link_back; ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body"> 
                    <div class="text-right">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-hover table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-center" style="width: 10%;">ลำดับการจัดเรียง</th>
                                    <th class="text-center" style="width: 80%;">ชื่อ Table </th>
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
                                    <td class="text-left" colspan="3"><h5><?php echo $val['group_name']?><h5></td>
                                </tr>
                            <?php
                                        if(isset($objData2) && is_array($objData2)){ 
                                            foreach($objData2 as $key2 => $val2){
                                                if($val2['group_id'] ==  $val['group_id']){
                                                    echo '<tr>
                                                                <td class="text-center" style="width: 5%;"></td>
                                                                <td class="text-left" >'.$val2['table_name_th'].' <br>(Table Name:  '.$val2['table_name'].')</td>
                                                                <td class="text-center" style="width: 10%;">
																	<nobr>
																		&nbsp;<a href="'.base_url('back-end/table_list/edit/'.$val2['table_id']).'" class="btn btn-success btn-sm waves-effect waves-light"><i class="fas fa-pencil-alt"></i></a>
																		&nbsp;<a href="'.base_url('back-end/table_list/field/'.$val2['table_id']).'" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-plus-square"></i></a>
																		&nbsp;<a href="http://localhost/srl/setting/bank/view/4" class="btn btn-warning btn-sm waves-effect waves-light"><i class="fas fa-copy"></i></a>
																		&nbsp;<a href="#!" onclick="getDelete(\''.$val2['table_id'].'\');" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i></a>
																   </nobr>
															   </td>
                                                            </tr>';
                                                }
                                            }
                                        }
                                    }
                                }else{
                                echo '<tr>
                                        <td class="text-center" colspan="4">ไม่พบข้อมูล</td>
                                    </tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
                    <?php 
                       // echo (isset($num_rows) && $num_rows > 0)?$pagination:'';
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
                        url: baseUrl+ "/back-end/table_list/delete/"+id,
                        data: dataString,
                        cache: false,
                        dataType: 'json',
                        success: function(response){
                            if(response.statusCode == 150){
                                refresh('<?php echo base_url('back-end/table_list') ?>');
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

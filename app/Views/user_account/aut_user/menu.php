<?=$this->extend('master');?>

<?=$this->section('template_user')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/tree-view/css/treeview.css')?>">
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
<?php 
     function get_setting_menu($m_id,$group_id){
        $db = db_connect();
        if($m_id == "" OR $m_id == "0"){
            $parent = " and (parent_id is null or parent_id = '' or parent_id = '0') ";
        }else{
            $parent = " and parent_id = '".$m_id."' ";
        }
        $sql_menu_group = $db->query("select * from aut_menu WHERE active_status = '1' ".$parent." order by menu_seq asc")->getResultArray();
        if(count($sql_menu_group)> 0){
            echo "<ul>";
            foreach($sql_menu_group as $k => $v){
                if($v['menu_type']=="file"){ 
                    $flag="file"; 
                }else{ 
                    $flag = "folder"; 
                }
                 echo "<li id=\"".$v["menu_id"]."\" data-jstree='{\"opened\":false,\"type\":\"".$flag."\" }' >".$v["menu_name_th"];
                    get_setting_menu($v["menu_id"],$group_id);
                 echo "</li>";
            }
            echo "</ul>";
        }else{

            $r_menu = $db->query("select menu_permis from aut_menu where active_status = '1' and menu_id = ".$m_id." order by menu_seq asc")->getRowArray();
            $r_group = $db->query("select * from aut_group_menu where 1=1 and menu_id = ".$m_id." and group_id = '".$group_id."' and user_type = 'U' ")->getRowArray();
      
            $arr_chk = explode('|',$r_menu['menu_permis']);
        
            $add = (isset($r_group['user_add']) && $r_group['user_add']== 1) ? 'true' : 'false';
            $edit = (isset($r_group['user_edit']) &&  $r_group['user_edit'] == 1) ? 'true' : 'false';
            $view = (isset($r_group['user_view']) &&  $r_group['user_view'] == 1) ? 'true' : 'false';
            $delete = (isset($r_group['user_delete']) &&  $r_group['user_delete'] == 1) ? 'true' : 'false';
            $approve = (isset($r_group['user_approve']) && $r_group['user_approve'] == 1) ? 'true' : 'false';
            $print = (isset($r_group['user_print']) && $r_group['user_print'] == 1) ? 'true' : 'false';
     

            echo "<ul>";
                if(in_array('add',$arr_chk)){
                    echo "<li id=\"add|".$m_id."\" data-jstree='{\"opened\":false,\"type\":\"file\",\"selected\": {$add} }' >เพิ่มข้อมูล</li>";
                }
                if(in_array('edit',$arr_chk)){
                    echo "<li id=\"edit|".$m_id."\" data-jstree='{\"opened\":false,\"type\":\"file\" ,\"selected\": {$edit} }' >แก้ไขข้อมูล</li>";
                }
                if(in_array('view',$arr_chk)){
                    echo "<li id=\"view|".$m_id."\" data-jstree='{\"opened\":false,\"type\":\"file\" ,\"selected\": {$view} }' >ดูรายละเอียด</li>";
                }
                if(in_array('delete',$arr_chk)){
                    echo "<li id=\"delete|".$m_id."\" data-jstree='{\"opened\":false,\"type\":\"file\",\"selected\": {$delete} }' >ลบข้อมูล</li>";
                }
                if(in_array('approve',$arr_chk)){
                    echo "<li id=\"approve|".$m_id."\" data-jstree='{\"opened\":false,\"type\":\"file\",\"selected\": {$approve} }' >อนุมัติข้อมูล</li>";
                }
                if(in_array('print',$arr_chk)){
                    echo "<li id=\"print|".$m_id."\" data-jstree='{\"opened\":false,\"type\":\"file\",\"selected\": {$print} }' >พิมพ์</li>";
                }
            echo "</ul>";
        }
    }
?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">ข้อมูลผู้ใช้งาน</h4>
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
        <a href="<?php echo base_url('user_account/aut_user/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_save" id="form_save" method="post" action="#">
                        <input type="hidden" name="srl_id" value="<?php echo isset($objData['group_id'])?$objData['group_id']:''; ?>" />
                        <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label hm-right">username <span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['username'])?$objData['username']:''; ?>
                            </div>
                            <label for="name" class="col-md-2 col-form-label hm-right">ชื่อ - สกุล<span style="color: #f46a6a">*</span></label>
                            <div class="col-md-3">
                                <?php echo isset($objData['fristname'])?$objData['fristname'].'  '.$objData['lastname']:''; ?>
                           </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <div id="allHidden"></div>
                            </div>
                            <div class="col-md-10">
                                <div id="dragTree">
                                    <?php get_setting_menu('',isset($objData['group_id'])?$objData['group_id']:''); ?>
                                </div>
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
                <a href="#!" onclick="get_save()" class="btn btn-success">
                    <i class="fas fa-check"></i> บันทึก
                </a>
            </div>
        </div> <!-- end col -->
    </div>

</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
<script src="<?php echo base_url('assets/libs/tree-view/js/jstree.min.js')?>"></script>
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
            }, function() { 
                var fdata = new FormData($("#form_save")[0]);
                $.ajaxSetup({ async: true  });
                $.ajax({
                    type: "POST",
                    url: baseUrl+ "/user_account/aut_user/save_menu", 
                    processData: false,
                    contentType: false,
                    data: fdata,
                    success: function(response) {
                        response = JSON.parse(response)
                        if(response.statusCode == 150){
                            showSuccess('บันทึกข้อมูลเรียบร้อย','<?php echo base_url('user_account/aut_user') ?>');
                        }else{
                            showError(response.msg);
                        }
                    }
                });
            });
        }


        $('#dragTree').jstree({
            'types': {
                'folder': {
                    'icon': 'fas fa-folder'
                },
                'file': {
                    'valid_children': [],
                    'icon': 'far fa-file'
                },
            },
            "core": {
                'expand_selected_onload': false
            },
            "checkbox": {
                'keep_selected_style': false
            },
            'plugins': [
                "checkbox",
                "types",
                "changed",
            ],
        });

        $('#dragTree').on('changed.jstree', function(e, data) {
            var i, j, r = [];
            var val = "";
            var hidden = "";
            for (i = 0, j = data.selected.length; i < j; i++) {
                val = data.instance.get_node(data.selected[i]).id;
                hidden += "<input name=\"MENU[]\"  type=\"hidden\" value=\"" + val + "\">";
            }
            $('#allHidden').html(hidden);
        });
    </script>
<?=$this->endSection()?> 

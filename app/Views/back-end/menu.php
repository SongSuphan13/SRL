<?=$this->extend('master');?>

<?=$this->section('template_user')?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/tree-view/css/treeview.css')?>">
<?=$this->endSection()?> 


<?=$this->section('content')?>
<?php 

	// header("Content-Type: application/json;");
     function get_setting_menu($m_id){
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
                    get_setting_menu($v["menu_id"]);
                 echo "</li>";
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
                <h4 class="mb-0 font-size-18">ตั้งค่าเมนู</h4>
            </div>
        </div>
    </div>
    <div class="button-items text-right">
       <!-- <a href="#!" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a> -->
        <a href="#!" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <div id="dragTree">
                       <?php get_setting_menu(''); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6" id="MENU_DETAIL">
           
        </div>
    </div>

</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
<script src="<?php echo base_url('assets/libs/tree-view/js/jstree.min.js')?>"></script>
<script>
 $( document ).ready(function() { 
 
    $('#dragTree').jstree({
		'core' : {
			'check_callback' : true,
			// 'themes' : {
				// 'responsive': true
			// }
		},
        'types' : {
            'folder' : {
                'icon' : 'fas fa-folder'
            },
            'file' : {
                'valid_children' : [],'icon' : 'far fa-file'
            }
        },
        'plugins' : [
            "contextmenu",
            "dnd",
            "massload",
            "search",
            "state",
            "types",
            "changed",
            "conditionalselect"
        ],
        'contextmenu' : {
            'items' : function(node) {
                var tmp = $.jstree.defaults.contextmenu.items();
                delete tmp.create.action;
                delete tmp.ccp;
                tmp.create.label = "เพิ่ม";
                tmp.rename.label = "แก้ไข";
                tmp.remove.label = "ลบ";
                // tmp.rename = false;
                tmp.create.submenu = {
                    "create_folder" : {
                        "separator_after"	: true,
                        "label"				: "หมวดเมนู",
                        "action"			: function (data) {
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            inst.create_node(obj, { "text":"หมวดเมนู",type : "folder" }, "last", function (new_node) {
                                setTimeout(function () { inst.edit(new_node); },0);
                            });
                        }
                    },
                    "create_file" : {
                        "label"				: "เมนู",
                        "action"			: function (data) {
                            var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                            inst.create_node(obj, { "text":"เมนู",type : "file" }, "last", function (new_node) {
                                setTimeout(function () { inst.edit(new_node); },0);
                            });
                        }
                    }
                };
                if(this.get_type(node) === "file") {
                    delete tmp.create;
                }
                return tmp;
            }
        }
    })
	.on('rename_node.jstree', function (e, data) {
		$.get('<?php echo base_url('');?>/back-end/menu/rename/', { 'id' : data.node.id, 'text' : data.text })
		.fail(function () {
			data.instance.refresh();
		});
	})
	.on('move_node.jstree', function (e, data) { 
        $.get('<?php echo base_url('');?>/back-end/menu/move/', { 'id' : data.node.id, 'parent_id' : data.parent, 'position' : data.position })
			.done(function (d) {
				data.instance.open_node(data.parent); 
			})
			.fail(function () {
				data.instance.refresh();
			});
	})
	.on('delete_node.jstree', function (e, data) {
        $.get('<?php echo base_url('');?>/back-end/menu/remove/', { 'id' : data.node.id })
			.done(function () {
				data.instance.open_node(data.parent); 
				$("#MENU_DETAIL").html('');
			})
			.fail(function () {
				data.instance.refresh();
				$("#MENU_DETAIL").html('');
			});
	})
	.on('create_node.jstree', function (e, data) {
		if(!(data.node.id > 0)){ 
			$.ajax({
				type: "GET",
				dataType: "json",
				url: '<?php echo base_url('');?>/back-end/menu/add/',
				data:  {'parent_id' : data.node.parent, 'text' : data.node.text, 'type' : data.node.type },
				success: function(d) {
					data.instance.set_id(data.node, d.id);
					data.instance.edit(data.node);
				}
			});
			// $.get('<?php echo base_url('');?>/back-end/menu/add/',)
			 // .done(function (d) { 
				
			// });
		} 
	});
// 	$(".dasboard-3-table-scroll").slimScroll({
// 		height: 600,
// 		size: '10px',
// 		allowPageScroll: true,
// 		wheelStep:5,
// 		color: '#000'
//    });
//    $("#product-list").slimScroll({
// 		height: 600,
// 		size: '10px',
// 		allowPageScroll: true,
// 		wheelStep:5,
// 		color: '#000'
//    });

});
$('#dragTree').on('changed.jstree', function (e, data) {

var menu_id = data.node.id;
var menu_type = data.node.type;
  if(menu_type == "file"){
      $('#menu_create_g').attr('disabled','true');
      $('#menu_create_f').attr('disabled','true');
      $('#menu_del').removeAttr('disabled');
  }else{
      $('#menu_create_g').removeAttr('disabled');
      $('#menu_create_f').removeAttr('disabled');
      if(menu_id == ""){
          $('#menu_create_f').attr('disabled','true');
          $('#menu_del').attr('disabled','true');
      }else{
          $('#menu_create_f').removeAttr('disabled');
          $('#menu_del').removeAttr('disabled');
      }
  }
    if(menu_id != ""){
     $("#MENU_DETAIL").html('');
        $.get('<?php echo base_url('');?>/back-end/menu/detail/', { 'menu_id' : menu_id, 'parent_id' : data.node.parent, 'text' : data.node.text, 'type' : data.node.type })
            .done(function (html) { 
                $("#MENU_DETAIL").html(html);
		});
    }else{
        $("#MENU_DETAIL").html('');
    }
});
</script>
<script>
    function get_save(){
		$('#form_save input,select').each(function(){
			if ( $(this).prop("required") ){
				$(this).removeClass("is-invalid")
			}
		});
		$(".invalid-feedback").remove();
		var brfore = '<div class="invalid-feedback">' ;
		var after = '</div>';
		var required = '';
		
		if($('input[id=menu_code]:required').val() == ''){
			$('input[id=menu_code]:required').addClass("is-invalid");
			$('input[id=menu_code]:required').after(brfore+'กรุณาระบุ Code'+after);
			required++; 
		}
		if($('input[id=menu_name_th]:required').val() == ''){
			$('input[id=menu_name_th]:required').addClass("is-invalid");
			$('input[id=menu_name_th]:required').after(brfore+'กรุณาระบุ ชื่อเมนู (TH)'+after);
			required++; 
		}
		if($('input[id=menu_type]').val() == 'file'){
			if($('input[id=menu_url]:required').val() == ''){
				$('input[id=menu_url]:required').addClass("is-invalid");
				$('input[id=menu_url]:required').after(brfore+'กรุณาระบุ URL'+after);
				required++; 
			}
			if($('input:checkbox[id^=menu_permis]:checked').length  == 0){
				$('input:checkbox[id^=menu_permis]').addClass("is-invalid");
                $('label[for=menu_permis] + div >  div:last-child').after(brfore+'กรุณาระบุสถานะ'+after)
				required++; 
			}
		}
		if(required > 0){
			return false;
		}
		var url = '<?php echo base_url('');?>/back-end/menu/save/'; 
        $.ajax({
            type: "POST",
            url: url,
            data: $("#form_save").serialize(),
            success: function(data)  {
				var res = JSON.parse(data);
                if(res.change == "Y"){
                    $('#dragTree').jstree(true).rename_node(res.id,res.name);
                }
                swal({
                    title: "บันทึกข้อมูลเรียบร้อยแล้ว", 
                    type: "success",
                    allowOutsideClick:true
                });
				// $("#MENU_DETAIL").html('');
            }
        });
    }
</script>

<?=$this->endSection()?> 

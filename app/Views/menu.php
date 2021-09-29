<?=$this->extend('master');?>

<?=$this->section('template_user')?>

<?=$this->endSection()?> 

<?=$this->section('content')?>
<?php 
     $session = session();
     $arr_menu = $session->get('user_menu');
    $gtxt_menu = "";
    // function m_get_parent($G,$arr_menu){
    //     global $gtxt_menu;
    //     foreach($arr_menu as $k=>$val){
    //         foreach($val as $kk=>$M){
    //             if ($M['menu_id'] == $G){ 
    //                 $txt = " <li class=\"breadcrumb-item\"><a href=\"".$M['menu_url']."\">".$M['menu_name_th']."</a></li> ";
    //                 $gtxt_menu = $txt.$gtxt_menu;
    //                 if($k > 0){
    //                     m_get_parent($k,$arr_menu);
    //                 }
    //             }
    //         }
    //     }
    // }
?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">ระบบบริหารทรัพยากรมนุษย์ (Human Resource Management)</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="index">หน้าแรก</a></li>
                        <?php echo $gtxt_menu; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <style>
            .prod-img{
                position: relative;
            }           
            .prod-img .p-new a {
                position: absolute;
                top: 8px;
                right: -1px;
                padding:8px 13px;
                line-height: 1;
                font-size:13px;
                text-transform: uppercase;
                border-radius: 2px 0 0 2px;
                background: #f50000;
                color: #fff;
                letter-spacing: 1px;
                font-weight: 600;
            }
    </style>
    <style>
        .prod-img {
            position:relative;
            padding-top:20px;
            display:inline-block;
        }
        .notify-badge{
            position: absolute;
            right:12px;
            top:10px;
            color:white;
            padding:5px 10px;
        }
		.prod-info{
			background: #fff;
			padding: 15px 0 20px;
		}
		.card {
			margin-bottom: 30px;
		}		
    </style>
    <!-- end page title -->
    <div class="row ">
        <?php  
            if(isset($arr_menu[$patent_id]) && is_array($arr_menu[$patent_id])){
                foreach($arr_menu[$patent_id] as $m_k =>$v){
                    $link  = base_url('menu/'.$v['menu_id']);
                    if($v['menu_url'] != '#'){
                        $link  = base_url($v['menu_url']); 
                    } 
                    
                ?>
                    <div class="col-lg-3" >
                        <div class="card">
                            <div class="text-center card-box">
                            <span class="badge badge-danger notify-badge" id="A-<?php echo $v['menu_id']; ?>">1</span>
                                <div class="prod-img">
                                    <a href="<?php echo $link; ?>" class="text-dark"> 
                                        <?php 
                                            if($v['menu_img'] != ''){
                                        ?>
                                            <img src="../icon/<?php echo $v['menu_img']; ?>" class="rounded-circle " alt="profile-image" >
                                        <?php 
                                            }else{
                                        ?>
                                            <img src="<?php echo base_url('icon/edit.png')?>" class="rounded-circle " alt="profile-image" >
                                        <?php } ?>
                                    <!-- end row-->
                                </div> 
                                <div class="prod-info">
                                    <h5><?php echo $v['menu_name_th']; ?></h5>
                                </div>
                                <!-- end .padding -->
                            </div>
                        </div>
                        <!-- end card-box-->
                    </div>
                <?php
                }
            }
        ?>
    </div>
</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>

<?=$this->endSection()?> 

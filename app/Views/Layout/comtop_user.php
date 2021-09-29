<header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="<?php echo base_url("menu/");?>" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?php echo base_url("assets/images/logo.svg"); ?>" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url("assets/images/logo-dark.png"); ?>" alt="" height="17">
                            </span>
                        </a>

                        <a href="<?php echo base_url("menu/");?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?php echo base_url("assets/images/logo-light.svg"); ?>" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url("assets/images/logo-light.png"); ?>" alt="" height="19">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>

                <div class="d-flex">
					<div class="dropdown d-lg-inline-block ml-1">
						<button type="button" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="bx bx-customize"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<div class="px-lg-2">
								<div class="row no-gutters">
									<div class="col">
										<a class="dropdown-icon-item" href="<?php echo base_url("back-end/menu"); ?>">
											<img src="<?php echo base_url("assets\images\brands\github.png"); ?>" alt="Github">
											<span>บริหาร  Menu</span>
										</a>
									</div>
									<div class="col"> 
										<a class="dropdown-icon-item" href="<?php echo base_url("back-end/group_list"); ?>">
											<img src="<?php echo base_url("assets\images\brands\bitbucket.png"); ?>" alt="bitbucket">
											<span>บริหาร Group</span>
										</a>
									</div>
									<div class="col">
										<a class="dropdown-icon-item" href="<?php echo base_url("back-end/table_list"); ?>">
											<img src="<?php echo base_url("assets\images\brands\dribbble.png"); ?>" alt="dribbble">
											<span>บริหาร Table</span>
										</a>
									</div>
								</div>

								<div class="row no-gutters">
									<div class="col">
										<a class="dropdown-icon-item" href="<?php echo base_url("back-end/data_dictionary"); ?>">
											<img src="<?php echo base_url("assets\images\brands\dropbox.png"); ?>" alt="dropbox">
											<span>Data Dictionary</span>
										</a>
									</div>
									<div class="col">
										<a class="dropdown-icon-item" href="#">
											<img src="<?php echo base_url("assets\images\brands\mail_chimp.png"); ?>" alt="mail_chimp">
											<span>Help</span>
										</a>
									</div>
									<div class="col">
										<!--<a class="dropdown-icon-item" href="#">
											<img src="<?php echo base_url("assets\images\brands\slack.png"); ?>" alt="slack">
											<span>Slack</span>
										</a>-->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-bell bx-tada"></i>
                            <span class="badge badge-danger badge-pill">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar="" style="max-height: 230px;">
                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <div class="avatar-xs mr-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="bx bx-cart"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">Your order is placed</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <img src="<?php echo base_url("assets/images/users/avatar-3.jpg"); ?>" class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">James Lemire</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">It will seem like simplified English.</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <div class="avatar-xs mr-3">
                                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                                <i class="bx bx-badge-check"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <img src="<?php echo base_url("assets/images/users/avatar-4.jpg");?>" class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 border-top">
                                <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?php echo base_url("assets/images/users/avatar-1.jpg"); ?>" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ml-1">Sathaphon Piwthongngam</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                            <!--<a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>
                            <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?php echo base_url('logout')?>"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <?php
							
                                $session = session();
                                $arr_menu = $session->get('user_menu');
                                
                                function get_menu($tree){
                                    $html ='';
                                    foreach ($tree[0] as $key => $value) {
                                        if(isset($tree[$value['menu_id']]) && is_array($tree[$value['menu_id']])) {
                                            $html .= '<li class="nav-item dropdown treeview-menu">
                                                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-customize mr-2"></i> '.$value['menu_name_th'].' '.(isset($tree[$value['menu_id']]) && is_array($tree[$value['menu_id']])?'<div class="arrow-down"></div>':'').' 
                                                            </a>';
                                                            if(isset($tree[$value['menu_id']]) && is_array($tree[$value['menu_id']])) {
                                                    $html .= '<div class="dropdown-menu" aria-labelledby="topnav-apps"> 
                                                                    '.get_menu_parent($tree,$value['menu_id']).'
                                                            </div>';
                                                            }
                                                $html .= '  </li>';
                                        }else{
                                            $html .= ' <a class="nav-link dropdown-toggle arrow-none" href="'.(($value['menu_url'] != '')?base_url($value['menu_url']):'#').'" role="button"  aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-customize mr-2"></i> '.$value['menu_name_th'].'  
                                                        </a>';
                                        }
                                    }
                                    return $html;
                                }
                                
                                function get_menu_parent($tree,$menu_id){
                                    $html ='';
                                    if(isset($tree[$menu_id]) && is_array($tree[$menu_id])) {
                                        foreach($tree[$menu_id] as $key => $value) {
                                            if(isset($value['menu_id'])) {
                                                $t = '';
                                                if(isset($tree[$value['menu_id']]) && is_array($tree[$value['menu_id']])) {
                                                    $t = '<div class="arrow-down"></div>';
                                                }
                                                $html .='<div class="dropdown">';
                                                if(isset($tree[$value['menu_id']]) && is_array($tree[$value['menu_id']])) {
                                                    $html .='
                                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-crm"
                                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                '.$value['menu_name_th'].$t.' 
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="topnav-crm">
                                                                    '.get_menu_parent($tree,$value['menu_id']).'
                                                            </div>';
                                                }else{
                                                    $html .= ' <a href="'.base_url($value['menu_url']).'" class="dropdown-item">'.$value['menu_name_th'].'</a>';
                                                }
                                                $html .='</div>';
                                            }else{
                                            
                                            }
                                    }
                                    }
                                    return   $html;
                                }
                                echo get_menu($arr_menu);
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

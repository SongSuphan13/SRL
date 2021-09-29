<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Login | Skote - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="<?php echo base_url("assets/css/icons.min.css"); ?>" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="<?php echo base_url("assets/css/app.min.css"); ?>" id="app-style" rel="stylesheet" type="text/css">
		<style>
             @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@200;300;400;500;600;700;800&display=swap');
            body{
                font-family: 'Sarabun', sans-serif  !important;
            }
            .is-invalid{
                background-image:none !important;
            }
		</style>

    </head>

    <body>
    <div class="home-btn d-none d-sm-block">
            <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Free Register</h5>
                                            <p>Get your free SRL Farmer account now.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="<?php echo base_url("assets\images\profile-img.png"); ?>" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="<?php echo base_url("assets\images\logo.svg"); ?>" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div> 
                                <div class="p-2">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url('/signup') ?>">
                                        <div class="form-group">
                                            <label for="useremail">Email</label>
                                            <input type="email" class="form-control <?php echo (isset($validation) && $validation->getError('useremail'))?'is-invalid':''; ?>" id="useremail" name="useremail" placeholder="Email" value="<?php echo set_value('useremail'); ?>"> 
                                            <div class="invalid-feedback"><?php echo (isset($validation) && $validation->getError('useremail'))?$validation->getError('useremail'):'' ?></div>       
                                        </div> 
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control <?php echo (isset($validation) && $validation->getError('username'))?'is-invalid':'' ?>" id="username" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>"> 
                                            <div class="invalid-feedback"><?php echo (isset($validation) && $validation->getError('username'))?$validation->getError('username'):'' ?></div>     
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input type="password" class="form-control <?php echo (isset($validation) && $validation->getError('userpassword'))?'is-invalid':'' ?>" id="userpassword" name="userpassword"  placeholder="Password" value="<?php echo set_value('userpassword'); ?>"> 
                                            <div class="invalid-feedback"><?php echo (isset($validation) && $validation->getError('userpassword'))?$validation->getError('userpassword'):'' ?></div>          
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmpassword">Confirm Password</label>
                                            <input type="password" class="form-control <?php echo (isset($validation) &&  $validation->getError('confirmpassword'))?'is-invalid':'' ?>" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"> 
                                            <div class="invalid-feedback"><?php echo (isset($validation) &&  $validation->getError('confirmpassword'))?$validation->getError('confirmpassword'):'' ?></div>           
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">ลงทะเบียน</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <div>
                                <p>Already have an account ? <a href="<?php echo base_url(); ?>/signin" class="font-weight-medium text-primary"> Login</a> </p>
                                 <p>© 2020 SRL Farmer. Crafted with <i class="mdi mdi-heart text-danger"></i> by Sathaphon SRL</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url("assets/libs/jquery/jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/metismenu/metisMenu.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/simplebar/simplebar.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/node-waves/waves.min.js"); ?>"></script>
        
        <!-- App js -->
        <script src="<?php echo base_url("assets/js/app.js"); ?>"></script>
    </body>
</html>

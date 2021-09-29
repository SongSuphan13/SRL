<!doctype html>
<html lang="en">

    <head>
        <?=view('Layout/template_user'); ?>
        <?php $this->renderSection('template_user'); ?>
        <style>
            .f-right{
                float: right !important;
            }
            .hm-right {
                text-align: right !important;
            }
            .page-title-box {
                padding-bottom: 10px !important;
            }
            #wf_space {
                padding-top: 40px;
            }
            @media screen and (max-width: 767px) {
                .hm-right{
                    text-align: left !important;
                }
            }
            @media (max-width: 767px){
                .form-group {
                    margin-bottom: 10px !important;
                }
            }
            @media only screen and (max-width: 767px){
                .form-group {
                    margin-bottom: 10px;
                }
            }
            .col-form-label{
                font-weight: 700;
            }
        </style> 
    </head>

    <body data-topbar="dark" data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">
             <?=view('Layout/comtop_user');?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content"> 
                <div class="page-content">
                    <?php $this->renderSection('content'); ?>
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->
            <?php 
                if(isset($screenNo)){
            ?>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="f-right">
                        <small>
                            <b style="padding:10px"><i class="fas fa-desktop"></i> <?php echo $screenNo;?></b>
                        </small>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- END layout-wrapper -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <style>
            .scrollup {
                position: fixed;
                bottom: 100px;
                right: 30px;
                display: none;
                z-index: 998;
                background: #1b8bf9;
                color: #fff;
                border-radius: 100px;
                height: 50px;
                width: 50px;
                line-height: 1.5;
                padding-left: 0;
                padding-right: 0;
            }
            .scrollup:hover {
                border: 1px solid #1b8bf9;
            }
            .scrollup-icon{
                color: #fff !important;
                padding: 0 10px;
                font-size: 31px;
            }
        </style>
        <a class="waves-effect waves-light bg-primary scrollup scrollup-icon" style="display: none;"><i class="fas fa-arrow-up"></i></a>
        <?=view('Layout/combottom_js_user');?>
        <?php $this->renderSection('combottom_js_user'); ?>
        <script>
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 600) {
                         $('.scrollup').fadeIn();
                    } else {
                        $('.scrollup').fadeOut();
                    }
                });
                $('.scrollup').click(function () {
                    $("html, body").animate({
                            scrollTop: 0
                    }, 600);
                    return false;
                });
        </script>
    </body>
</html>

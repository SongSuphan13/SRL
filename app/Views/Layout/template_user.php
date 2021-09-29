	<meta charset="utf-8">
    <title>SRL Chemical Co.,Ltd.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>">
    <script>var baseUrl  = '<?php echo base_url() ?>';</script>
    <!-- Bootstrap Css -->
  
    <link href="<?php echo base_url("assets/libs/sweetalert/css/sweetalert.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/libs/bootstrap-datepicker3/datepicker3.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/libs/select2/css/select2.min.css"); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="<?php echo base_url("assets/css/icons.min.css"); ?>" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="<?php echo base_url("assets/css/app.min.css"); ?>" id="app-style" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url("assets/libs/jquery/jquery.min.js"); ?>"></script>
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@200;300;400;500;600;700;800&display=swap');
        body{
            font-family: 'Sarabun', sans-serif  !important;
        }
        .is-invalid{
            background-image:none !important;
        }
        .badge{
            font-size: 13px;
        }
        .btn {
            border-radius: 2px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            font-size: 13px;
            font-weight: 600;
            transition: box-shadow linear 0.4s;
        }
        .btn-primary,.bg-primary,.page-item.active .page-link,body[data-topbar="dark"] #page-topbar
        ,a.bg-primary:focus, a.bg-primary:hover, button.bg-primary:focus, button.bg-primary:hover {
            background-color: #00c69e !important;
            border-color: #00c69e !important;
            color: #fff;
            text-align:center;
        } 
        
        .datepicker.dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            float: left;
            display: none;
            min-width: 160px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
            *border-right-width: 2px;
            *border-bottom-width: 2px;
            color: #333333;
            font-size: 13px;
            line-height: 1.42857143;
        }
        .datepicker.dropdown-menu th,
        .datepicker.datepicker-inline th,
        .datepicker.dropdown-menu td,
        .datepicker.datepicker-inline td {
            padding: 0px 5px;
        }
        .autonumber{
            text-align:right;
        }
        .input-group span {
            cursor: pointer;
        }
        .form-control:disabled, .form-control[readonly] {
            background-color: #eceeef;
            opacity: 1;
        }
        .invalid-feedback {
            display: inline-block !important;
        }
        .select2.is-invalid ~ .custom-control-label {
            color: #f46a6a;
        }
        .select2.is-invalid ~ .select2-container .select2-selection--single {
            border: 1px solid #f46a6a;
        }
        .select2.is-invalid ~ .select2-container .select2-selection--single .select2-selection__rendered {
            color: #f46a6a;
        }
      
        .md-input-wrapper{
            position: relative;
            padding-top: 4px;
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
        .md-input-wrapper > label{
            text-transform: initial;
            color: #727272;
            position: absolute;
            top: 16px;
            left: 4px;
            right: 0;
            pointer-events: none;
            -webkit-transition: all 150ms ease-out;
            transition: all 150ms ease-out;
        }
        input[type=text].md-form-control,input[type=file].md-form-control,input[type=password].md-form-control,input[type=email].md-form-control,input[type=number].md-form-control,.md-input-wrapper select,.md-input-wrapper textarea{
            border-radius: 0;
            border-width: 0 0 1px;
            border-style: solid;
            border-color: rgba(0,0,0,.12);
            box-shadow: inset 0 -1px 0 transparent;
            box-sizing: border-box;
            padding: 12px 4px;
            background: 0 0;
            width: 100%;
            display: block; 
            max-height: 100px;
        }
        textarea{
            height: 80px;
        }
        .md-disable{
            opacity: 0.7;
        }
        .md-disable input{
            cursor: not-allowed;
        }
        .checkbox-ripple{
            cursor: pointer;
        }
        .checkbox-disable,.fade-in-default label,.checkbox-default label,.radio-disable label{
            opacity: 0.6;
            cursor: not-allowed;
        }

        .md-input-wrapper .md-line{
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        .md-input-wrapper .md-line:after,.md-form-control:focus ~ .md-line:before, .md-input-wrapper .md-line:before{
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            width: 0;
            height: 2px;
            background: #1976d2;
            -webkit-transition: width .4s cubic-bezier(.4,0,.2,1);
            transition: width .4s cubic-bezier(.4,0,.2,1);
        }
        .md-form-control:focus ~ .md-line:before,.md-form-control:focus ~ .md-line:after{
            width: 100%;
            background: #1b8bf9;
        }
        .md-form-control .md-line:before{
            left:50%;
        }
        .md-form-control .md-line:after{
            right: 50%;
        }
        .md-static ~ label{
            top:-6px;
            font-size: 13px;
        }
        .md-form-control:focus ~ label,.md-valid ~ label{
            top: -6px;
            font-size: 13px;
            color:#1b8bf9;
        }
        .custom-file{
            display: block;
            position: relative;
            margin-bottom: 20px;
        }
        .custom-file .md-input-wrapper{
            margin-bottom:0;
        }
        .md-label-file{
            position: absolute;
            top: 12px;
        }
        .md-add-on{
            padding-right: 20px;
            vertical-align: middle;
            padding-left: 5px;
            display: table-cell;
        }
        /* .custom-file .md-input-wrapper{
            display: table-cell;
        }
        .custom-file .md-add-on{
            vertical-align: middle;
            display: inline-block;
            width: 35px;
            float: left;
            height: 3rem;
            line-height: 3rem;
            padding-top: 2px;
        }
        .custom-file .md-add-on ~ .md-input-wrapper {
            display: inline-block;
            width: calc(100% - 40px);
        }
        .md-input-file input[type=file] {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 100%;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .md-input-file{
            overflow: hidden;
            padding-left: 10px;
        }
        .custom-add-on-file{
            float: left;
            height: 3rem;
            line-height: 3rem;
        }
        .md-form-file ~ .md-form-control{
            opacity: 0;
            position: absolute;
            top: 0;
        } */
        /* .md-input-wrapper .md-check{
            padding-left: 0;
            top: 0;
        } */
        #wf_space .col-form-label {
            padding-top: 0px !important;
        }
    </style>
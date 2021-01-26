<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Ubah Kata sandi - LABATIK ID</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url('assets/global/plugins/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-toastr/toastr.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url('assets/global/css/components-md.min.css') ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/plugins-md.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url('assets/pages/css/login.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
    <style>
        body {
            background-size: 50%;
            background-position: center;
            background-position: top;
            background-repeat: no-repeat; 
        }
        .login {
            background-color:#ebeded!important;
            }
        .content {
            background-color:#d6a551!important; 
            border-radius:30px!important;
            }
        .create-account {
            background-color:#d6a551!important; 
            }
        .login .logo {
            /* margin: 40px auto 0; */
            padding-bottom: 50px;
            text-align: center;
        }
        .font-logo{
            font-family: Georgia, serif;
            font-size: 29px;
            letter-spacing: -1px;
            word-spacing: 1px;
            color: #FFFFFF;
            font-weight: 700;
            text-decoration: none;
            font-style: italic;
            font-variant: normal;
            text-transform: none;
        }


    </style>
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo site_url() ?>">
                <img src="<?php echo base_url() ?>uploads/logo/logo-2.png" alt="" width="250px">
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <h3 class="form-title font-dark">Ubah Kata Sandi</h3>

			<div id="infoMessage"><?php echo $message;?></div>

			<?php echo form_open('auth/reset_password/' . $code);?>

				<?php echo form_input($user_id);?>

				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Kata Sandi</label>
					<input class="form-control form-control-solid placeholder-no-fix"   type="password" autocomplete="off" placeholder="kata sandi" name="new" /> </div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Ulangi Kata Sandi</label>
					<input class="form-control form-control-solid placeholder-no-fix"   type="password" autocomplete="off" placeholder="ulangi kata sandi" name="new_confirm" /> </div>
				<div class="form-actions">
					<button type="submit" class="btn dark uppercase">Simpan</button>
				</div>

			<?php echo form_close();?>


            <!-- END LOGIN FORM -->
            <!-- BEGIN Lupa Password FORM -->
        </div>
         <div class="copyright"> 2019 © LABATIK.ID </div>
        <!-- BEGIN CORE PLUGINS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>

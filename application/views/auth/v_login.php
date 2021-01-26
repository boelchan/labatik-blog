<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Login - LABATIK ID</title>
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
            <?= form_open(site_url('auth/login_action'), 'class="login-form"', ''); ?>
                <h3 class="form-title font-dark">Silahkan Login</h3>
                <?php echo $this->session->flashdata('message'); ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix"   type="text" autocomplete="off" placeholder="Email" name="identity" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                    <label class="rememberme check mt-checkbox mt-checkbox-outline font-dark">
                        <input type="checkbox" name="remember" value="1" />Remember
                        <span></span>
                    </label>
                <div class="form-actions">
                    <button type="submit" class="btn dark uppercase">Login</button>
                    <a href="<?php echo site_url('auth/forgot_password') ?>" id="forget-password" class="forget-password font-dark">Lupa Password ?</a>
                    <!-- <a href="javascript:;" id="forget-password" class="forget-password font-dark">Lupa Password ?</a> -->
                </div>
                <?php if ($this->config->item('auth_login_social')): ?>
                <div class="login-options">
                    <h4>Or login with</h4>
                    <ul class="social-icons">
                        <li>
                            <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                        </li>
                    </ul>
                </div>
                <?php endif ?>

                <div class="create-account hide">
                    <p>
                        Belum punya akun?
                        <a href="javascript:;" id="register-btn" class=" font-dark">Daftar Disini</a>
                    </p>
                </div>
            <?= form_close(); ?>
            <!-- END LOGIN FORM -->
            <!-- BEGIN Lupa Password FORM -->
            <?= form_open(site_url('auth/forgot_password'), 'class="forget-form"', ''); ?>
                <h3 class="font-dark">Lupa Password ?</h3>
                <p> Masukkan email yang Anda gunakan untuk mereset password. Kode akan dikirim ke email Anda.  </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn red btn-outline">Kembali</button>
                    <button type="submit" class="btn dark uppercase pull-right">Kirim Kode</button>
                </div>
            <?= form_close(); ?>
            <!-- END Lupa Password FORM -->

            <!-- BEGIN REGISTRATION FORM -->
            <?= form_open(site_url('auth/create_user'), 'class="register-form"', ''); ?>
                <h3 class="font-dark">Daftar Member</h3>
                <p class="hint font-dark"> Masukkan data diri Anda: </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Nama</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Nama" name="first_name" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">No HP</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="No HP" name="phone" /> </div>
                <p class="hint font-dark"> Masukkan detail akun Anda: </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Ulangi Password</label>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Ulangi Password" name="password_confirm" /> </div>
                <div class="form-group margin-top-20 margin-bottom-20 hide">
                    <label class="mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="tnc" /> I agree to the
                        <a href="javascript:;">Terms of Service </a> &
                        <a href="javascript:;">Privacy Policy </a>
                        <span></span>
                    </label>
                    <div id="register_tnc_error"> </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="register-back-btn" class="btn red btn-outline">Kembali</button>
                    <button type="submit" id="register-submit-btn" class="btn dark uppercase pull-right">Daftar</button>
                </div>
            <?= form_close(); ?>
            </form>
            <!-- END REGISTRATION FORM -->
        </div>
         <div class="copyright"> 2019 © LABATIK.ID </div>
        <!--[if lt IE 9]>
<script src="<?php echo base_url('assets/global/plugins/respond.min.js') ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/excanvas.min.js') ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/ie8.fix.min.js') ?>"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url('assets/global/plugins/jquery.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/js.cookie.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/jquery-validation/js/additional-methods.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/select2/js/select2.full.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/sweetalert2/sweetalert2.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-toastr/toastr.min.js') ?>" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url('assets/global/scripts/app.min.js') ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('assets/global/scripts/main.js') ?>" type="text/javascript"></script>
        <script>
             $('.login-form input').keypress(function(e) {
                    if (e.which == 13) {
                        if ($('.login-form').validate().form()) {
                            $('.login-form').submit(); //form validation success, call ajax form submit
                        }
                        return false;
                    }
                });
            $("form").submit(function(e) {
                e.preventDefault();
                main.submitAjax($(this));
            });
            // jQuery('#forget-password').click(function() {
            //     jQuery('.login-form').hide();
            //     jQuery('.forget-form').show();
            // });

            jQuery('#back-btn').click(function() {
                jQuery('.login-form').show();
                jQuery('.forget-form').hide();
            });
            jQuery('#register-btn').click(function() {
                jQuery('.login-form').hide();
                jQuery('.register-form').show();
            });

            jQuery('#register-back-btn').click(function() {
                jQuery('.login-form').show();
                jQuery('.register-form').hide();
            });
        </script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>

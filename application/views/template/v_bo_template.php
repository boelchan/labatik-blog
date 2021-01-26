<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php if ($this->title) echo @$this->title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url('assets/global/plugins/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/datatables/datatables.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-toastr/toastr.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-summernote/summernote.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url('assets/global/css/components-md.css') ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/plugins-md.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url('assets/layouts/layout4/css/layout.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/layouts/layout4/css/themes/default.min.css') ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url('assets/layouts/layout4/css/custom.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <!-- ========================================= -->
        <!-- ========================================= -->
        <!-- ========================================= -->
        <script type="text/javascript">
            var site_url = '<?php echo site_url();  ?>';
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>

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
        <script src="<?php echo base_url('assets/global/plugins/select2/js/select2.full.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/scripts/datatable.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/datatables/datatables.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/sweetalert2/sweetalert2.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-toastr/toastr.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-summernote/summernote.min.js') ?>" type="text/javascript"></script>
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url('assets/global/scripts/app.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/scripts/main.js') ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- <link rel="shortcut icon" href="favicon.ico" /> -->
    </head>
    <!-- END HEAD -->
    <?php $page_sidebar_closed = ($this->input->cookie('sidebar_closed')) ? 'page-sidebar-closed' : '' ; ?>
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md <?php echo $page_sidebar_closed ?>" data-siteurl="<?php echo site_url() ?>">
        <!-- BEGIN HEADER -->
        <?php $this->load->view('template/v_header'); ?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <?php $this->load->view('template/left_menu'); ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1><?php echo @$this->title ?>
                                <small><?php echo @$small_title ?></small>
                            </h1>
                        </div>
                    </div>
                    <?php if (isset($breadcrumb)) : ?>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <span class="active"><?php echo $breadcrumb ?></span>
                        </li>
                    </ul>
                    <?php endif ?>
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="">
                        <?php echo $page_content ?>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <?php //$this->load->view('template/quick_sidebar'); ?>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2020 &copy; Tim Kreatif Labatik.id
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <div id="temp_modal"></div>

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url('assets/layouts/layout4/scripts/layout.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/layouts/layout4/scripts/demo.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/layouts/global/scripts/quick-sidebar.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootbox/bootbox.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') ?>" type="text/javascript"></script>
       
        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- form wizard -->
        <script src="<?php echo base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') ?>" type="text/javascript"></script>

        <script src="<?php //echo base_url('assets/pages/scripts/form-wizard.js') ?>" type="text/javascript"></script>
        <!-- form wizard -->

        <!-- perijinan -->
        <script src="<?php echo base_url('assets/scripts_page/form-wizard-perizinan.js'); ?>"></script>
        <script src="<?php echo base_url('assets/scripts_page/form-component-perizinan.js'); ?>"></script>
        <!-- perijinan -->

        <script>
            var group_id = <?php echo $this->group_id ?>;
        </script>
    </body>

</html>
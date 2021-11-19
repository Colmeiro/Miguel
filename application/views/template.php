<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?= isset($description) ? $description : '' ?>">
    <title><?= empty($titulo) ? $this->config->item('nombre_web') : ( empty($this->config->item('nombre_web')) ? $titulo : $titulo . ' – ' . $this->config->item('nombre_web') ) ?></title>

    <link rel="apple-touch-icon" href="<?=base_url();?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . $this->config->item('site_icon') ?>">
    <!-- <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/extensions/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/pages/authentication.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/jkanban/jkanban.min.css"> <!-- nuevo gtc -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/editors/quill/quill.snow.css"> <!-- nuevo gtc -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/pickers/pickadate/pickadate.css"> <!-- nuevo gtc -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/pages/app-kanban.css"> <!-- nuevo gtc -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css"> <!-- nuevo gtc -->
    <!--<link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/forms/select/select2.min.css">--> <!-- nuevo gtc -->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- <script src="https://kit.fontawesome.com/cd2158627f.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fontawesome-pro/css/all.css">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<? if ((strpos(current_url(), 'auth') === false)) { ?>
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
        <?php $this->load->view('header'); ?>
    <!-- END: Header-->


    <!-- BEGIN: Col Left-->
        <?php $this->load->view('col-left'); ?>
    <!-- END: Col Left-->

    <!-- BEGIN: Content-->
        <!-- linea borrada (ver documento instalación) -->
        <?php $this->load->view($main); ?>
    <!-- END: Content-->

    <!-- BEGIN: Demo Chat-->
    <?// $this->load->view('chat'); ?>
    <!-- END: Demo Chat-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
        <?php $this->load->view('footer'); ?>
    <!-- END: Footer-->


    <!-- BEGIN: Scripts-->
	    <?php $this->load->view('scripts'); ?>
	<!-- END: Scripts-->

</body>
<!-- END: Body-->
<? } else { ?>
    <?php echo $main; ?>
    <?php $this->load->view($main); ?>
<? } ?>

</html>
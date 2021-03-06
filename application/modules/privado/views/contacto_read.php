<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

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

        <!-- TITLE + BREADCRUMB -->
        <div class="content-header row">
            <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">
                <div class="row breadcrumbs-top">

                    <div class="breadcrumb-wrapper col-12 d-xl-none">
                        <ol class="breadcrumb br">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>
                            </li>
                        </ol>
                    </div>

                    <div class="col-12">
                        <!-- <?/*
                        <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $titulo ?></h4>
                        */?> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- table Transactions start -->
            <section id="table-transactions">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header bg-light-blue">
                                <h4 class="card-title"><?= isset($subtitulo) ? $subtitulo : '' ?>: <?php echo daFormato($data_fields['contacto_nombre'], 'varchar', '0-#475F7B', '') ?> </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pr-0 pl-0">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="table-extended-transactions" class="table mb-2">

                                            <tr>
                                                <td class="font-weight-bold">Nombre</td>
                                                <td><?php echo daFormato($data_fields['contacto_nombre'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Teléfono</td>
                                                <td><?php echo daFormato($data_fields['contacto_telefono'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td class="font-weight-bold">Fecha Creacion</td>
                                                <td><?php echo daFormato($data_fields['fecha_creacion'], 'datetime', '0-#333333', '') ?></td>
                                            </tr> -->
                                            <!-- <?/*<tr>
                                                <td class="font-weight-bold">DNI</td>
                                                <td><?php echo daFormato($data_fields['dni'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Ciudad</td>
                                                <td><?php echo daFormato($data_fields['ciudad'], 'varchar', '0-#333333', '') ?></td>
                                            </tr>*/?> -->
                                            <!-- <tr>
                                                <td class="font-weight-bold">Email</td>
                                                <td class="font-xs-smaller"><?php echo daFormato($data_fields['email'], 'email', '0-#333333', '') ?></td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td class="font-weight-bold">Rol</td>
                                                <td><? foreach ($s_rol_id as $c) {
                                                        if ($c->rol_id == $data_fields['rol_id']) {
                                                            echo $c->nombre;
                                                        }
                                                    } ?></td>
                                            </tr> -->
                                            <tr>
                                                <td class="font-weight-bold">Activo</td>
                                                <td>
                                                    <!-- <?php echo daFormato($data_fields['contacto_activo'], 'checkbox', '0-#333333', '') ?> -->
                                                    <?php if ($data_fields['contacto_activo']==1) { ?>
                                                        <span class="badge badge-light-success badge-pill">ACTIVO</span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-light-danger badge-pill">NO ACTIVO</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <!-- <?/*<tr>
                                                <td class="font-weight-bold">Orden</td>
                                                <td><?php echo daFormato($data_fields['orden'], 'int', '0-#333333', '') ?></td>
                                            </tr>*/?> -->
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start">
                                            <a href="<?php echo site_url('privado/contacto') ?>" class="btn btn-light-secondary ml-1 ml-sm-2 mb-1"><i class="bx bx-chevrons-left"></i>Volver</a> 
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <a href="<?= site_url('privado/contacto/update/' . $data_fields['contacto_id']) ?>" class="btn btn-success mr-1 mb-1"><i class="bx bx-edit"></i><span class="d-none d-sm-inline-block">Editar</span></a>

                                            <a href="<?= site_url('privado/contacto/delete/' . $data_fields['contacto_id']) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este contacto?')" class="btn btn-danger mr-1 mr-sm-2 mb-1"><i class="bx bx-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
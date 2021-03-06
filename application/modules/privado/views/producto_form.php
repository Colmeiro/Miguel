<div class="app-content content">
    <div class="content-overlay">
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
    </div>



    <div class="content-wrapper">
        <!-- TITLE + BREADCRUMB -->
        <div class="content-header row">
            <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">
                <div class="row breadcrumbs-top">

                    <div class="breadcrumb-wrapper col-12 d-xl-none">
                        <ol class="breadcrumb br">
                            <li class="breadcrumb-item"><a href="<?php base_url(); ?>"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active text-capitalize"><?= $titulo ?> 
                            </li>
                        </ol>
                    </div>

                    <div class="col-12">
                        <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $subtitulo ?></h4>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="content-body">

        <!-- botón volver -->
            <a href="<?php echo site_url('privado/producto') ?>" class="btn btn-light-secondary ml-0"><i class="bx bx-chevrons-left"></i>Volver</a> 
        

            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <?php if (isset($subtitulo) && $subtitulo=='Añadir producto') {
                                $bg_card="bg-light-blue";
                                $bg_card="bg-light-blue";
                                $dots="";
                            } else{
                                $bg_card="bg-light-green";
                                $dots=": ";
                            }?>

                            <div class="card-header <?php $bg_card?> mb-2">
                                <h4 class="card-title"><?php isset($subtitulo) ? $subtitulo : '' ?><?php $dots;?> <?php echo daFormato($data_fields['producto_nombre'], 'varchar', '0-#475F7B', '') ?> </h4>
                            </div>
                            
                            <div class="card-content">
                                <div class="card-body card-body-xs">
                                    <?php if (isset($data_fields)) extract($data_fields); //Provisional 
                                    ?>

                                    <form id="formulario" class="form form-vertical form-edit" action="<?php echo $action; ?>" enctype="multipart/form-data "method="post">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    

                                                <div class="form-group<?= form_error('producto_nombre') != '' ? ' has-error' : '' ?>">
                                                        <label for="producto_nombre">Nombre <?php echo form_error('producto_nombre') ?></label>
                                                        <?= daFormatoEdit($data_fields['producto_nombre'], 'producto_nombre', 'Nombre', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('producto_nombre') != '') { ?> <span class="help-block"><?= form_error('producto_nombre') ?></span> <? } ?>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('ref') != '' ? ' has-error' : '' ?>">
                                                        <label for="producto_ref">Referencia <?php echo form_error('producto_ref') ?></label>
                                                        <?= daFormatoEdit($data_fields['producto_ref'], 'producto_ref', 'Teléfono', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('producto_ref') != '') { ?> <span class="help-block"><?= form_error('producto_ref') ?></span> <? } ?>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('ref') != '' ? ' has-error' : '' ?>">
                                                        <label for="foto">Subir imagen<?php echo form_error('foto') ?></label> <br>
                                                        <input type="file" name="foto" id="foto">
                                                    </div>
                                                </div>

                                                
                                                <div class="col-12">
                                                    <div class="form-group<?php form_error('producto_activo') != '' ? ' has-error' : '' ?>">
                                                        <label for="producto_activo">Activo <?php echo form_error('producto_activo') ?></label>
                                                         
                                                        <label for="producto_activo"></label>
                                                        <?= daFormatoEdit($data_fields['producto_activo'], 'producto_activo', 'Activo', 'tinyint', 'checkbox', 0); ?>
                                                        
                                                        <?php if (form_error('producto_activo') != '') { ?> <span class="help-block"><?php form_error('producto_activo') ?></span> <?php } ?>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="producto_id" value="<?php echo $data_fields['producto_id']; ?>" />


                                                <div class="col-6 d-flex" style="text-align:left;">
                                                <input type="submit" name="submit"  value="Guardar Producto" action="<?php echo site_url('privado/producto/create_action'); ?> method="post" class="btn btn-primary"><?php echo $button ?></button>
                                                
                                                <!-- <input type="submit" name="submit" value="Subir"> -->
                                                    <!-- <?php if (isset($subtitulo) && $subtitulo==='Añadir producto') { ?>
                                                            <button type="submit" action="<?php echo site_url('privado/producto/create'); ?> method="post" class="btn btn-primary"><?php echo $button ?></button>
                                                            

                                                            <?php } else { ?>
                                                                <button type="submit" action="<?php echo site_url('privado/producto/update' . $data_fields['producto_id']); ?>" method="post" class="btn btn-primary"><?php echo $button ?></button>
                                                                <?php echo "hey"; ?>
                                                                
                                                    <?php }; ?> -->
                                                </div>
                                            </div>
                                        </form>
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
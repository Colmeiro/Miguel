<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?= isset($description) ? $description : '' ?>">
    <title><?= empty($titulo) ? $this->config->item('nombre_web') : ( empty($this->config->item('nombre_web')) ? $titulo : $titulo . ' – ' . $this->config->item('nombre_web') ) ?></title>

    <link rel="apple-touch-icon" href="<?=base_url();?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . $this->config->item('site_icon') ?>">

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
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/jkanban/jkanban.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/editors/quill/quill.snow.css"> 
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/css/pages/app-kanban.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <!-- END: Page CSS-->
    


    <div class="content-overlay"></div>
        <div class="content-wrapper">
           
            <!-- TITLE + BREADCRUMB -->
            
                <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">                    
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12 d-xl-none">
                            <ol class="breadcrumb br">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active text-capitalize"><?= $titulo; ?>
                                </li>
                            </ol>
                        </div>
                        <div class="col-12">
                            <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $titulo; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
<div class="content-body">

<!-- table Transactions start -->
<section id="table-transactions">
    <div class="card">
        <div class="card-header">
            
        <!-- head -->
            <!-- Single Date Picker and button -->
            <div class="heading-elements search-pep">
                <ul class="list-inline mb-0">
                    <li class="search-li">
                        <?/* <form action="<?php echo site_url('contactos/contactoscontroller/view'); ?>" method="post"> */?>
                            <fieldset class="has-icon-left position-relative">
                                <input type="text" id="buscartabla" class="form-control single-daterange" placeholder="<?php echo $total_rows ?> Resultados" name="q" value="<?= $q ?>"> <br>
                                <div class="form-control-position">
                                   <i class="bx bx-search font-medium-1"></i>
                                </div>
                                <!-- <button class="btn btn-light search-btn-pep rounded" type="button">
                                   <span><i class="bx bx-right-arrow-alt"></i></span>
                                </button> -->
                            </fieldset>
                        <?/* </form> */?>
                    </li>
                    <li class="ml-2"><?php echo anchor(site_url('contactos/contactoscontroller/create'), 'Añadir <i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?></li>
                    <br><br><br>
                </ul>
            </div>
        </div>

        
        <div class="table-responsive">
            <table id="table-extended-dt" class="dt-contactoscontroller table mb-0">
                <thead >
                    <tr>
                        <th class="<?= sentidobusquedacrd('local_nombre', 'locales.', true) ?>">
                            <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('contacto_nombre', 'contactos.')); ?>">Nombre</a>
                        </th>
                        <th class="<?= sentidobusquedacrd('local_ciudad', 'locales.', true) ?> d-none d-sm-table-cell">
                            <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('contacto_telefono', 'contactos.')); ?>">Ciudad</a>
                        </th>
                        <th class="<?= sentidobusquedacrd('local_telefono', 'locales.', true) ?> d-none d-sm-table-cell">
                            <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('foto', 'contactos.')); ?>">Teléfono</a>
                        </th>
                        <th class="<?= sentidobusquedacrd('local_valoracion', 'locales.', true) ?> d-none d-sm-table-cell">
                            <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('provincia', 'contactos.')); ?>">Valoración</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    foreach ($tappas_data as $row) {
                    ?>
                        <tr>

                        <td class=" text-left d-none d-sm-table-cell"> <?php echo $row->local_nombre; ?></td>
                                        
                        <td class=" text-left d-none d-sm-table-cell"> <?php echo $row->local_ciudad; ?></td>

                        <td class=" text-left d-none d-sm-table-cell"> <?php echo $row->local_telefono; ?></td>

                        <td class=" text-left d-none d-sm-table-cell"> <?php echo $row->local_valoracion; ?></td>


                               
                       

                            <!-- Acciones Desktop -->
                            <!-- <td class="text-center btn-acciones d-none d-md-table-cell">
                                <a href="<?//=site_url('contactos/contactoscontroller/read/'.$row->contacto_id) ?>" class="btn btn-xs btn-icon-only btn-info btn-table"><i class="bx bx-search"></i></a>
                                <a href="<?//=site_url('contactos/contactoscontroller/update/'.$row->contacto_id) ?>" class="btn btn-icon-only btn-xs btn-success btn-table"><i class="bx bx-edit"></i></a>
                                <a href="<?//=site_url('contactos/contactoscontroller/delete/'.$row->contacto_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este contactos?')" class="btn btn-xs btn-icon-only btn-danger btn-table"><i class="bx bx-trash"></i></a>
                            </td>
                            <!Acciones Mobile -->
                            <!-- <td class="text-center btn-acciones d-table-cell d-md-none">
                            <div class="dropdown">
                                <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                <div class="dropdown-menu dropdown-menu-right">
                                   <a class="dropdown-item" href="<?//=site_url('contactos/contactoscontroller/read/'.$row->contacto_id) ?>"><i class="bx bx-show-alt mr-1"></i> Ver</a>
                                   <a class="dropdown-item" href="<?//=site_url('contactos/contactoscontroller/update/'.$row->contacto_id) ?>"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                   <a class="dropdown-item" href="<?//=site_url('contactos/contactoscontroller/delete/'.$row->contacto_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este contactos?')"><i class="bx bx-trash mr-1"></i> Eliminar</a>
                               </div> -->
                            </div>
                            </td> 
                            
                        </tr>
                   <?
                   }
                   ?>
                </tbody>
            </table>
        </div>
        
        <!-- datatable ends -->

        <!-- Pagination -->
        <?/*<nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end mt-2 mr-2">
            <?
            if(strpos($pagination, 'page-item previous') === FALSE && strpos($pagination, 'page-item activ') !== FALSE) {
            ?>
                <li class="page-item previous disabled">
                    <a class="page-link" href="#">
                        <i class="bx bx-chevron-left"></i>
                    </a>
                </li>
            <?
            }
            ?>
                <?= $pagination ?>
            <?
            if(strpos($pagination, 'page-item next') === FALSE && strpos($pagination, 'page-item activ') !== FALSE) {
            ?>
                <li class="page-item next disabled">
                    <a class="page-link" href="#">
                        <i class="bx bx-chevron-right"></i>
                    </a>
                </li>
            <?
            }
            ?>
            </ul>
        </nav>*/?>
    </div>
</section>
</div>
<!-- END -->
</div>
</div>

<!-- BEGIN: Footer-->
<?php $this->load->view('footer'); ?>
    <!-- END: Footer-->
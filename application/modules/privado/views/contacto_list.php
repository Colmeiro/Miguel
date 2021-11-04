<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
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
                       <h4 class="content-header-title float-left no-border mb-0 text-capitalize">
                       <i class="bx bx-group"> </i> <?php $titulo ?> </h4>
                       <?php echo anchor(site_url('privado/contacto/create'), 'Añadir contacto<i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?>
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
                        <!--<h5 class="card-title"><?php echo $total_rows ?> resultados</h5>-->
                        <!-- Single Date Picker and button -->
                        <div class="heading-elements search-pep">
                            <ul class="list-inline mb-0">
                                <li class="search-li">
                                    <form action="<?php echo site_url('privado/contacto/view'); ?>" method="post">
                                        <fieldset class="has-icon-left position-relative">
                                            <input type="text" class="form-control single-daterange" placeholder="<?php echo $total_rows ?> Contactos" name="q" value="<?= $q ?>">
                                            <div class="form-control-position">
                                                <i class="bx bx-search font-medium-1"></i>
                                            </div>
                                            <button class="btn btn-light search-btn-pep rounded" type="button">
                                                <span><i class="bx bx-right-arrow-alt"></i></span>
                                            </button>
                                        </fieldset>
                                    </form>
                                </li>
                                
                                <!-- <li class="ml-2"> <?php echo anchor(site_url('privado/contacto/create'), 'Añadir contacto<i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?></li> -->
                                
                            </ul>
                        </div>
                    </div>
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="table-extended-transactions" class="table mb-0">
                            
                        <thead class="bg-pep">
                                <tr>
                                    <th class="<?= sentidobusquedacrd('contacto_nombre', 'contactos.', true) ?>">
                                        <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('contacto_nombre', 'contactos.')); ?>">Nombre</a>
                                    </th>
                                    <th class="<?= sentidobusquedacrd('contacto_telefono', 'contactos.', true) ?> d-none d-sm-table-cell">
                                        <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('contacto_telefono', 'contactos.')); ?>">Teléfono</a>
                                    </th>
                                    <th class="<?= sentidobusquedacrd('contacto_activo', 'contactos.', true) ?> text-center">
                                        <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('contacto_activo', 'contactos.')); ?>">Activo</a>
                                    </th>
                                    <!-- <?/*<th class="<?= sentidobusquedacrd('orden', 'contacto.', true) ?> d-none d-sm-table-cell text-center">
                                        <a href="<?php echo site_url('privado/contacto/view?ob=' . sentidobusquedacrd('orden', 'contacto.')); ?>">Orden</a>
                                    </th>*/?> -->
                                    <th class="text-center"><span class="d-none d-sm-block">Acciones</span></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($contacto_data as $row) { ?>
                                    <tr>
                                   
                                    <td class=" text-left d-none d-sm-table-cell"> <?php echo $row->contacto_nombre; ?></td>
                                        
                                    <td class=" text-left d-none d-sm-table-cell"> <?php echo $row->contacto_telefono; ?></td>
                                            
                                    <td class=" text-center d-none d-sm-table-cell">

                                        <?php if ($row->contacto_activo==1) { ?>
                                                <span class="badge badge-light-success badge-pill">ACTIVO</span>
                                            <?php }else{ ?>
                                                <span class="badge badge-light-danger badge-pill">NO ACTIVO</span>
                                            <?php }; ?>
                                    </td>
                                        
                                            
                                        
                                        <!-- Acciones Desktop -->
                                        <td class="text-center btn-acciones d-none d-md-table-cell">
                                            
                                            <a href="<?= site_url('privado/contacto/read/' . $row->contacto_id) ?>" class="btn btn-xs btn-icon-only btn-info btn-table"><i class="bx bx-search"></i><span class="d-none d-sm-inline-block">Ver</span></a>
                                            <a href="<?= site_url('privado/contacto/update/' . $row->contacto_id) ?>" class="btn btn-icon-only btn-xs btn-success btn-table"><i class="bx bx-edit"></i><span class="d-none d-sm-inline-block">Editar</span></a>
                                            <a href="<?= site_url('privado/contacto/delete/' . $row->contacto_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este contacto?')" class="btn btn-xs btn-icon-only btn-danger btn-table"><i class="bx bx-trash"></i>Borrar</a>
                                            <!-- <a href="<?php site_url('privado/contacto/update/' . $row->contacto_id) ?>" class="btn btn-icon-only btn-xs btn-success btn-table"><i class="bx bx-edit"></i></a> -->
                                            <!-- <a href="<?php site_url('privado/contacto/delete/' . $row->contacto_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este contacto?')" class="btn btn-xs btn-icon-only btn-danger btn-table"><i class="bx bx-trash"></i></a> -->
                                            <!-- <a href="<?php site_url('privado/contacto/read/' . $row->contacto_id) ?>" class="color-l-gray mr-1"><i class="bx bx-search"></i></a>
                                            <!- <a href="<?php site_url('privado/contacto/update/' . $row->contacto_id) ?>" class="color-l-gray mr-1"><i class="bx bx-edit"></i></a>
                                            <a href="<?php site_url('privado/contacto/delete/' . $row->contacto_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este contacto?')" class="color-l-gray"><i class="bx bx-trash"></i></a> -->
                                        </td>

                                        <!-- Acciones Mobile -->
                                        <td class="text-center btn-acciones d-table-cell d-md-none">
                                        <div class="dropdown">
                                            <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?= site_url('privado/contacto/read/' . $row->contacto_id) ?>"><i class="bx bx-show-alt mr-1"></i> Ver</a>
                                                <a class="dropdown-item" href="<?= site_url('privado/contacto/update/' . $row->contacto_id) ?>"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                                <a class="dropdown-item" href="<?= site_url('privado/contacto/delete/' . $row->contacto_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este contacto?')"><i class="bx bx-trash mr-1"></i> Eliminar</a>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                <?php  }; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end mt-2 mr-2">
                            <?
                            if (strpos($pagination, 'page-item previous') === FALSE && strpos($pagination, 'page-item activ') !== FALSE) {
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
                            if (strpos($pagination, 'page-item next') === FALSE && strpos($pagination, 'page-item activ') !== FALSE) {
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
                    </nav>
                </div>
            </section>
        </div>
        <!-- END -->
    </div>
</div>
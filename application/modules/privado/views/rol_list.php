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
                    <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-user-plus"></i><?= $titulo ?></h4>
                    <br></br>
                    <?php echo anchor(site_url('privado/rol/create'), 'Añadir Rol<i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?>
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
                            <!-- <h5 class="card-title"><?php echo $total_rows ?> resultados</h5> -->
                            <!-- Single Date Picker and button -->
                            <div class="heading-elements search-pep">
                                <ul class="list-inline mb-0">
                                    <li class="search-li">
                                        <form action="<?php echo site_url('privado/rol/view'); ?>" method="post">
                                            <fieldset class="has-icon-left position-relative">
                                                <input type="text" class="form-control single-daterange" placeholder="<?php echo $total_rows ?> Roles" name="q" value="<?php echo $q; ?>">
                                                <div class="form-control-position">
                                                    <i class="bx bx-search font-medium-1"></i>
                                                </div>
                                                <button class="btn btn-light search-btn-pep rounded" type="button">
                                                    <span><i class="bx bx-right-arrow-alt"></i></span>
                                                </button>
                                            </fieldset>
                                        </form>
                                    </li>
                                    <!-- <li class="ml-2"><?php echo anchor(site_url('privado/rol/create'), 'Añadir Rol<i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?></li> -->
                                </ul>
                            </div>
                        </div>
                        <!-- datatable start -->
                        <div class="table-responsive">
                            <table id="table-extended-transactions" class="table mb-0">
                                <thead class="bg-pep">
                                    <tr>
                                        <th class="<?= sentidobusquedacrd('nombre', 'rol.', true) ?> ">
                                            <a href="<?php echo site_url('privado/rol/view?ob=' . sentidobusquedacrd('nombre', 'rol.')); ?>">Nombre</a>
                                        </th>
                                        <th class="<?= sentidobusquedacrd('activo', 'rol.', true) ?> text-center">
                                            <a href="<?php echo site_url('privado/rol/view?ob=' . sentidobusquedacrd('activo', 'rol.')); ?>">Activo</a>
                                        </th>
                                        <th class="<?= sentidobusquedacrd('es_admin', 'rol.', true) ?> text-center d-none d-sm-table-cell">
                                            <a href="<?php echo site_url('privado/rol/view?ob=' . sentidobusquedacrd('es_admin', 'rol.')); ?>">Administrador</a>
                                        </th>
                                        <th class="<?= sentidobusquedacrd('orden', 'rol.', true) ?> text-center d-none d-sm-table-cell">
                                            <a href="<?php echo site_url('privado/rol/view?ob=' . sentidobusquedacrd('orden', 'rol.')); ?>">Orden</a>
                                        </th>
                                        <th class="text-center"><span class="d-none d-sm-block">Acciones</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rol_data as $row) { ?>
                                        <tr>
                                            <td class="text-left color-blue"><?php echo daFormato($row->nombre, 'varchar', '0-#333333', '', '', '') ?></td><!--text-bold-500-->
                                            <td class="text-center">
                                                <?php if ($row->activo==1) { ?>
                                                    <span class="badge badge-light-success badge-pill">ACTIVO</span>
                                                <?php }else{ ?>
                                                    <span class="badge badge-light-danger badge-pill">NO ACTIVO</span>
                                                <?php }; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row->es_admin==1) { ?>
                                                    <span class="badge badge-light-secondary badge-pill">ADMIN</span>
                                                <?php }; ?>
                                            </td>
                                            <td class="text-center d-none d-sm-table-cell"><?php echo daFormato($row->orden, 'int', '0-#333333', '', '', '') ?></td>

                                            <!-- Acciones Desktop -->
                                            <td class="text-center btn-acciones d-none d-md-table-cell">
                                                
                                                <a href="<?= site_url('privado/rol/read/' . $row->rol_id) ?>" class="btn btn-xs btn-icon-only btn-info btn-table mb-1 mb-md-0"><i class="bx bx-search"></i></a>
                                                <a href="<?= site_url('privado/rol/update/' . $row->rol_id) ?>" class="btn btn-icon-only btn-xs btn-success btn-table mb-1 mb-md-0"><i class="bx bx-edit"></i></a>
                                                <a href="<?= site_url('privado/rol/delete/' . $row->rol_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este rol?')" class="btn btn-xs btn-icon-only btn-danger btn-table mb-1 mb-md-0"><i class="bx bx-trash"></i></a>
                                                
                                                <!-- <a href="<?= site_url('privado/rol/read/' . $row->rol_id) ?>" class="color-l-gray mr-1"><i class="bx bx-search"></i></a>
                                                <a href="<?= site_url('privado/rol/update/' . $row->rol_id) ?>" class="color-l-gray mr-1"><i class="bx bx-edit"></i></a>
                                                <a href="<?= site_url('privado/rol/delete/' . $row->rol_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este rol?')" class="color-l-gray"><i class="bx bx-trash"></i></a> -->
                                            </td>

                                            <!-- Acciones Mobile -->
                                        <td class="text-center btn-acciones d-table-cell d-md-none">
                                        <div class="dropdown">
                                            <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?= site_url('privado/rol/read/' . $row->rol_id) ?>"><i class="bx bx-show-alt mr-1"></i> Ver</a>
                                                <a class="dropdown-item" href="<?= site_url('privado/rol/update/' . $row->rol_id) ?>"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                                <a class="dropdown-item" href="<<?= site_url('privado/rol/delete/' . $row->rol_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este rol?')"><i class="bx bx-trash mr-1"></i> Eliminar</a>
                                            </div>
                                        </div>
                                        </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- datatable ends -->

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mt-2 mr-2">
                            <?
                            if(strpos($pagination, 'page-item previous') === FALSE && strpos($pagination, 'page-item active') !== FALSE) {
                            ?>
                                <li class="page-item previous disabled">
                                    <a class="page-link" href="#">
                                        <i class="bx bx-chevron-left"></i>
                                    </a>
                                </li>
                            <?
                            }
                            ?>
                                <?php echo $pagination ?>
                            <?
                            if(strpos($pagination, 'page-item next') === FALSE && strpos($pagination, 'page-item active') !== FALSE) {
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
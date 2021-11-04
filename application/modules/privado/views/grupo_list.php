<div class="app-content content">
    <div class="content-overlay"></div>
        <div class="content-wrapper">
            <!-- TITLE + BREADCRUMB -->
            <div class="content-header row">
                <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12 d-xl-none">
                            <ol class="breadcrumb br">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>
                                </li>
                            </ol>
                        </div>
                        <div class="col-12">
                            
                            <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-building"></i><?= $titulo ?></h4>
                            <br></br>
                             <?php if(modules::run('security/check_admin')) { ?>
                                <?php echo anchor(site_url('privado/grupo/create'), 'Añadir Grupo <i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?>
                            <?php }; ?>

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
                        <form action="<?php echo site_url('privado/grupo/view'); ?>" method="post">
                            <fieldset class="has-icon-left position-relative">
                                <input type="text" class="form-control single-daterange" placeholder="<?php echo $total_rows ?> Resultados" name="q" value="<?= $q ?>">
                                <div class="form-control-position">
                                   <i class="bx bx-search font-medium-1"></i>
                                </div>
                                <button class="btn btn-light search-btn-pep rounded" type="button">
                                   <span><i class="bx bx-right-arrow-alt"></i></span>
                                </button>
                            </fieldset>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- datatable start -->
        <div class="table-responsive">
            <table id="table-extended-transactions" class="table mb-0">
                <thead class="bg-pep">
                    <tr>
                        <!-- <?/*<th class="<?= sentidobusquedacrd('grupo_id','grupo.',true)?> w-80 d-none d-sm-table-cell">
                            <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('grupo_id','grupo.')); ?>">ID</a>
                        </th>*/?> -->

                        <th class="<?=sentidobusquedacrd('nombre','grupo.',true)?>">
                        <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('nombre','grupo.')); ?>">Nombre</a>
                        </th>
                        <!-- <th class="<?=sentidobusquedacrd('sociedad','grupo.',true)?> d-none d-sm-table-cell">
                        <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('sociedad','grupo.')); ?>">Sociedad</a>
                        </th> -->
                        <!-- <th class="<?=sentidobusquedacrd('telefono','grupo.',true)?> d-none d-sm-table-cell">
                        <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('telefono','grupo.')); ?>">Telefono</a>
                        </th>
                        <th class="<?=sentidobusquedacrd('email','grupo.',true)?> d-none d-sm-table-cell">
                        <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('email','grupo.')); ?>">Email</a>
                        </th>
                        <th class="<?=sentidobusquedacrd('franquiciado','grupo.',true)?> d-none d-sm-table-cell text-center">
                        <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('franquiciado','grupo.')); ?>">Franquiciado</a>
                        </th> -->
                        <th class="<?=sentidobusquedacrd('orden','grupo.',true)?> text-center">
                        <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('orden','grupo.')); ?>">Orden</a>
                        </th>
                        <th class="<?=sentidobusquedacrd('activo','grupo.',true)?> text-center">
                        <a href="<?php echo site_url('privado/grupo/view?ob='.sentidobusquedacrd('activo','grupo.')); ?>">Activo</a>
                        </th> 
                    <? 
                    if(modules::run('security/check_admin')) {                       
                    ?>
                        <th class="d-none d-sm-table-cell text-center">
                            <span>Usuarios</span>
                        </th>
                    <?
                    }
                    ?>
                        <th class="text-center"><span class="d-none d-sm-block">Acciones</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grupo_data as $row) { ?>
                        <tr>

                            <!-- <?/*<td class="text-left d-none d-sm-table-cell"><?php echo daFormato($row->grupo_id,'int','0-#5A8DEE','') ?></td>*/?> -->
                            <td class=" text-left"><?php echo $row->nombre; ?>
                                <!-- <?/*<span class="d-sm-none">
                                    <br>
                                    <span class="rol-mvl"><strong>ID CENTRO</strong>: <?php echo daFormato($row->grupo_id,'int','0-#333333','') ?></span>
                                </span>*/?> -->
                            </td>
                            <!-- <td class=" text-left d-none d-sm-table-cell"><?php echo daFormato($row->sociedad,'varchar','0-#333333','','','') ?></td>
                            <td class=" text-left d-none d-sm-table-cell"><?php echo daFormato($row->telefono,'varchar','0-#333333','','','') ?></td>
                            <td class=" text-left d-none d-sm-table-cell"><?php echo daFormato($row->email,'email','0-#333333','','','') ?></td> -->
                            
                            <!-- bloque del if franquiciado -->

                            <!-- <td class=" text-center d-none d-sm-table-cell">
                                <?php if ($row->franquiciado==1) { ?>
                                    <span class="badge badge-light-success badge-pill">SÍ</span>
                                <?php }else{ ?>
                                    <span class="badge badge-light-danger badge-pill">NO</span>
                                <?php }; ?>
                            </td> -->

                            <td class="text-center d-none d-sm-table-cell"><?php echo daFormato($row->orden, 'int', '0-#333333', '', '', '') ?></td>
                            <td class=" text-center">
                                <?php if ($row->activo==1) { ?>
                                    <span class="badge badge-light-success badge-pill">ACTIVO</span>
                                <?php }else{ ?>
                                    <span class="badge badge-light-danger badge-pill">NO ACTIVO</span>
                                <?php }; ?>
                            </td>
                        <?php if(modules::run('security/check_admin')) { ?>
                            <td class=" text-center d-none d-sm-table-cell">
                                <a href="<?=site_url('privado/usuario-grupo/view/' . $row->grupo_id)?>" class="btn btn-sm btn-outline-light"><i class="bx bx-buildings d-inline"></i><span class="d-inline">Editar</span></a>
                                <br>
                                <div class="num-usuarios-grupo"><?= $row->num_usuarios ?> <?= $row->num_usuarios == 1 ? 'usuario' : 'usuarios' ?></div>
                            </td>
                        <?php }; ?>
                            <!-- Acciones Desktop -->
                            <td class="text-center btn-acciones d-none d-md-table-cell">
                                <a href="<?=site_url('privado/grupo/read/'.$row->grupo_id) ?>" class="color-l-gray mr-1"><i class="bx bx-search"></i></a>
                            <?php if(modules::run('security/check_admin')) { ?>

                                <a href="<?=site_url('privado/grupo/update/'.$row->grupo_id) ?>" class="color-l-gray mr-1"><i class="bx bx-edit"></i></a>
                                <a href="<?=site_url('privado/grupo/delete/'.$row->grupo_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este grupo?')" class="color-l-gray"><i class="bx bx-trash"></i></a>
                            <?php }; ?>

                            </td>
                            <!-- Acciones Mobile -->
                            <td class="text-center btn-acciones d-table-cell d-md-none">
                            <div class="dropdown">
                                <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                <div class="dropdown-menu dropdown-menu-right">
                                   <a class="dropdown-item" href="<?=site_url('privado/grupo/read/'.$row->grupo_id) ?>"><i class="bx bx-show-alt mr-1"></i> Ver</a>
                                <?php if(modules::run('security/check_admin')) { ?>

                                   <a class="dropdown-item" href="<?=site_url('privado/grupo/update/'.$row->grupo_id) ?>"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                   <a class="dropdown-item" href="<?=site_url('privado/grupo/delete/'.$row->grupo_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este grupo?')"><i class="bx bx-trash mr-1"></i> Eliminar</a>
                                <?php }; ?>

                               </div>
                            </div>
                            </td>
                        </tr>
                   <?php }; ?>
                </tbody>
            </table>
        </div>
        <!-- datatable ends -->

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
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
        </nav>
    </div>
</section>
</div>
<!-- END -->
</div>
</div>

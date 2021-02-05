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
                        <div class="col-12 mb-2">
                        <?
                        if(!empty($grupo)) {
                            $grupo_elegido = TRUE;
                        ?>
                            <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-buildings"></i><?= $titulo_grupo . $grupo->nombre ?></h4>
                        <?
                        }
                        ?>
                        </div>
                        <div class="col-6">
                            <?php echo anchor(site_url('privado/usuario-grupo/create'), 'Añadir <i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?>
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
                        <form action="<?php echo site_url('privado/usuario-grupo' . $url_plus); ?>" method="post">
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
                    <?/*
                    <li class="ml-2"><?php echo anchor(site_url('privado/usuario-grupo/create'), 'Añadir <i class="bx bx-plus"></i>', 'class="btn btn-primary add-btn"'); ?></li>
                    */?>
                </ul>
            </div>
        </div>
        <!-- datatable start -->
        <div class="table-responsive">
            <table id="table-extended-transactions" class="table mb-0">
                <thead class="bg-pep">
                    <tr>
                        <?
                        if(!$grupo_elegido) {
                        ?>
                            <th class="<?=sentidobusquedacrd('grupo_id','usuario_grupo.',true)?> d-none d-sm-table-cell">
                            <a href="<?php echo site_url('privado/usuario-grupo' . $url_plus . '?ob='.sentidobusquedacrd('grupo_id','usuario_grupo.')); ?>">Grupo</a>
                            </th>
                        <?
                        }
                        ?>
                        <th class="<?=sentidobusquedacrd('rol','usuario_grupo.',true)?>">
                        <a href="<?php echo site_url('privado/usuario-grupo' . $url_plus . '?ob='.sentidobusquedacrd('rol','usuario_grupo.')); ?>">Rol</a>
                        </th>
                        <th class="<?=sentidobusquedacrd('usuario_id','usuario_grupo.',true)?> d-none d-sm-table-cell">
                        <a href="<?php echo site_url('privado/usuario-grupo' . $url_plus . '?ob='.sentidobusquedacrd('usuario_id','usuario_grupo.')); ?>">Usuario</a>
                        </th>
                        <th class="<?=sentidobusquedacrd('orden','usuario_grupo.',true)?> d-none d-sm-table-cell text-center">
                        <a href="<?php echo site_url('privado/usuario-grupo' . $url_plus . '?ob='.sentidobusquedacrd('orden','usuario_grupo.')); ?>">Orden</a>
                        </th>
                        <th class="<?=sentidobusquedacrd('activo','usuario_grupo.',true)?> text-center">
                        <a href="<?php echo site_url('privado/usuario-grupo' . $url_plus . '?ob='.sentidobusquedacrd('activo','usuario_grupo.')); ?>">Activo</a>
                        </th>               
                        <th class="text-center"><span class="d-none d-sm-table-cell">Acciones</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    foreach ($usuario_grupo_data as $row) {
                    ?>
                        <tr>
                        <?
                        if(!$grupo_elegido) {
                        ?>
                            <td class=" text-left d-none d-sm-table-cell"><?php echo daFormato($row->grupo_id,'relacionado','0-#5A8DEE','','','') ?></td>
                        <?
                        }
                        ?>
                            <td class=" text-left">
                                <?php echo daFormato($row->rol,'relacionado','0-#5A8DEE','','','') ?>
                                <span class="d-sm-none">
                                    <br>
                                    <?php echo daFormato($row->usuario_id . ' ' . $row->apellidos,'relacionado','0-#333333','','','') ?></span>
                                </span>
                            </td>
                            <td class=" text-left d-none d-sm-table-cell"><?php echo daFormato($row->usuario_id . ' ' . $row->apellidos,'relacionado','0-#333333','','','') ?></td>
                            <td class=" text-center d-none d-sm-table-cell"><?php echo daFormato($row->orden,'int','0-#333333','','','') ?></td>
                            <td class=" text-center">
                                <?php //echo daFormato($row->activo,'checkbox','0-#333333','','','') ?>
                                <? if ($row->activo==1) { ?>
                                    <span class="badge badge-light-success badge-pill">ACTIVO</span>
                                <? }else{ ?>
                                    <span class="badge badge-light-danger badge-pill">NO ACTIVO</span>
                                <? } ?>
                            </td>
                            <!-- Acciones Desktop -->
                            <td class="btn-acciones d-none d-md-table-cell">
                                <a href="<?=site_url('privado/usuario-grupo/read/'.$row->usuario_grupo_id) ?>" class="color-l-gray mr-1"><i class="bx bx-search"></i></a>
                                <a href="<?=site_url('privado/usuario-grupo/update/'.$row->usuario_grupo_id) ?>" class="color-l-gray mr-1"><i class="bx bx-edit"></i></a>
                                <a href="<?=site_url('privado/usuario-grupo/delete/'.$row->usuario_grupo_id) ?>" onclick="javascript: return confirm('¿Seguro que deseas retirar el usuario de esta relación?')" class="color-l-gray"><i class="bx bx-trash"></i></a>
                            </td>
                            <!-- Acciones Mobile -->
                            <td class="text-center btn-acciones d-table-cell d-md-none">
                            <div class="dropdown">
                                <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                <div class="dropdown-menu dropdown-menu-right">
                                   <a class="dropdown-item" href="<?=site_url('privado/usuario-grupo/read/'.$row->usuario_grupo_id) ?>"><i class="bx bx-show-alt mr-1"></i> Ver</a>
                                   <a class="dropdown-item" href="<?=site_url('privado/usuario-grupo/update/'.$row->usuario_grupo_id) ?>"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                   <a class="dropdown-item" href="<?=site_url('privado/usuario-grupo/delete/'.$row->usuario_grupo_id) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar esta relación?')"><i class="bx bx-trash mr-1"></i> Eliminar</a>
                               </div>
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

        <div class="row">
            <div class="col-12">
                <a href="<?php echo site_url('privado/grupo') ?>" class="btn btn-light-secondary ml-1 ml-sm-2 mb-1"><i class="bx bx-chevrons-left"></i>Volver</a>
            </div>
        </div>
    </div>
</section>
</div>
<!-- END -->
</div>
</div>

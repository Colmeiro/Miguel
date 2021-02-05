<?
$this->load->view('loader', array('has_data' => !empty($almacen_data)));
?>

<div class="app-content content">
    <div class="content-overlay"></div>
        <div class="content-wrapper">
            <!-- TITLE + BREADCRUMB -->
            <div class="content-header row">
                <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">                    
                <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12 d-xl-none">
                            <ol class="breadcrumb br">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>
                                </li>
                            </ol>
                        </div>
                        <div class="col-12">
                            <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $titulo ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <form id="filter_form" action="" method="post">
                        <input type="hidden" id="post_check" name="post_check">

                        <?/*<input type="hidden" id="data_fecha_ini" name="data_fecha_ini" value="<?= $fecha_ini ?>">
                        <input type="hidden" id="data_fecha_fin" name="data_fecha_fin" value="<?= $fecha_fin ?>">*/?>
                        
                        <div class="row">
                            <?/*<div id="inp_fechas" class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-2">
                                <div class="input-group date-picker">
                                    <p class="label-text">Desde</p>
                                    <input type="date" id="fecha_ini" name="fecha_ini" class="form-control width-150" value="<?=!empty($fecha_ini)?$fecha_ini:''?>">
                                    <p class="label-text sm-label">hasta</p>
                                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control width-150" value="<?=!empty($fecha_fin)?$fecha_fin:''?>">
                                </div>
                            </div>*/?>

                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-2">
                                <div class="input-group limited">
                                    <span class="label-text">Limitado a </span>
                                    <input type="number" id="limit" name="limit" class="form-control w-80" step="100" value="<?=!empty($limit)?$limit:''?>">
                                    <span class="label-text ml-8"> de <span style="font-weight: normal;"><?=$total_rows?></span> registros.</span>
                                </div>
                            </div>

                            <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                <button type="submit" id="submit_post_check" class="btn btn-primary">Aplicar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="content-body oculto" style="display: none;">
            <!-- table Transactions start -->
            <section id="table-transactions">
                <div class="card">
                    <div class="card-header">
                        <!-- head -->
                        <!-- Single Date Picker and button -->
                        <div class="heading-elements search-pep">
                            <ul class="list-inline mb-0">
                                <li class="search-li">
                                    <?/* <form action="<?php echo site_url('privado/almacen/view'); ?>" method="post"> */?>
                                        <fieldset class="has-icon-left position-relative">
                                            <input type="text" id="buscartabla" class="form-control single-daterange" placeholder="<?php echo $limit ?> Resultados" name="q" value="<?= $q ?>">
                                            <div class="form-control-position">
                                            <i class="bx bx-search font-medium-1"></i>
                                            </div>
                                            <button class="btn btn-light search-btn-pep rounded" type="button">
                                            <span><i class="bx bx-right-arrow-alt"></i></span>
                                            </button>
                                        </fieldset>
                                    <?/* </form> */?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="table-extended-dt" class="dt-almacen table mb-0">
                            <thead class="bg-pep">
                                <tr>
                                    <th class="sorting text-center"><a>Situación</a></th>
                                    <th class="sorting text-center"><a>Tipo</a></th>
                                    <th class="sorting text-center"><a>Fecha</a></th>
                                    <th class="sorting text-center"><a>Modo</a></th>
                                    <th class="sorting text-center"><a>ID Caja</a></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?
                            foreach ($almacen_data as $row) {
                            ?>
                                <tr>
                                    <td class="text-center" data-order="<?= $row->situacion ?>" data-search="<?= $row->situacion ?>"><?php echo daFormato($row->situacion,'varchar','0-#333333','','','') ?></td>
                                    <td class="text-center" data-order="<?= $row->tipo ?>" data-search="<?= $row->tipo ?>"><?php echo daFormato($row->tipo,'varchar','0-#333333','','','') ?></td>
                                    <td class="text-center" data-order="<?= $row->fecha ?>" data-search="<?= $row->fecha ?>"><?php echo daFormato($row->fecha,'datetime','0-#333333','','','') ?></td>
                                    <td class="text-center" data-order="<?= $row->modo ?>" data-search="<?= $row->modo ?>"><?php echo daFormato($row->modo,'varchar','0-#333333','','','') ?></td>
                                    <td class="text-center" data-order="<?= $row->tag ?>" data-search="<?= $row->tag ?>"><?php echo daFormato($row->tag,'varchar','0-#333333','','','') ?></td>
                                    
                                </tr>
                            <?
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr class="dt-footer active">
                                    <th class="text-center"><input type="text" class="text_filter text-center" placeholder="Buscar Situación"></th>
                                    <th class="text-center"><input type="text" class="text_filter text-center" placeholder="Buscar Tipo"></th>
                                    <?/*<th class="text-center"><span class="datepickercon"><input type="text" class="text_filter text-center datepicker" placeholder="Buscar Fecha"></span></th>*/?>
                                    <th class="text-center"><input type="text" class="text_filter text-center" placeholder="Buscar Fecha"></th>
                                    <th class="text-center"><input type="text" class="text_filter text-center" placeholder="Buscar Modo"></th>
                                    <th class="text-center"><input type="text" class="text_filter text-center" placeholder="Buscar ID Caja"></th>
                                </tr>
                            </tfoot>
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

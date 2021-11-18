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
                            <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $titulo ?></h4>
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
						        <h4 class="card-title color-white"><?= isset($subtitulo) ? $subtitulo : '' ?>: <?php echo daFormato($data_fields['nombre'], 'varchar', '0-#ffffff', '') ?></h4>
                            </div>
						    <div class="card-content">
						        <div class="card-body pr-0 pl-0">
							        <!-- datatable start -->
							        <div class="table-responsive">
								        <table id="table-extended-transactions" class="table mb-2">

	                                <tr><td class="font-weight-bold"></td><td><?php echo daFormato($data_fields[''],'','0-0','') ?></td></tr>

	                                <tr><td class="font-weight-bold"></td><td><?php echo daFormato($data_fields['producto_nombre'],'varchar','0-0','') ?></td></tr>

	                                <tr><td class="font-weight-bold"></td><td><?php echo daFormato($data_fields['producto_ref'],'int','0-0','') ?></td></tr>
								        </table>
							        </div>
							        <div class="row">
							            <div class="col-6 d-flex justify-content-start">
								            <a href="<?php echo site_url('productos') ?>" class="btn btn-light-secondary ml-1 ml-sm-2 mb-1"><i class="bx bx-chevrons-left"></i>Volver</a>							            </div>
							            <div class="col-6 d-flex justify-content-end">
								            <a href="<?php echo site_url('productos/update/' . $data_fields['producto_id']) ?>" class="btn btn-success mr-1 mb-1"><i class="bx bx-edit"></i><span class="d-none d-sm-inline-block">Editar</span></a>								            <a href="<?php echo site_url('productos/delete/' . $data_fields['producto_id']) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este usuario?')" class="btn btn-danger mr-1 mr-sm-2 mb-1"><i class="bx bx-trash"></i></a>							            </div>
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
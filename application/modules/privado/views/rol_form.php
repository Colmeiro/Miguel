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
						<?/*
						<h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-user-plus"></i><?= $titulo ?></h4>
						*/?>
                    </div>
                </div>
            </div>
		</div>

		<div class="content-body">

			<section id="basic-vertical-layouts">
				<div class="row match-height">
					<div class="col-md-6 col-12">
						<div class="card">
							<div class="card-header bg-light-green mb-2">
								<h4 class="card-title"><?=isset($subtitulo) ? $subtitulo : ''?>: <?= $data_fields['nombre']?></h4>
							</div>
							<div class="card-content">
								<div class="card-body card-body-xs">
								<? if (isset($data_fields)) extract($data_fields); //Provisional ?>

									<form class="form form-vertical form-edit" action="<?php echo $action; ?>" method="post">
										<div class="form-body">
											<div class="row">
												<div class="col-12">
													<div class="form-group<?= form_error('nombre') != '' ? ' has-error' : '' ?>">
														<label for="nombre">Nombre <?php echo form_error('nombre') ?></label>
														<?= daFormatoEdit($data_fields['nombre'], 'nombre', 'Nombre', 'varchar', 'varchar', 1); ?>
														<? if (form_error('nombre') != '') { ?> <span class="help-block"><?= form_error('nombre') ?></span> <? } ?>
													</div>
												</div>

												<div class="col-12">
													<div class="form-group<?= form_error('orden') != '' ? ' has-error' : '' ?>">
														<label for="orden">Orden <?php echo form_error('orden') ?></label>
														<?= daFormatoEdit($data_fields['orden'], 'orden', 'Orden', 'int', 'int', 0); ?>
														<? if (form_error('orden') != '') { ?> <span class="help-block"><?= form_error('orden') ?></span> <? } ?>
													</div>
												</div>
												
												<?/*<div class="col-12 mb-2">
													<div class="form-group check-admin<?= form_error('activo') != '' ? ' has-error' : '' ?>">
														<label for="activo">Activo <?php echo form_error('activo') ?></label>

														<div class="checkbox checkbox-primary ml-1">
                                                        <?= daFormatoEdit(isset($data_fields['activo']) ? $data_fields['activo'] : '1', 'activo', 'Activo', 'tinyint', 'checkbox', 0); ?>
                                                        <label for="activo"></label>
														</div>
														
														<? if (form_error('activo') != '') { ?> <span class="help-block"><?= form_error('activo') ?></span> <? } ?>
													</div>
												</div>*/?>

												<div class="col-12 mb-2">
													<div class="form-group check-admin<?= form_error('es_admin') != '' ? ' has-error' : '' ?>">
														<label for="es_admin">Es Administrador <?php echo form_error('es_admin') ?></label>

														<div class="checkbox checkbox-primary ml-1">
                                                        <?= daFormatoEdit($data_fields['es_admin'], 'es_admin', 'Es Administrador', 'tinyint', 'checkbox', 0); ?>
                                                        <label for="es_admin"></label>
														</div>
														
														<?php if (form_error('es_admin') != '') { ?> <span class="help-block"><?= form_error('es_admin') ?></span> <?php }; ?>
													</div>
												</div>

												<input type="hidden" name="rol_id" value="<? echo $rol_id; ?>" />

												<div class="col-6 d-flex justify-content-start">


                                                    <a href="<?php echo site_url('privado/rol') ?>" class="btn btn-light-secondary ml-0"><i class="bx bx-chevrons-left"></i>Volver</a> </div>

                                                <div class="col-6 d-flex justify-content-end">

                                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
												</div>
												
												<!-- <div class="col-12 d-flex justify-content-start">
													<button type="submit" class="btn btn-primary mr-1 mb-1"><?php echo $button ?></button>
													<a href="<?php echo site_url('privado/rol') ?>" class="btn btn-light-secondary mr-1 mb-1"><i class="bx bx-chevrons-left"></i>Volver</a>
												</div> -->

											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>
	</div>
</div>
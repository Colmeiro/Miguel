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
						<?/*
							<h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-building"></i><?= $titulo ?></h4>
							*/ ?>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<section id="basic-vertical-layouts">
				<div class="row match-height">
					<div class="col-md-12 col-lg-8 col-xl-6 col-12">
						<div class="card">
							<? if (isset($subtitulo) && $subtitulo == 'Añadir Grupo') {
								$bg_card = "bg-light-blue";
								$dots = "";
							} else {
								$bg_card = "bg-light-green";
								$dots = ": ";
							} ?>
							<div class="card-header <?= $bg_card ?> mb-2">
								<h4 class="card-title"><?= isset($subtitulo) ? $subtitulo : '' ?><?= $dots; ?> <?php echo daFormato($data_fields['nombre'], 'varchar', '0-#475F7B', '') ?></h4>
							</div>
							<div class="card-content">
								<div class="card-body card-body-xs">
									<? if (isset($data_fields)) extract($data_fields); //Provisional 
									?>

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
												<?/*<div class="col-12">
													<div class="form-group<?= form_error('cif') != '' ? ' has-error' : '' ?>">
														<label for="cif">CIF <?php echo form_error('cif') ?></label>
														<?= daFormatoEdit($data_fields['cif'], 'cif', 'CIF', 'varchar', 'varchar', 1); ?>
														<? if (form_error('cif') != '') { ?> <span class="help-block"><?= form_error('cif') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('sociedad') != '' ? ' has-error' : '' ?>">
														<label for="sociedad">Sociedad <?php echo form_error('sociedad') ?></label>
														<?= daFormatoEdit($data_fields['sociedad'], 'sociedad', 'Sociedad', 'varchar', 'varchar', 1); ?>
														<? if (form_error('sociedad') != '') { ?> <span class="help-block"><?= form_error('sociedad') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('direccion') != '' ? ' has-error' : '' ?>">
														<label for="direccion">Dirección <?php echo form_error('direccion') ?></label>
														<?= daFormatoEdit($data_fields['direccion'], 'direccion', 'Dirección', 'varchar', 'varchar', 1); ?>
														<? if (form_error('direccion') != '') { ?> <span class="help-block"><?= form_error('direccion') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('codigo_postal') != '' ? ' has-error' : '' ?>">
														<label for="codigo_postal">Código Postal <?php echo form_error('codigo_postal') ?></label>
														<?= daFormatoEdit($data_fields['codigo_postal'], 'codigo_postal', 'Código Postal', 'varchar', 'varchar', 1); ?>
														<? if (form_error('codigo_postal') != '') { ?> <span class="help-block"><?= form_error('codigo_postal') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('poblacion') != '' ? ' has-error' : '' ?>">
														<label for="poblacion">Población <?php echo form_error('poblacion') ?></label>
														<?= daFormatoEdit($data_fields['poblacion'], 'poblacion', 'Población', 'varchar', 'varchar', 1); ?>
														<? if (form_error('poblacion') != '') { ?> <span class="help-block"><?= form_error('poblacion') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('provincia') != '' ? ' has-error' : '' ?>">
														<label for="provincia">Provincia <?php echo form_error('provincia') ?></label>
														<?= daFormatoEdit($data_fields['provincia'], 'provincia', 'Provincia', 'varchar', 'varchar', 1); ?>
														<? if (form_error('provincia') != '') { ?> <span class="help-block"><?= form_error('provincia') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('telefono') != '' ? ' has-error' : '' ?>">
														<label for="telefono">Teléfono <?php echo form_error('telefono') ?></label>
														<?= daFormatoEdit($data_fields['telefono'], 'telefono', 'Teléfono', 'varchar', 'varchar', 1); ?>
														<? if (form_error('telefono') != '') { ?> <span class="help-block"><?= form_error('telefono') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('email') != '' ? ' has-error' : '' ?>">
														<label for="email">Email <?php echo form_error('email') ?></label>
														<?= daFormatoEdit($data_fields['email'], 'email', 'Email', 'varchar', 'varchar', 1); ?>
														<? if (form_error('email') != '') { ?> <span class="help-block"><?= form_error('email') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('email_pedidos') != '' ? ' has-error' : '' ?>">
														<label for="email_pedidos">Email Pedidos <?php echo form_error('email_pedidos') ?></label>
														<?= daFormatoEdit($data_fields['email_pedidos'], 'email_pedidos', 'Email Pedidos', 'varchar', 'varchar', 1); ?>
														<? if (form_error('email_pedidos') != '') { ?> <span class="help-block"><?= form_error('email_pedidos') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('franquiciado') != '' ? ' has-error' : '' ?>">
														<label for="franquiciado">Franquiciado <?php echo form_error('franquiciado') ?></label>

														<div class="checkbox checkbox-primary ml-1">
                                                        <?= daFormatoEdit($data_fields['franquiciado'], 'franquiciado', 'Franquiciado', 'tinyint', 'checkbox', 0); ?>
                                                        <label for="franquiciado"></label>
														</div>

														<? if (form_error('franquiciado') != '') { ?> <span class="help-block"><?= form_error('franquiciado') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('propietario') != '' ? ' has-error' : '' ?>">
														<label for="propietario">Propietario <?php echo form_error('propietario') ?></label>
														<?= daFormatoEdit($data_fields['propietario'], 'propietario', 'Propietario', 'varchar', 'varchar', 1); ?>
														<? if (form_error('propietario') != '') { ?> <span class="help-block"><?= form_error('propietario') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('telefono_propietario') != '' ? ' has-error' : '' ?>">
														<label for="telefono_propietario">Teléfono Propietario <?php echo form_error('telefono_propietario') ?></label>
														<?= daFormatoEdit($data_fields['telefono_propietario'], 'telefono_propietario', 'Teléfono Propietario', 'varchar', 'varchar', 1); ?>
														<? if (form_error('telefono_propietario') != '') { ?> <span class="help-block"><?= form_error('telefono_propietario') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('metros_cuadrados') != '' ? ' has-error' : '' ?>">
														<label for="metros_cuadrados">Metros Cuadrados <?php echo form_error('metros_cuadrados') ?></label>
														<?= daFormatoEdit($data_fields['metros_cuadrados'], 'metros_cuadrados', 'Metros Cuadrados', 'smallint', 'int', 0); ?>
														<? if (form_error('metros_cuadrados') != '') { ?> <span class="help-block"><?= form_error('metros_cuadrados') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('aforo') != '' ? ' has-error' : '' ?>">
														<label for="aforo">Aforo <?php echo form_error('aforo') ?></label>
														<?= daFormatoEdit($data_fields['aforo'], 'aforo', 'Aforo', 'smallint', 'int', 0); ?>
														<? if (form_error('aforo') != '') { ?> <span class="help-block"><?= form_error('aforo') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('terraza') != '' ? ' has-error' : '' ?>">
														<label for="terraza">Terraza <?php echo form_error('terraza') ?></label>

														<div class="checkbox checkbox-primary ml-1">
                                                        <?= daFormatoEdit($data_fields['terraza'], 'terraza', 'Terraza', 'tinyint', 'checkbox', 0); ?>
                                                        <label for="terraza"></label>
														</div>
														
														<? if (form_error('terraza') != '') { ?> <span class="help-block"><?= form_error('terraza') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('josper') != '' ? ' has-error' : '' ?>">
														<label for="josper">Josper <?php echo form_error('josper') ?></label>

														<div class="checkbox checkbox-primary ml-1">
                                                        <?= daFormatoEdit($data_fields['josper'], 'josper', 'Josper', 'tinyint', 'checkbox', 0); ?>
                                                        <label for="josper"></label>
														</div>
														
														<? if (form_error('josper') != '') { ?> <span class="help-block"><?= form_error('josper') ?></span> <? } ?>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group<?= form_error('partner_delivery_id') != '' ? ' has-error' : '' ?>">
														<label for="partner_delivery_id">Partner Delivery <?php echo form_error('partner_delivery_id') ?></label>
														<select class="form-control" name="partner_delivery_id" id="partner_delivery_id" required><? foreach ($s_partner_delivery_id as $c) {
																																					?>
																<option value="<?= $c->partner_delivery_id ?>" <?= $c->partner_delivery_id == $data_fields['partner_delivery_id'] ? 'selected="selected"' : '' ?>><?= $c->nombre ?></option>
															<?
																																					} ?></select>
														<? if (form_error('partner_delivery_id') != '') { ?> <span class="help-block"><?= form_error('partner_delivery_id') ?></span> <? } ?>
													</div>
												</div>*/?>

												<div class="col-12">
													<div class="form-group<?= form_error('orden') != '' ? ' has-error' : '' ?>">
														<label for="orden">Orden <?php echo form_error('orden') ?></label>
														<?= daFormatoEdit($data_fields['orden'], 'orden', 'Orden', 'int', 'int', 0); ?>
														<? if (form_error('orden') != '') { ?> <span class="help-block"><?= form_error('orden') ?></span> <? } ?>
													</div>
												</div>
																									

												<div class="col-12">
													<div class="form-group<?= form_error('activo') != '' ? ' has-error' : '' ?>">
														<label for="activo">Activo <?php echo form_error('activo') ?></label>

														<div class="checkbox checkbox-primary ml-1">
                                                        <?= daFormatoEdit($data_fields['activo'], 'activo', 'Activo', 'tinyint', 'checkbox', 0); ?>
                                                        <label for="activo"></label>
														</div>
														
														<? if (form_error('activo') != '') { ?> <span class="help-block"><?= form_error('activo') ?></span> <? } ?>
													</div>
												</div>

												<input type="hidden" name="grupo_id" value="<?php echo $grupo_id; ?>" />
												<div class="col-4 d-flex justify-content-start">

													<a href="<?php echo site_url('privado/grupo') ?>" class="btn btn-light-secondary ml-0"><i class="bx bx-chevrons-left"></i><span class="d-none d-sm-inline-block">Volver</span></a> </div>
												<div class="col-8 d-flex justify-content-end">
												<? 
												if (isset($subtitulo) && $subtitulo != 'Añadir Grupo') {
												?>
													<a href="<?=site_url('privado/usuario-grupo/view/' . $data_fields['grupo_id'])?>" class="btn btn-outline-light mr-2"><i class="bx bx-buildings"></i><span class="d-none d-sm-inline-block">Editar Usuarios</span></a>
												<?
												}
												?>
													<button type="submit" class="btn btn-primary"><?php echo $button ?></button> </div>
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
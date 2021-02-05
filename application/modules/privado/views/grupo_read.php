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
							<?/*
							<h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-building"></i><?= $titulo ?></h4>
							*/?>
                        </div>
                    </div>
                </div>
            </div>

        <div class="content-body">
			<!-- table Transactions start -->
			<section id="table-transactions">
				<div class="row match-height">
					<div class="col-md-12 col-lg-8 col-xl-6 col-12">
						<div class="card">
						    <div class="card-header bg-light-blue">
						        <h4 class="card-title"><?= isset($subtitulo) ? $subtitulo : '' ?>: <?php echo daFormato($data_fields['nombre'], 'varchar', '0-#475F7B', '') ?></h4>
                            </div>
						    <div class="card-content">
						        <div class="card-body pr-0 pl-0">
							        <!-- datatable start -->
							        <div class="table-responsive">
								        <table id="table-extended-transactions" class="table mb-2">

	                                <tr><td class="font-weight-bold">Nombre</td><td><?php echo daFormato($data_fields['nombre'],'varchar','0-#333333','') ?></td></tr>

	                                <?/*<tr><td class="font-weight-bold">CIF</td><td><?php echo daFormato($data_fields['cif'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Sociedad</td><td><?php echo daFormato($data_fields['sociedad'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Dirección</td><td><?php echo daFormato($data_fields['direccion'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Código Postal</td><td><?php echo daFormato($data_fields['codigo_postal'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Población</td><td><?php echo daFormato($data_fields['poblacion'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Provincia</td><td><?php echo daFormato($data_fields['provincia'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Teléfono</td><td><?php echo daFormato($data_fields['telefono'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Email</td><td class="font-xs-smaller"><?php echo daFormato($data_fields['email'],'email','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Email Pedidos</td><td class="font-xs-smaller"><?php echo daFormato($data_fields['email_pedidos'],'email','0-#333333','') ?></td></tr>

									<tr><td class="font-weight-bold">Franquiciado</td>
									<td>
										<?php //echo daFormato($data_fields['franquiciado'],'checkbox','0-#333333','') ?>
										<? if ($data_fields['franquiciado']==1) { ?>
                                                        <span class="badge badge-light-success badge-pill">SÍ</span>
                                                    <? }else{ ?>
                                                        <span class="badge badge-light-danger badge-pill">NO</span>
                                                    <? } ?>
									</td>
									</tr>

	                                <tr><td class="font-weight-bold">Propietario</td><td><?php echo daFormato($data_fields['propietario'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Teléfono Propietario</td><td><?php echo daFormato($data_fields['telefono_propietario'],'varchar','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Metros Cuadrados</td><td><?php echo daFormato($data_fields['metros_cuadrados'],'int','0-#333333','') ?></td></tr>

	                                <tr><td class="font-weight-bold">Aforo</td><td><?php echo daFormato($data_fields['aforo'],'int','0-#333333','') ?></td></tr>

									<tr><td class="font-weight-bold">Terraza</td>
									<td>
										<?php //echo daFormato($data_fields['terraza'],'checkbox','0-#333333','') ?>
										<? if ($data_fields['terraza']==1) { ?>
                                                        <span class="badge badge-light-success badge-pill">SÍ</span>
                                                    <? }else{ ?>
                                                        <span class="badge badge-light-danger badge-pill">NO</span>
                                                    <? } ?>
									</td>
								</tr>

									<tr><td class="font-weight-bold">Josper</td>
									<td>
										<?php //echo daFormato($data_fields['josper'],'checkbox','0-#333333','') ?>
										<? if ($data_fields['josper']==1) { ?>
                                                        <span class="badge badge-light-success badge-pill">SÍ</span>
                                                    <? }else{ ?>
                                                        <span class="badge badge-light-danger badge-pill">NO</span>
                                                    <? } ?>
									</td>
								</tr>

									<tr>
										<td class="font-weight-bold">Partner Delivery</td>
										<td>
										<? foreach($s_partner_delivery_id as $c){
											if($c->partner_delivery_id==$data_fields['partner_delivery_id']){
												echo $c->nombre;
											}
										
										}?>
										</td>
									</tr>*/?>

									<tr><td class="font-weight-bold">Orden</td><td><?php echo daFormato($data_fields['orden'],'int','0-#333333','') ?></td></tr>

									<tr><td class="font-weight-bold">Activo</td>
									<td>
										<?php //echo daFormato($data_fields['activo'],'checkbox','0-#333333','') ?>
										<? if ($data_fields['activo']==1) { ?>
                                                        <span class="badge badge-light-success badge-pill">ACTIVO</span>
                                                    <? }else{ ?>
                                                        <span class="badge badge-light-danger badge-pill">NO ACTIVO</span>
                                                    <? } ?>
									</td>
								</tr>
									
								<?
								if(!empty($usuario_grupo)) {
								?>
									<tr>
										<td class="font-weight-bold">Usuarios</td>
										<td>
											<div class="mr-sm-1 display-inline-block text-right">
											<? 
											$str_usuario_grupo = '<div class="hidden-xs">';
											foreach($usuario_grupo as $ind => $miembro){
												if($ind > 0) {
													$str_usuario_grupo .= '<br>';
												}

												$str_usuario_grupo .= $miembro->rol;
											}
											$str_usuario_grupo .= '</div>';
											echo $str_usuario_grupo;
											?>
											</div>

											<div class="display-inline-block">
											<? 
											$str_usuario_grupo = '';
											foreach($usuario_grupo as $ind => $miembro){
												if($ind > 0) {
													$str_usuario_grupo .= '<br>';
												}

												$str_usuario_grupo .=  $miembro->nombre . ' ' . $miembro->apellidos;
											}
											echo $str_usuario_grupo;
											?>
											</div>
										</td>
									</tr>
								<?
								}
								?>
										
									</table>
							        </div>
							        <div class="row">
							            <div class="col-4 d-flex justify-content-start">
											<a href="<?php echo site_url('privado/grupo') ?>" class="btn btn-light-secondary ml-1 ml-sm-2 mb-1"><i class="bx bx-chevrons-left"></i><span class="d-none d-sm-inline-block">Volver</span></a>							            
										</div>
									<?
									if(modules::run('security/check_admin')) {
									?>
							            <div class="col-8 d-flex justify-content-end">
											<a href="<?=site_url('privado/usuario-grupo/view/' . $data_fields['grupo_id'])?>" class="btn btn-outline-light mr-1 mb-1"><i class="bx bx-buildings"></i><span class="d-none d-sm-inline-block">Editar Usuarios</span></a>
											<a href="<?php echo site_url('privado/grupo/update/' . $data_fields['grupo_id']) ?>" class="btn btn-success mr-1 mb-1"><i class="bx bx-edit"></i><span class="d-none d-sm-inline-block">Editar</span></a>								            <a href="<?php echo site_url('privado/grupo/delete/' . $data_fields['grupo_id']) ?>" onclick="javascript: return confirm('Seguro que deseas eliminar este usuario?')" class="btn btn-danger mr-1 mr-sm-2 mb-1"><i class="bx bx-trash"></i></a>							            
										</div>
									<?
									}
									?>
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

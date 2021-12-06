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
	<section id="basic-vertical-layouts">
		<div class="row match-height">
			<div class="col-md-6 col-12">
				<div class="card">
					<? if (isset($subtitulo) && $subtitulo=='Añadir Contacto') {
					    $bg_card="bg-info";
					    $dots="";
					} else{
					    $bg_card="bg-success";
					    $dots=": ";
					}?>
					<div class="card-header <?=$bg_card?> mb-2">
                    <h4 class="card-title"><?php isset($subtitulo) ? $subtitulo : '' ?><?php $dots;?> <?php echo daFormato($data_fields['contacto_nombre'], 'varchar', '0-#475F7B', '') ?> </h4>
					</div>
					<div class="card-content">
						<div class="card-body card-body-xs">
						<? if(isset($data_fields)) extract($data_fields); //Provisional ?>

						    <form class="form form-vertical form-edit" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">
						        <div class="form-body">
						            <div class="row">

                                    <div class="col-12">

                                                <!-- nombre -->
                                                <div class="form-group<?= form_error('contacto_nombre') != '' ? ' has-error' : '' ?>">
                                                        <label for="contacto_nombre">Nombre <?php echo form_error('contacto_nombre') ?></label>
                                                        <?= daFormatoEdit($data_fields['contacto_nombre'], 'contacto_nombre', 'Nombre', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('contacto_nombre') != '') { ?> <span class="help-block"><?= form_error('contacto_nombre') ?></span> <? } ?>
                                                    </div>
                                                </div>

                                                <!-- telefono -->
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('telefono') != '' ? ' has-error' : '' ?>">
                                                        <label for="contacto_telefono">Teléfono <?php echo form_error('contacto_telefono') ?></label>
                                                        <?= daFormatoEdit($data_fields['contacto_telefono'], 'contacto_telefono', 'Teléfono', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('contacto_telefono') != '') { ?> <span class="help-block"><?= form_error('contacto_telefono') ?></span> <? } ?>
                                                    </div>
                                                </div>

                                                <!-- foto -->
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('foto') != '' ? ' has-error' : '' ?>">
                                                        <label for="foto">Foto <?php echo form_error('foto') ?></label> <br>
                                                        <input type="file" name="foto" class="form-control"/>
                                                        <? if (isset($data_fields['foto'])) {
                                                                echo $data_fields['foto'];
                                                        } ?>
                                                       
                                                        <? if (form_error('foto') != '') { ?> <span class="help-block"><?= form_error('foto') ?></span> <? } ?>
                                                    </div>
                                                </div>

                                                <!-- provincias -->
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('provincia') != '' ? ' has-error' : '' ?>">
                                                        <label for="provincia">Provincia <?php echo form_error('provincia') ?></label>
                                                        <div class="controls">
                                                            
                                                            <select name="provincia" id="provincia" 
                                                                class="form-control simple-select " data-minimum-results-for-search="Infinity">
                                                                
                                                                <?php foreach ($provincias as $provincia) { ?>

                                                                    <option value="<?php echo $provincia->nombre; ?>" 
                                                                        <? if ($provincia->nombre == $data_fields['provincia']){ ?>
                                                                            selected> 
                                                                        <? }else{ ?>
                                                                            > 
                                                                        <? }; ?>
                                                                    <?= $provincia->nombre; ?></option>
                                                                <? }; ?>
                                                                    
                                                            </select>

                                                        </div>
                                                        <? if (form_error('provincia') != '') { ?> <span class="help-block"><?= form_error('provincia') ?></span> <? } ?>
                                                    </div>
                                                </div>

                                                <!--sexo-->
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('sexo') != '' ? ' has-error' : '' ?>">
                                                        <label for="sexo">Sexo<?php echo form_error('sexo') ?></label>
                                                        
                                                        <?php
                                                        $sexos = array(
                                                        ('Hombre'),
                                                        ('Mujer'),
                                                        );?>

                                                        <?php foreach ($sexos as $key => $val){   ?>
                                                            <div>
                                                                <label for="sexo"> <?= $key==0 ? "Hombre" : "Mujer" ?> </label>
                                                                <input type="radio" id="sexo" name="sexo" value="<?php echo $key; ?>" 
                                                                <?php if ($key==$data_fields['sexo']){ ?>
                                                                    checked>
                                                                <?php }else { ?>
                                                                    >
                                                                <?php } ?>
                                                            </div>
                                                        <? } ?>

                                                        <? if (form_error('sexo') != '') { ?> <span class="help-block"><?= form_error('sexo') ?></span> <? } ?>
                                                    </div>
                                                </div>

                                                <!-- fecha de nacimiento -->
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('fechaNacimiento') != '' ? ' has-error' : '' ?>">
                                                        <label for="fechaNacimiento">Fecha Nacimiento<?php echo form_error('fechaNacimiento') ?></label>
                                                        
                                                        <!-- <input id="fechaNacimiento" type="date" value=" " placeholder="dd/mm/yyyy"> -->

                                                        <?= daFormatoEdit($data_fields['fechaNacimiento'], 'fechaNacimiento', 'Fecha', 'date', 'date', 0); ?>

                                    

                                                        <? if (form_error('fechaNacimiento') != '') { ?> <span class="help-block"><?= form_error('fechaNacimiento') ?></span> <? } ?>
                                                    </div>
                                                </div>

                                                <!-- contacto activo/no activo -->
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group<?php form_error('contacto_activo') != '' ? ' has-error' : '' ?>">
                                                        <label for="contacto_activo">Activo <?php echo form_error('contacto_activo') ?></label>
                                                         
                                                        <label for="contacto_activo"></label>
                                                        <?= daFormatoEdit($data_fields['contacto_activo'], 'contacto_activo', 'Activo', 'tinyint', 'checkbox', 0); ?>
                                                        
                                                        <?php if (form_error('contacto_activo') != '') { ?> <span class="help-block"><?php form_error('contacto_activo') ?></span> <?php } ?>
                                                    </div>
                                                </div>

	                                <input type="hidden" name="contacto_id" value="<?php echo $contacto_id; ?>" /> 						            
                                    <div class="col-6 d-flex justify-content-start">

	                                    <a href="<?php echo site_url('contactos/contactoscontroller') ?>" class="btn btn-light-secondary ml-0"><i class="bx bx-chevrons-left"></i>Volver</a>						            </div>
						            <div class="col-6 d-flex justify-content-end">

	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 						            </div>
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
</div>
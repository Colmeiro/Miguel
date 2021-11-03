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
                        <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $titulo ?></h4>
                        */?>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

        <!-- botón volver -->
        
            <a href="<?php echo site_url('privado/contacto') ?>" class="btn btn-light-secondary ml-0"><i class="bx bx-chevrons-left"></i>Volver</a> 
        

            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <? if (isset($subtitulo) && $subtitulo=='Añadir Contacto') {
                                //$bg_card="bg-light-blue";
                                $bg_card="bg-light-blue";
                                $dots="";
                            } else{
                                $bg_card="bg-light-green";
                                $dots=": ";
                            }?>
                            <div class="card-header <?php $bg_card?> mb-2">
                                <h4 class="card-title"><?php isset($subtitulo) ? $subtitulo : '' ?><?php $dots;?> <?php echo daFormato($data_fields['contacto_nombre'], 'varchar', '0-#475F7B', '') ?> </h4>
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
                                                        <?= daFormatoEdit($data_fields['contacto_nombre'], 'nombre', 'Nombre', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('nombre') != '') { ?> <span class="help-block"><?= form_error('nombre') ?></span> <? } ?>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('telefono') != '' ? ' has-error' : '' ?>">
                                                        <label for="apellidos">Teléfono <?php echo form_error('telefono') ?></label>
                                                        <?= daFormatoEdit($data_fields['contacto_telefono'], 'telefono', 'Teléfono', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('telefono') != '') { ?> <span class="help-block"><?= form_error('telefono') ?></span> <? } ?>
                                                    </div>
                                                </div>
                                                <!-- <?/*<div class="col-12">
                                                    <div class="form-group<?= form_error('dni') != '' ? ' has-error' : '' ?>">
                                                        <label for="dni">DNI <?php echo form_error('dni') ?></label>
                                                        <?= daFormatoEdit($data_fields['dni'], 'dni', 'Dni', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('dni') != '') { ?> <span class="help-block"><?= form_error('dni') ?></span> <? } ?>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('ciudad') != '' ? ' has-error' : '' ?>">
                                                        <label for="ciudad">Ciudad <?php echo form_error('ciudad') ?></label>
                                                        <?= daFormatoEdit($data_fields['ciudad'], 'ciudad', 'Ciudad', 'varchar', 'varchar', 1); ?>
                                                        <? if (form_error('ciudad') != '') { ?> <span class="help-block"><?= form_error('ciudad') ?></span> <? } ?>
                                                    </div>
                                                </div>*/?> -->
                                                <!-- <div class="col-12">
                                                    <div class="form-group<?= form_error('email') != '' ? ' has-error' : '' ?>">
                                                        <label for="email">Email <?php echo form_error('email') ?></label>
                                                        <?= daFormatoEdit($data_fields['email'], 'email', 'Email', 'varchar', 'email', 1); ?>
                                                        <? if (form_error('email') != '') { ?> <span class="help-block"><?= form_error('email') ?></span> <? } ?>
                                                    </div>
                                                </div> -->
                                                <?
                                                if (strpos($action, 'create_action') !== FALSE) {
                                                ?>
                                                    <!-- <div class="col-12">
                                                        <div class="form-group<?= form_error('password') != '' ? ' has-error' : '' ?>">
                                                            <label for="password">Password <?php echo form_error('password') ?></label>
                                                            <?= daFormatoEdit($data_fields['password'], 'password', 'Password', 'varchar', 'password', 1); ?>
                                                            <? if (form_error('password') != '') { ?> <span class="help-block"><?= form_error('password') ?></span> <? } ?>
                                                        </div>
                                                    </div> -->
                                                <?
                                                }
                                                ?>
                                                <!-- <div class="col-12">
                                                    <div class="form-group<?= form_error('rol_id') != '' ? ' has-error' : '' ?>">
                                                        <label for="rol_id">Rol <?php echo form_error('rol_id') ?></label>
                                                        <select class="form-control" name="rol_id" id="rol_id" required><? foreach ($s_rol_id as $c) {
                                                                                                                        ?>
                                                                <option value="<?= $c->rol_id ?>" <?= $c->rol_id == $data_fields['rol_id'] ? 'selected="selected"' : '' ?>><?= $c->nombre ?></option>
                                                            <?
                                                                                                                        } ?></select>
                                                        <? if (form_error('rol_id') != '') { ?> <span class="help-block"><?= form_error('rol_id') ?></span> <? } ?>
                                                    </div> -->
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('activo') != '' ? ' has-error' : '' ?>">
                                                        <label for="activo">Activo <?php echo form_error('activo') ?></label>

                                                        <div class="checkbox checkbox-primary ml-1">
                                                        <?= daFormatoEdit($data_fields['contacto_activo'], 'activo', 'Activo', 'tinyint', 'checkbox', 0); ?>
                                                        <label for="contacto_activo"></label>
                                                        </div>
                                                        
                                                        <? if (form_error('contacto_activo') != '') { ?> <span class="help-block"><?= form_error('contacto_activo') ?></span> <? } ?>
                                                    </div>
                                                </div>
                                                <!-- <?/*<div class="col-12">
                                                    <div class="form-group<?= form_error('orden') != '' ? ' has-error' : '' ?>">
                                                        <label for="orden">Orden <?php echo form_error('orden') ?></label>
                                                        <?= daFormatoEdit($data_fields['orden'], 'orden', 'Orden', 'int', 'int', 0); ?>
                                                        <? if (form_error('orden') != '') { ?> <span class="help-block"><?= form_error('orden') ?></span> <? } ?>
                                                    </div>
                                                </div>*/?> -->

                                                <input type="hidden" name="contacto_id" value="<?php echo $data_fields['contacto_id']; ?>" />


                                                

                                                    <div class="col-6 d-flex" style="text-align:left;">
                                                        <button type="submit" action="<?php echo site_url('privado/contacto/update' . $data_fields['contacto_id']); ?>" method="post" class="btn btn-primary"><?php echo $button ?></button>
                                                    </div>

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
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
                        <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-buildings"></i><?= $titulo ?></h4>
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
                            <? if (isset($subtitulo) && $subtitulo == 'Añadir Usuario a Grupo') {
                                $bg_card = "bg-light-blue";
                                $dots = "";
                            } else {
                                $bg_card = "bg-light-green";
                                $dots = "";
                            } ?>
                            <div class="card-header <?= $bg_card ?> mb-2">
                                <h4 class="card-title"><?= isset($subtitulo) ? $subtitulo : '' ?><?= $dots; ?></h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-body-xs">
                                    <? if (isset($data_fields)) extract($data_fields); //Provisional 
                                    ?>

                                    <form class="form form-vertical form-edit" action="<?php echo $action; ?>" method="post">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('grupo_id') != '' ? ' has-error' : '' ?>">
                                                        <label for="grupo_id">Grupo <?php echo form_error('grupo_id') ?></label>
                                                        <select class="form-control" name="grupo_id" id="grupo_id" required><? foreach ($s_grupo_id as $c) {
                                                                                                                                ?>
                                                                <option value="<?= $c->grupo_id ?>" <?= ($c->grupo_id == $data_fields['grupo_id']) || (empty($data_fields['grupo_id']) && $c->grupo_id == $grupo_id_def) ? 'selected="selected"' : '' ?>><?= $c->nombre ?></option>
                                                            <?
                                                                                                                                } ?></select>
                                                        <? if (form_error('grupo_id') != '') { ?> <span class="help-block"><?= form_error('grupo_id') ?></span> <? } ?>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group<?= form_error('usuario_id') != '' ? ' has-error' : '' ?>">
                                                        <label for="usuario_id">Usuario <?php echo form_error('usuario_id') ?></label>
                                                        <select class="form-control" name="usuario_id" id="usuario_id" required>
                                                        <? 
                                                        foreach ($s_usuario_id as $c) {
                                                        ?>
                                                                <option value="<?= $c->usuario_id ?>" <?= $c->usuario_id == $data_fields['usuario_id'] ? 'selected="selected"' : '' ?>><?= $c->nombre ?></option>
                                                        <?
                                                        } 
                                                        ?>
                                                        </select>
                                                        <? if (form_error('usuario_id') != '') { ?> <span class="help-block"><?= form_error('usuario_id') ?></span> <? } ?>
                                                    </div>
                                                </div>
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

                                                <input type="hidden" name="usuario_grupo_id" value="<?php echo $usuario_grupo_id; ?>" />
                                                <div class="col-6 d-flex justify-content-start">

                                                    <a href="<?php echo site_url('privado/usuario-grupo' . $url_plus) ?>" class="btn btn-light-secondary ml-0"><i class="bx bx-chevrons-left"></i>Volver</a> </div>
                                                <div class="col-6 d-flex justify-content-end">

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
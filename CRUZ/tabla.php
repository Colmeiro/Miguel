<?php
// error_reporting(0);
require_once 'core/CRUZcode.php';
require_once 'core/helper.php';
require_once 'core/process.php';

// key: es lo que envia/guarda
//valor: lo que se muestra en el select
// tipos: tipos de campos mysql alos que se le sugiere este formato/tipo
$formatos = array(
    array('key' => '', 'valor' => 'Selecionar formato', 'tipos' => array()),
    array('key' => 'varchar', 'valor' => 'Cadena de texto', 'tipos' => array('varchar', 'char')),
    array('key' => 'text', 'valor' => 'Texto largo', 'tipos' => array('text', 'tinytext', 'mediumtext', 'longtext')),
    array('key' => 'html', 'valor' => 'Html', 'tipos' => array()),
    array('key' => 'html_ver', 'valor' => 'Html con ver en listado', 'tipos' => array()),
    array('key' => 'int', 'valor' => 'Número entero', 'tipos' => array('int', 'smallint', 'mediumint')),
    array('key' => 'decimal', 'valor' => 'Número decimal', 'tipos' => array('decimal', 'float', 'double')),
    array('key' => 'currency', 'valor' => 'Moneda', 'tipos' => array()),
    array('key' => 'percent', 'valor' => 'Porcentaje', 'tipos' => array()),
    array('key' => 'date', 'valor' => 'Fecha', 'tipos' => array('date')),
    array('key' => 'datetime', 'valor' => 'Fecha-Hora', 'tipos' => array('datetime')),
    array('key' => 'time', 'valor' => 'Hora', 'tipos' => array('time')),
    array('key' => 'link', 'valor' => 'Enlace', 'tipos' => array()),
    array('key' => 'link_ver', 'valor' => 'Enlace Ver', 'tipos' => array()),
    array('key' => 'link_sufijo', 'valor' => 'Enlace con sufijo', 'tipos' => array()),
    array('key' => 'email', 'valor' => 'Email', 'tipos' => array()),
    array('key' => 'email_ver', 'valor' => 'Email Ver', 'tipos' => array()),
    array('key' => 'checkbox', 'valor' => 'Checkbox', 'tipos' => array('tinyint')),
    array('key' => 'password', 'valor' => 'Password', 'tipos' => array()),
    array('key' => 'readonly', 'valor' => 'Readonly', 'tipos' => array()),
    array('key' => 'color', 'valor' => 'Color', 'tipos' => array()),
    array('key' => 'file', 'valor' => 'File - Archivo', 'tipos' => array()),
    array('key' => 'file_image', 'valor' => 'File - Imagen', 'tipos' => array()),
    array('key' => 'relacionado', 'valor' => 'Campo relacionado', 'tipos' => array()),
);
$tiposderecha = array('decimal', 'float', 'double', 'int', 'smallint', 'mediumint');

$tabla = $_POST['table_name'];

$datacfg = readJSON('project/' . $tabla . '.cfg');

$tengodatos = $datacfg ? 1 : 0;
// echo '<pre>';
// var_dump($datacfg->label);
// echo '</pre>';

$campos = $hc->not_primary_field($tabla);
$pk = $hc->primary_field($tabla);
?>
<style>
    .labelnormal {
        font-weight: normal
    }

    .labelrelacion {
        width: 80px;
    }
</style>
<form id="campostable" action="index.php" method="POST">
    <input type="hidden" name="table_name" value="<?= $tabla ?>" />
    <div class="card card-default mb-4">
        <div class="card-header">Tabla: <?= $tabla ?></div>
    </div>
    <div class="card card-default mb-4">
        <div class="card-header">Configuraciones</div>
        <div class="card-body">
            <div class="form-group">
                <?php $tipo_creacion = isset($datacfg->tipo_creacion) ? $datacfg->tipo_creacion : 'modulo'; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="controller" class="control-label">Tipo de creación</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-check-inline" style="margin-bottom: 0px; margin-top: 0px">
                            <label class="form-check-label">
                                <input type="radio" name="tipo_creacion" value="modulo" class="form-check-input" <?php echo $tipo_creacion == 'modulo' ? 'checked' : ''; ?>>
                                <span class="check"></span>
                                Módulo
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-check-inline" style="margin-bottom: 0px; margin-top: 0px">
                            <label class="form-check-label">
                                <input type="radio" name="tipo_creacion" value="normal" class="form-check-input" <?php echo $tipo_creacion == 'normal' ? 'checked' : ''; ?>>
                                <span class="check"></span>
                                Normal
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="controller" class="control-label"><b>Nombre Controlador</b></label>
                        <input type="text" id="controller" name="controller" value="<?= isset($datacfg->controller) ? $datacfg->controller : ucfirst($tabla) ?>" class="form-control" placeholder="Nombre Controlador" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="model" class="control-label"><b>Nombre Modelo</b></label>
                        <input type="text" id="model" name="model" value="<?= isset($datacfg->model) ? $datacfg->model : ucfirst($tabla) . '_model' ?>" class="form-control" placeholder="Nombre Modelo" />
                        <span class="help-block">*No puede ser igual al del controlador.</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="model" class="control-label"><b>Nombre Módulo</b></label>
                        <input type="text" id="modulo" name="modulo" value="<?= isset($datacfg->modulo) ? $datacfg->modulo : $tabla ?>" class="form-control" placeholder="Nombre Módulo" />
                    </div>
                </div>                
            </div>
            <!-- <input type="hidden" name="jenis_tabel" value="datatables"> -->

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="extrawhere" class="control-label text-left">Condición extra</label>
                        <input type="text" name="extrawhere" class="form-control" id="extrawhere" placeholder="" value="<?= isset($datacfg->extrawhere) ? htmlentities($datacfg->extrawhere) : '' ?>">
                        <span class="help-block">*En las condiciones utilizar <em><strong>nombretabla.nombrecampo</strong></em> sin WHERE.</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="titulo" class="control-label text-left">Título</label>
                        <input type="text" name="titulo" class="form-control" id="titulo" placeholder="<?= $tabla ?>" value="<?= isset($datacfg->titulo) ? $datacfg->titulo : $tabla ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="objeto" class="control-label text-left">Nombre Objeto</label>
                        <input type="text" name="objeto" class="form-control" id="objeto" placeholder="<?= $tabla ?>" value="<?= isset($datacfg->objeto) ? $datacfg->objeto : $tabla ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Acciones disponibles:</label>
                        <br>
                        <!-- <div class="form-group"> -->
                        <!-- <div class="checkbox"> -->
                        <?php $action_add = isset($datacfg->action_add) ? $datacfg->action_add : ''; ?>
                        <label class="labelnormal col-md-1 form-check-label">
                            <input type="checkbox" name="action_add" value="1" <?php echo $action_add == '1' ? 'checked' : '' ?>>
                            <span class="check"></span>
                            Añadir
                        </label>
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="form-group"> -->
                        <!-- <div class="checkbox"> -->
                        <?php $action_edit = isset($datacfg->action_edit) ? $datacfg->action_edit : ''; ?>
                        <label class="labelnormal col-md-1 form-check-label">
                            <input type="checkbox" name="action_edit" value="1" <?php echo $action_edit == '1' ? 'checked' : '' ?>>
                            <span class="check"></span>
                            Editar
                        </label>
                        <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="form-group"> -->
                        <!-- <div class="checkbox"> -->
                        <?php $action_del = isset($datacfg->action_del) ? $datacfg->action_del : ''; ?>
                        <label class="labelnormal col-md-1 form-check-label">
                            <input type="checkbox" name="action_del" value="1" <?php echo $action_del == '1' ? 'checked' : '' ?>>
                            <span class="check"></span>
                            Eliminar
                        </label>
                        <!-- </div> -->
                        <!-- </div> -->

                        <!-- <div class="form-group"> -->
                        <!-- <div class="checkbox"> -->
                        <?php $export_excel = isset($datacfg->export_excel) ? $datacfg->export_excel : ''; ?>
                        <label class="labelnormal col-md-2 form-check-label">
                            <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                            <span class="check"></span>
                            Exportar a Excel
                        </label>
                        <!-- </div> -->
                        <!-- </div>     -->

                        <!-- <div class="form-group"> -->
                        <!-- <div class="checkbox"> -->
                        <?php $export_word = isset($datacfg->export_word) ? $datacfg->export_word : ''; ?>
                        <label class="labelnormal col-md-2 form-check-label">
                            <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                            <span class="check"></span>
                            Exportar a Word
                        </label>
                        <!-- </div> -->
                        <!-- </div>   -->
                    </div>
                    <div class="clear"><br></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numregistros" class="control-label text-left">Num. registros por página</label>
                        <select name="numregistros" id="numregistros" class="form-control">
                            <option value="10" <?= isset($datacfg->numregistros) && $datacfg->numregistros == 10 ? 'selected="selected"' : '' ?>>10</option>
                            <option value="25" <?= isset($datacfg->numregistros) && $datacfg->numregistros == 25 ? 'selected="selected"' : '' ?>>25</option>
                            <option value="50" <?= isset($datacfg->numregistros) && $datacfg->numregistros == 50 ? 'selected="selected"' : '' ?>>50</option>
                            <option value="100" <?= isset($datacfg->numregistros) && $datacfg->numregistros == 100 ? 'selected="selected"' : '' ?>>100</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <?php $jenis_tabel = isset($datacfg->jenis_tabel) ? $datacfg->jenis_tabel : 'reguler_table'; ?>
                    <div class="col-md-3">
                        <div class="form-check form-check-inline" style="margin-bottom: 0px; margin-top: 0px">
                            <label class="form-check-label">
                                <input type="radio" name="jenis_tabel" value="reguler_table" class="form-check-input" <?php echo $jenis_tabel == 'reguler_table' ? 'checked' : ''; ?>>
                                <span class="check"></span>
                                Bootstrap Table
                            </label>

                            <label class="form-check-label">
                                <input type="radio" name="jenis_tabel" value="datatables" class="form-check-input" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                                <span class="check"></span>
                                Datatables
                            </label>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                <label class="form-check-label">
                    <input type="radio" name="jenis_tabel" value="datatables" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                    <span class="check"></span>
                    Serverside Datatables
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                <label class="form-check-label">
                    <input type="radio" name="jenis_tabel" value="footables" <?php echo $jenis_tabel == 'footables' ? 'checked' : ''; ?>>
                    <span class="check"></span>
                    Footables
                </label>
            </div>
        </div> -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <?php $datacfg->template = isset($datacfg->template) ? $datacfg->template : ''; ?>
                    <div class="form-group">
                        <label for="template" class="control-label text-left">Template</label>
                        <select name="template" id="template" class="form-control">
                            <option value="" <?= isset($datacfg->template) && $datacfg->template == '' ? 'selected="selected"' : '' ?>>Frest</option>
                            <?/* <option value="adminlte" <?= isset($datacfg->template) && $datacfg->template == 'adminlte' ? 'selected="selected"' : '' ?>>AdminLTE</option>
                <option value="gentelella" <?= isset($datacfg->template) && $datacfg->template == 'gentelella' ? 'selected="selected"' : '' ?>>Gentelella</option> */?>
                        </select>

                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="estilo" class="control-label text-left">Estilo</label>
                        <select name="estilo" id="estilo" class="form-control">
                            <option value="" <?= isset($datacfg->estilo) && $datacfg->estilo == '' ? 'selected="selected"' : '' ?>>Estilo por defecto</option>
                            <?/*<option value="estilo1" <?= isset($datacfg->estilo) && $datacfg->estilo == 'estilo1' ? 'selected="selected"' : '' ?>>Estilo 1</option>*/?>
                        </select>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="posicion_botones" class="control-label text-left">Posición Botones Acciones</label>
                        <select name="posicion_botones" id="posicion_botones" class="form-control">
                            <option value="izquierda" <?= isset($datacfg->posicion_botones) && $datacfg->posicion_botones == 'izquierda' ? 'selected="selected"' : '' ?>>Izquierda</option>
                            <option value="derecha" <?= isset($datacfg->posicion_botones) && $datacfg->posicion_botones == 'derecha' ? 'selected="selected"' : '' ?>>Derecha</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="formato_botones" class="control-label text-left">Botones iconos o texto</label>
                        <select name="formato_botones" id="formato_botones" class="form-control">
                            <option value="iconos" <?= isset($datacfg->formato_botones) && $datacfg->formato_botones == 'iconos' ? 'selected="selected"' : '' ?>>Iconos</option>
                            <option value="texto" <?= isset($datacfg->formato_botones) && $datacfg->formato_botones == 'texto' ? 'selected="selected"' : '' ?>>Texto</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Generar" name="generate" class="btn btn-primary" onclick="javascript: return confirm('Se van a sobreescribir los archivos existentes. Continuamos?')" />
                    <input type="submit" value="Guardar" name="save" class="btn btn-primary" />
                    <div class="clear"><br></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-default mb-4">
        <div class="card-header">Campos</div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <!-- <tr>
        <td>Label</td>
        <td>Campo </td>
        <td class="text-center">Orden</td>
        <td colspan="5"></td>
        <td></td>
    </tr> -->
                    <tr></tr>
                    <tr class="active">
                        <td></td>

                        <td></td>
                        <td></td>
                        <td class="text-center" colspan="3">Listado</td>
                        <td class="text-center" colspan="3">Edición</td>
                        <!-- <td></td> -->
                    </tr>
                    <tr class="active">

                        <td>Label</td>
                        <td>Tipo</td>
                        <td>Formato</td>
                        <td class="text-center">Orden</td>

                        <td class="text-center"><input type="checkbox" id="checkalllist" checked="checked" /></td>
                        <td class="text-center">Pos.</td>
                        <td class="text-center"><input type="checkbox" id="checkalledit" checked="checked" /></td>
                        <td class="text-center">Pos.</td>
                        <td class="text-center">Req.</td>
                        <!-- <td>Subida fichero</td> -->
                    </tr>

                    <tr>
                        <td>
                            <label><?= $pk ?> <em>(campo key)</em></label>
                            <input class="form-control labelcampos" type="text" name="label_key" value="<?= isset($datacfg->label_key) ? $datacfg->label_key : ucfirst($pk) ?>" /></td>
                        <td></td>
                        <td>
                            <select name="formato_campo_alineacion_key">
                                <option value="left" <?= (isset($datacfg->formato_campo_alineacion_key) && $datacfg->formato_campo_alineacion_key == 'left') || !isset($datacfg->formato_campo_alineacion_key) ? 'selected="selected"' : '' ?>>Izquierda</option>
                                <option value="center" <?= isset($datacfg->formato_campo_alineacion_key) && $datacfg->formato_campo_alineacion_key == 'center' ? 'selected="selected"' : '' ?>>Centrado</option>
                                <option value="right" <?= (isset($datacfg->formato_campo_alineacion_key) && $datacfg->formato_campo_alineacion_key == 'right') ? 'selected="selected"' : '' ?>>Derecha</option>

                            </select>
                            <br>
                            <label><input type="checkbox" name="formato_campo_bold[<?= $pk ?>]" value="<?= $pk ?>" <?= isset($datacfg->formato_campo_bold->$pk) ? 'checked' : '' ?> /> Negrita</label>
                            <input class="form-control" style="width:100px !important" type="color" name="formato_campo_color[<?= $pk ?>]" value="<?= isset($datacfg->formato_campo_color->$pk) ? $datacfg->formato_campo_color->$pk : '#333333' ?>" />
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="orden_list[<?= $pk ?>]" class="selectcheckbox_ordenlist" value="<?= $pk ?>" <?= isset($datacfg->orden_list->$pk) ? 'checked' : '' ?> />
                            <select name="ordendirection_list[<?= $pk ?>]" class="selectcheckbox_ordendirectionlist">
                                <option value="desc" <?= isset($datacfg->ordendirection_list->$pk) && $datacfg->ordendirection_list->$pk == 'desc' ? 'selected="selected"' : '' ?>>DESC</option>
                                <option value="asc" <?= isset($datacfg->ordendirection_list->$pk) && $datacfg->ordendirection_list->$pk == 'asc' ? 'selected="selected"' : '' ?>>ASC</option>
                            </select>
                        </td>
                        <td colspan="4">
                            <label class="labelnormal">
                                <input type="checkbox" name="show_key" value="1" <?= isset($datacfg->show_key) ? 'checked="checked"' : '' ?>>
                                Mostrar ID en listado
                            </label>
                        </td>
                        <td></td>
                    </tr>

                    <?php //var_dump($campos);
                    $i = 0;
                    foreach ($campos as $c) {
                        if(isset($c['column_name'])){
                        ?>
                        <tr>
                            <td>
                                <label><?= $c['column_name'] ?> <em>(<?= $c['data_type'] ?>)</em></label>
                                <input class="form-control labelcampos" type="text" name="label[<?php echo $c['column_name'] ?>]" value="<?php echo isset($datacfg->label->{$c['column_name']}) ? $datacfg->label->{$c['column_name']} : limpialabel(ucfirst($c['column_name'])) ?>" /></td>
                            <td>
                                <select name="type_format[<?= $c['column_name'] ?>]" class="form-control select_formatos">
                                    <?php
                                    foreach ($formatos as $f) {
                                    ?>
                                        <option value="<?= $f['key'] ?>" <?=
                                                                            (isset($datacfg->type_format->{$c['column_name']}) && $datacfg->type_format->{$c['column_name']} == $f['key'])
                                                                                || ((!isset($datacfg->type_format->{$c['column_name']}) || isset($datacfg->type_format->{$c['column_name']}) && $datacfg->type_format->{$c['column_name']} == '') && in_array($c['data_type'], $f['tipos'])) ? 'selected="selected"' : '' ?>><?= $f['valor'] ?></option>
                                    <?php
                                    };
                                    ?>
                                </select>
                                <input type="hidden" name="relacion[<?php echo $c['column_name'] ?>]" class="relacioncheckbox" data-valor-campo="<?php echo $c['column_name'] ?>" value="<?php echo isset($datacfg->relacion->{$c['column_name']}) ? $c['column_name'] : '' ?>" <?php echo isset($datacfg->relacion->{$c['column_name']}) ? 'checked' : '' ?> />
                                <div class="form-inline" <?= empty($datacfg->relacion_tabla->{$c['column_name']}) ? 'style="display:none"' : '' ?>>
                                    <div class="div_select_relacion_tabla form-group">
                                        <label class="labelrelacion">Tabla : </label>
                                        <select name="relacion_tabla[<?= $c['column_name'] ?>]" <?= isset($datacfg->relacion_tabla->{$c['column_name']}) ? '' : 'disabled' ?> class="select_relacion_tabla form-control" style="margin-top:5px">
                                            <option value="">Selecciona tabla</option>
                                            <?php
                                            $table_list = $hc->table_list();
                                            $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                                            foreach ($table_list as $table) {
                                                ?>
                                                <option value="<?php echo $table['table_name'] ?>" <?= isset($datacfg->relacion_tabla->{$c['column_name']}) &&  $datacfg->relacion_tabla->{$c['column_name']} == $table['table_name'] ? 'selected="selected"' : ''; ?>><?php echo $table['table_name'] ?></option>
                                            <?php
                                            };
                                            ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="div_select_relacion_tabla_campo form-group">
                                        <label class="labelrelacion">Relación :</label>
                                        <select name="relacion_tabla_campo[<?= $c['column_name'] ?>]" <?= isset($datacfg->relacion_tabla_campo->{$c['column_name']}) ? '' : 'disabled' ?> class="select_relacion_tabla_campo form-control" style="margin-top:5px">
                                            <!-- <option value="">Campo Relación</option> -->
                                            <?php
                                            if ($datacfg->relacion_tabla_campo->{$c['column_name']}) {
                                                $camposrel = $hc->all_field($datacfg->relacion_tabla->{$c['column_name']});
                                                foreach ($camposrel as $crel) {
                                                    ?>
                                                    <option value='<?= $crel['column_name'] ?>' <?= $datacfg->relacion_tabla_campo->{$c['column_name']} == $crel['column_name'] ? 'selected="selected"' : '' ?>><?= $crel['column_name'] ?></option>
                                                <?php
                                            };
                                        };
                                        ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="div_select_relacion_tabla_campo_mostrar form-group">
                                        <label class="labelrelacion">Mostrar : </label>
                                        <select name="relacion_tabla_campo_mostrar[<?= $c['column_name'] ?>]" <?= isset($datacfg->relacion_tabla_campo_mostrar->{$c['column_name']}) ? '' : 'disabled' ?> class="select_relacion_tabla_campo_mostrar form-control" style="margin-top:5px">
                                            <!-- <option value="">Campo a mostrar</option> -->
                                            <?php
                                            if ($datacfg->relacion_tabla_campo_mostrar->{$c['column_name']}) {
                                                $camposrel = $hc->all_field($datacfg->relacion_tabla->{$c['column_name']});
                                                foreach ($camposrel as $crel) {
                                                    ?>
                                                    <option value='<?= $crel['column_name'] ?>' <?= $datacfg->relacion_tabla_campo_mostrar->{$c['column_name']} == $crel['column_name'] ? 'selected="selected"' : '' ?>><?= $crel['column_name'] ?></option>
                                                <?php
                                            };
                                        };
                                        ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="div_select_relacion_tabla_campo_orden form-group">
                                        <label class="labelrelacion">Orden : </label>
                                        <select name="relacion_tabla_campo_orden[<?= $c['column_name'] ?>]" <?= isset($datacfg->relacion_tabla_campo_orden->{$c['column_name']}) ? '' : 'disabled' ?> class="select_relacion_tabla_campo_orden form-control" style="margin-top:5px">
                                            <!-- <option value="">Campo orden</option> -->
                                            <?php
                                            if ($datacfg->relacion_tabla_campo_orden->{$c['column_name']}) {
                                                $camposrel = $hc->all_field($datacfg->relacion_tabla->{$c['column_name']});
                                                foreach ($camposrel as $crel) {
                                                    ?>
                                                    <option value='<?= $crel['column_name'] ?>' <?= $datacfg->relacion_tabla_campo_orden->{$c['column_name']} == $crel['column_name'] ? 'selected="selected"' : '' ?>><?= $crel['column_name'] ?></option>
                                                <?php
                                            }
                                        };
                                        ?>
                                        </select>
                                    </div>
                                    <div class="div_relacion_controlador">
                                        <div class="form-group" style="margin-top:5px">
                                            <!-- <div class="col-md-2"> -->
                                            <label class="labelrelacion">Prefijo: </label>
                                            <!-- </div>
                            <div class="col-md-10"> -->
                                            <input type="text" class="form-control inputrelacioncontrolador" name="relacion_controlador_link[<?= $c['column_name'] ?>]" value="<?= !empty($datacfg->relacion_controlador_link->{$c['column_name']}) ? $datacfg->relacion_controlador_link->{$c['column_name']} : '' ?>" placeholder="Ruta controlador" />
                                            <!-- </div> -->
                                        </div>

                                        <div class="form-group">
                                            <label class="labelnormal">
                                                <input type="checkbox" name="relacion_controlador_popup[<? $c['column_name'] ?>]" value="1" <?= isset($datacfg->relacion_controlador_popup->{$c['column_name']}) ? 'checked' : '' ?>>
                                                Abrir en PopUp
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="divinputrutafichero" style="<?= (isset($datacfg->type_format->{$c['column_name']}) && !in_array($datacfg->type_format->{$c['column_name']},array('file_image','file')))  ? 'display:none;' : '' ?>">
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="labelrelacion">Directorio: </label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control inputrutafichero" name="tipo_campo_file_ruta[<?= $c['column_name'] ?>]" value="<?= !empty($datacfg->tipo_campo_file_ruta->{$c['column_name']}) ? str_replace("\\","/",$datacfg->tipo_campo_file_ruta->{$c['column_name']}) : '' ?>" placeholder="Ruta fichero" />
                                        </div>
                                    </div>
                                </div>

                                <div class="divinputlinksufijo" style="<?= empty($datacfg->link_sufijo->{$c['column_name']}) ? 'display:none;' : '' ?>">
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="labelrelacion">Prefijo : </label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control inputlinksufijo" name="link_sufijo[<?= $c['column_name'] ?>]" value="<?= !empty($datacfg->link_sufijo->{$c['column_name']}) ? $datacfg->link_sufijo->{$c['column_name']} : '' ?>" placeholder="Enlace que precede al valor" />
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select name="formato_campo_alineacion[<?= $c['column_name'] ?>]">
                                    <option value="left" <?= (isset($datacfg->formato_campo_alineacion->{$c['column_name']}) && $datacfg->formato_campo_alineacion->{$c['column_name']} == 'left') || !isset($datacfg->formato_campo_alineacion->{$c['column_name']}) ? 'selected="selected"' : '' ?>>Izquierda</option>
                                    <option value="center" <?= isset($datacfg->formato_campo_alineacion->{$c['column_name']}) && $datacfg->formato_campo_alineacion->{$c['column_name']} == 'center' ? 'selected="selected"' : '' ?>>Centrado</option>
                                    <option value="right" <?= (isset($datacfg->formato_campo_alineacion->{$c['column_name']}) && $datacfg->formato_campo_alineacion->{$c['column_name']} == 'right') || (!isset($datacfg->formato_campo_alineacion->{$c['column_name']}) && in_array($c['data_type'], $tiposderecha)) ? 'selected="selected"' : '' ?>>Derecha</option>
                                </select>
                                <br>
                                <label><input type="checkbox" name="formato_campo_bold[<?= $c['column_name'] ?>]" value="<?= $c['column_name'] ?>" <?= isset($datacfg->formato_campo_bold->{$c['column_name']}) ? 'checked' : '' ?> /> Negrita</label>
                                <input class="form-control" style="width:100px !important" type="color" name="formato_campo_color[<?= $c['column_name'] ?>]" value="<?= isset($datacfg->formato_campo_color->{$c['column_name']}) ? $datacfg->formato_campo_color->{$c['column_name']} : '#333333' ?>" />
                            </td>
                            <td class="text-center"><input type="checkbox" name="orden_list[<?= $c['column_name'] ?>]" class="selectcheckbox_ordenlist" value="<?= $c['column_name'] ?>" <?= isset($datacfg->orden_list->{$c['column_name']}) ? 'checked' : '' ?> />
                                <select name="ordendirection_list[<?= $c['column_name'] ?>]" class="selectcheckbox_ordendirectionlist">
                                    <option value="desc" <?= isset($datacfg->ordendirection_list->{$c['column_name']}) && $datacfg->ordendirection_list->{$c['column_name']} == 'desc' ? 'selected="selected"' : '' ?>>DESC</option>
                                    <option value="asc" <?= isset($datacfg->ordendirection_list->{$c['column_name']}) && $datacfg->ordendirection_list->{$c['column_name']} == 'asc' ? 'selected="selected"' : '' ?>>ASC</option>
                                </select>
                            </td>

                            <td class="text-center"><input type="checkbox" name="campos_list[]" class="selectcheckbox_list" value="<?= $c['column_name'] ?>" <?php echo in_array($c['column_name'], isset($datacfg->campos_list) ? $datacfg->campos_list : array()) ? 'checked' : '' ?> /></td>
                            <td class="text-center"><input class="text-center input_position_list" type="text" name="posicion_list[<?= $c['column_name'] ?>]" value="<?= isset($datacfg->posicion_list->{$c['column_name']}) ? $datacfg->posicion_list->{$c['column_name']} : $i ?>" style="width:25px;" /></td>
                            <td class="text-center"><input type="checkbox" name="campos_edit[]" class="selectcheckbox_edit" value="<?= $c['column_name'] ?>" <?php echo in_array($c['column_name'], isset($datacfg->campos_edit) ? $datacfg->campos_edit : array()) ? 'checked' : '' ?> /></td>
                            <td class="text-center"><input class="text-center input_position_edit" type="text" name="posicion_edit[<?= $c['column_name'] ?>]" value="<?= isset($datacfg->posicion_edit->{$c['column_name']}) ? $datacfg->posicion_edit->{$c['column_name']} : $i ?>" style="width:25px;" /></td>
                            <td class="text-center"><input type="checkbox" name="requerido[<?= $c['column_name'] ?>]" class="requeridocheckbox" value="<?= $c['column_name'] ?>" <?= isset($datacfg->requerido->{$c['column_name']}) ? 'checked' : '' ?> /></td>
                           
                        </tr>
                        <?php
                        $i++;
                        };
                    };
                    function limpialabel($text)
                    {
                        $search = array('_', '-');
                        $replace = array(' ', ' ');
                        return str_replace($search, $replace, $text);
                    }
                    ?>
                </table>
            </div>
            <input type="submit" value="Generar" name="generate" class="btn btn-primary" onclick="javascript: return confirm('Se van a sobreescribir los archivos existentes. Continuamos?')" />
            <input type="submit" value="Guardar" name="save" class="btn btn-primary" />
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        if (!<?= $tengodatos ?>) {
            $('.selectcheckbox_list,.selectcheckbox_edit').prop('checked', true);
        } else {
            $('.selectcheckbox_list,.selectcheckbox_edit').each(function() {
                var input = $(this).parent().next().children();
                if (!$(this).is(':checked')) {
                    input.val('').prop('disabled', true);
                }
            })
            if ($('.selectcheckbox_ordenlist:checked').length > 0) {
                $('.selectcheckbox_ordenlist:not(:checked)').prop('disabled', true);
                $('.selectcheckbox_ordenlist:not(:checked)').next().prop('disabled', true);
            }

        }
        $('.select_relacion_tabla:disabled').hide().parent().hide();
        $('.select_relacion_tabla_campo:disabled').hide().parent().hide();
        $('.select_relacion_tabla_campo_mostrar:disabled').hide().parent().hide();
        $('.select_relacion_tabla_campo_orden:disabled').hide().parent().hide();
        //$('.div_relacion_controlador').hide();
    })
</script>
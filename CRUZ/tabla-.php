<?
error_reporting(0);
require_once 'core/CRUZcode.php';
require_once 'core/helper.php';
require_once 'core/process.php';


$tabla = $_POST['table_name'];

$datacfg = readJSON('project/'.$tabla.'.cfg');
$tengodatos = $datacfg ? 1 : 0;
// echo '<pre>';
// var_dump($datacfg);
// echo '</pre>';

$campos = $hc->not_primary_field($tabla);
?>
<style>
.labelnormal{font-weight:normal}
</style>
<form id="campostable" action="index.php" method="POST">
<input type="hidden" name="table_name" value="<?=$tabla?>"/>
<div class="row">
    <div class="col-md-12">
    <h2>Tabla: <?=$tabla?></h2>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
    <div class="form-group">
            <label for="controller" class="control-label">Nombre Controlador</label>
            <input type="text" id="controller" name="controller" value="<?=isset($datacfg->controller)?$datacfg->controller:ucfirst($tabla)?>" class="form-control" placeholder="Nombre Controlador" />
        </div>
    </div>
    <div class="col-md-3">
    <div class="form-group">
            <label for="model" class="control-label">Nombre Modelo</label>
            <input type="text" id="model" name="model" value="<?=isset($datacfg->model)?$datacfg->model:ucfirst($tabla)?>" class="form-control" placeholder="Nombre Modelo" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">Tipo de tabla listado:</label>
            <div class="row">
                <?php $jenis_tabel = isset($datacfg->jenis_tabel) ? $datacfg->jenis_tabel : 'datatables'; ?>
                <div class="col-md-3">
                    <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                        <label>
                            <input type="radio" name="jenis_tabel" value="reguler_table" <?php echo $jenis_tabel == 'reguler_table' ? 'checked' : ''; ?>>
                            Bootstrap Table
                        </label>
                    </div>                            
                </div>
                <div class="col-md-3">
                    <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                        <label>
                            <input type="radio" name="jenis_tabel" value="datatables" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                            Serverside Datatables
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="extrawhere" class="control-label text-left">Condición extra</label>
            <input type="text" name="extrawhere" class="form-control" id="extrawhere" placeholder="" value="<?=isset($datacfg->extrawhere)?$datacfg->extrawhere:''?>">
            <span class="help-block">*En las condiciones utilizar <em>nombretabla.nombrecampo</em> sin WHERE.</span>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="titulo" class="control-label text-left">Título</label>
            <input type="text" name="titulo" class="form-control" id="titulo" placeholder="<?=$tabla?>" value="<?=isset($datacfg->titulo)?$datacfg->titulo:$tabla?>">
        </div>    
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="objeto" class="control-label text-left">Nombre Objeto</label>
            <input type="text" name="objeto" class="form-control" id="objeto" placeholder="<?=$tabla?>" value="<?=isset($datacfg->objeto)?$datacfg->objeto:$tabla?>">
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
                <label class="labelnormal col-md-1">
                    <input type="checkbox" name="action_add" value="1" <?php echo $action_add == '1' ? 'checked' : '' ?>>
                    Añadir
                </label>
            <!-- </div> -->
        <!-- </div> -->
        <!-- <div class="form-group"> -->
            <!-- <div class="checkbox"> -->
                <?php $action_edit = isset($datacfg->action_edit) ? $datacfg->action_edit : ''; ?>
                <label class="labelnormal col-md-1">
                    <input type="checkbox" name="action_edit" value="1" <?php echo $action_edit == '1' ? 'checked' : '' ?>>
                    Editar
                </label>
            <!-- </div> -->
        <!-- </div> -->
        <!-- <div class="form-group"> -->
            <!-- <div class="checkbox"> -->
                <?php $action_del = isset($datacfg->action_del) ? $datacfg->action_del : ''; ?>
                <label class="labelnormal col-md-1">
                    <input type="checkbox" name="action_del" value="1" <?php echo $action_del == '1' ? 'checked' : '' ?>>
                    Eliminar
                </label>
            <!-- </div> -->
        <!-- </div> -->

        <!-- <div class="form-group"> -->
            <!-- <div class="checkbox"> -->
                <?php $export_excel = isset($datacfg->export_excel) ? $datacfg->export_excel : ''; ?>
                <label class="labelnormal col-md-2">
                    <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                    Exportar a Excel
                </label>
            <!-- </div> -->
        <!-- </div>     -->

        <!-- <div class="form-group"> -->
            <!-- <div class="checkbox"> -->
                <?php $export_word = isset($datacfg->export_word) ? $datacfg->export_word : ''; ?>
                <label class="labelnormal col-md-2">
                    <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                    Exportar a Word
                </label>
            <!-- </div> -->
        <!-- </div>   -->
    </div>
    <div class="clear"><br></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <input type="submit" value="Generar" name="generate" class="btn btn-primary" onclick="javascript: return confirm('Se van a sobreescribir los archivos existentes. Continuamos?')" />
        <input type="submit" value="Guardar" name="save" class="btn btn-primary" />
        <div class="clear"><br></div>
    </div>
</div>
<div class="table-responsive">
<table class="table">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-center" colspan="3">Listado</td>
        <td class="text-center" colspan="3">Edición</td>
    </tr>
    <tr>
        <td><strong>Seleccionar / deseleccionar Todos</strong></td>
        <td>Label</td>
        <td>Campo relacionado</td>
        <td class="text-center">Orden</td>
        <td class="text-center"><input type="checkbox" id="checkalllist" checked="checked" /></td>
        <td class="text-center">Pos.</td>
        <td class="text-center"><input type="checkbox" id="checkalledit" checked="checked" /></td>
        <td class="text-center">Pos.</td>
        <td class="text-center">Req.</td>
    </tr>
    <?
    $i=1;
    foreach($campos as $c){        
    ?>
    <tr>
        <td><?=$c['column_name']?> <em>(<?=$c['data_type']?>)</em></td>
        <td><input class="form-control labelcampos" type="text" name="label[<?=$c['column_name']?>]" value="<?=isset($datacfg->label->$c['column_name'])?$datacfg->label->$c['column_name']:ucfirst($c['column_name'])?>"/></td>
        <td>
            <input type="checkbox" name="relacion[<?=$c['column_name']?>]" class="relacioncheckbox" value="<?=$c['column_name']?>" <?=isset($datacfg->relacion->$c['column_name'])?'checked':''?>/>
            <select name="relacion_tabla[<?=$c['column_name']?>]" <?=isset($datacfg->relacion_tabla->$c['column_name'])?'':'disabled'?> class="select_relacion_tabla form-control">
                <option value="">Selecciona tabla</option>
                <?php
                $table_list = $hc->table_list();
                $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                foreach ($table_list as $table) {
                    ?>
                    <option value="<?php echo $table['table_name'] ?>" <?=isset($datacfg->relacion_tabla->$c['column_name']) &&  $datacfg->relacion_tabla->$c['column_name'] == $table['table_name'] ? 'selected="selected"' : ''; ?>><?php echo $table['table_name'] ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="relacion_tabla_campo[<?=$c['column_name']?>]" <?=isset($datacfg->relacion_tabla_campo->$c['column_name'])?'':'disabled'?> class="select_relacion_tabla_campo form-control">
                <option value="">Campo Relación</option>
                <?
                if($datacfg->relacion_tabla_campo->$c['column_name']){
                    $camposrel = $hc->all_field($datacfg->relacion_tabla->$c['column_name']);
                    foreach($camposrel as $crel){
                        ?>
                        <option value='<?=$crel['column_name']?>' <?=$datacfg->relacion_tabla_campo->$c['column_name']==$crel['column_name']?'selected="selected"':''?>><?=$crel['column_name']?></option>
                        <?
                    }
                }
                ?>
            </select>
            <select name="relacion_tabla_campo_mostrar[<?=$c['column_name']?>]" <?=isset($datacfg->relacion_tabla_campo_mostrar->$c['column_name'])?'':'disabled'?> class="select_relacion_tabla_campo_mostrar form-control">
                <option value="">Campo a mostrar</option>
                <?
                if($datacfg->relacion_tabla_campo_mostrar->$c['column_name']){
                    $camposrel = $hc->all_field($datacfg->relacion_tabla->$c['column_name']);
                    foreach($camposrel as $crel){
                        ?>
                        <option value='<?=$crel['column_name']?>' <?=$datacfg->relacion_tabla_campo_mostrar->$c['column_name']==$crel['column_name']?'selected="selected"':''?>><?=$crel['column_name']?></option>
                        <?
                    }
                }
                ?>
            </select>
            <select name="relacion_tabla_campo_orden[<?=$c['column_name']?>]" <?=isset($datacfg->relacion_tabla_campo_orden->$c['column_name'])?'':'disabled'?> class="select_relacion_tabla_campo_orden form-control">
                <option value="">Campo orden</option>
                <?
                if($datacfg->relacion_tabla_campo_orden->$c['column_name']){
                    $camposrel = $hc->all_field($datacfg->relacion_tabla->$c['column_name']);
                    foreach($camposrel as $crel){
                        ?>
                        <option value='<?=$crel['column_name']?>' <?=$datacfg->relacion_tabla_campo_orden->$c['column_name']==$crel['column_name']?'selected="selected"':''?>><?=$crel['column_name']?></option>
                        <?
                    }
                }
                ?>
            </select>

        </td>
        <td class="text-center"><input type="checkbox" name="orden_list[<?=$c['column_name']?>]" class="selectcheckbox_ordenlist" value="<?=$c['column_name']?>" <?=isset($datacfg->orden_list->$c['column_name'])?'checked':''?> />
        <select name="ordendirection_list[<?=$c['column_name']?>]" class="selectcheckbox_ordendirectionlist">
        <option value="desc" <?=isset($datacfg->ordendirection_list->$c['column_name']) && $datacfg->ordendirection_list->$c['column_name']=='desc'?'selected="selected"':''?>>DESC</option>
        <option value="asc" <?=isset($datacfg->ordendirection_list->$c['column_name']) && $datacfg->ordendirection_list->$c['column_name']=='asc'?'selected="selected"':''?>>ASC</option>
        </select>
        </td>
        <td class="text-center"><input type="checkbox" name="campos_list[]" class="selectcheckbox_list" value="<?=$c['column_name']?>" <?php echo in_array($c['column_name'],$datacfg->campos_list) ? 'checked' : '' ?> /></td>
        <td class="text-center"><input class="text-center input_position_list" type="text" name="posicion_list[<?=$c['column_name']?>]" value="<?=isset($datacfg->posicion_list->$c['column_name'])?$datacfg->posicion_list->$c['column_name']:$i?>" style="width:25px;"/></td>
        <td class="text-center"><input type="checkbox" name="campos_edit[]" class="selectcheckbox_edit" value="<?=$c['column_name']?>" <?php echo in_array($c['column_name'],$datacfg->campos_edit) ? 'checked' : '' ?> /></td>
        <td class="text-center"><input class="text-center input_position_edit" type="text" name="posicion_edit[<?=$c['column_name']?>]" value="<?=isset($datacfg->posicion_edit->$c['column_name'])?$datacfg->posicion_edit->$c['column_name']:$i?>" style="width:25px;" /></td>
        <td class="text-center"><input type="checkbox" name="requerido[<?=$c['column_name']?>]" class="requeridocheckbox" value="<?=$c['column_name']?>" <?=isset($datacfg->requerido->$c['column_name'])?'checked':''?>/></td>
    </tr>
    <?
    $i++;
    }
    ?>
</table>
</div>
<input type="submit" value="Generar" name="generate" class="btn btn-primary" onclick="javascript: return confirm('Se van a sobreescribir los archivos existentes. Continuamos?')" />
<input type="submit" value="Guardar" name="save" class="btn btn-primary" />
</form>
<script>
$(document).ready(function(){
    if(!<?=$tengodatos?>){
        $('.selectcheckbox_list,.selectcheckbox_edit').prop('checked',true);
    }
    else{
        $('.selectcheckbox_list,.selectcheckbox_edit').each(function(){
            var input = $(this).parent().next().children();
            if(!$(this).is(':checked')){
                input.val('').prop('disabled',true);
            }    
        })
        if($('.selectcheckbox_ordenlist:checked').length>0){
            $('.selectcheckbox_ordenlist:not(:checked)').prop('disabled',true);
            $('.selectcheckbox_ordenlist:not(:checked)').next().prop('disabled',true);
        }
        
    }
    $('.select_relacion_tabla:disabled').hide();
    $('.select_relacion_tabla_campo:disabled').hide();
    $('.select_relacion_tabla_campo_mostrar:disabled').hide();
    $('.select_relacion_tabla_campo_orden:disabled').hide();
})
</script>
<?php
error_reporting(1);
require_once 'core/CRUZcode.php';
require_once 'core/helper.php';
require_once 'core/process.php';
error_reporting(E_ALL);
?>
<!doctype html>
<html>
    <head>
        <title>CRUZ - Codeigniter CRUD Generator</title>
        <link rel="stylesheet" href="core/bootstrap.min.css"/>
        <link rel="stylesheet" href="core/generator.css"/>
        <link rel="stylesheet" href="core/bs4-form-select-fields.min.css"/>
        <link rel="stylesheet" href="core/bs4-diff-files.min.css"/>
        <script src="core/jquery.min.js"></script>
        <script src="core/popper.min.js"></script>
        <script src="core/bootstrap.min.js"></script>
        
        <script src="core/bs3-form-select-table.min.js"></script>
        <script src="core/bs4-form-select-fields.min.js"></script>
        <script src="core/bs4-diff-files.min.js"></script>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-2" id="sidebar" style="display:none">
            <label>Base de datos: <?=$hc->database;?></label>
                <form action="index.php" method="POST" id="frmgenerator">

                    <div class="form-group">
                        <label>Seleccionar Tabla - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Actualizar</a></label>
                        <div style="height:500px; overflow-y: scroll;">
                            <div class="list-group">
                            <?php
                                $table_list = $hc->table_list();
                                $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                                foreach ($table_list as $table) {
                                    ?>
                                    <button type="button" class="list-group-item list-group-item-action buttontable <?=file_exists('project/'.$table['table_name'].'.cfg')?'list-group-item-info':''?> <?=isset($_POST['table_name']) && $_POST['table_name']==$table['table_name']?'active':''?>" data-table-name="<?=$table['table_name']?>" style="width:100%;text-align:left">
                                    <?=$table['table_name']?>
                                    
                                    </button>
                                    
                                    <?php
                                }?>
                            </div>
                        </div>
                        <?/*?>
                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                            <option value="">Please Select</option>
                            <?php
                            $table_list = $hc->table_list();
                            $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                            foreach ($table_list as $table) {
                                ?>
                                <option value="<?php echo $table['table_name'] ?>" <?php echo $table_list_selected == $table['table_name'] ? 'selected="selected"' : ''; ?>><?php echo $table['table_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?*/?>
                    </div>
                    
                    <!-- <a href="core/setting.php" class="btn btn-default">Configuraciones</a> -->
                </form>
                <br>

                <?php
                foreach ($hasil as $h) {
                    echo '<p>' . $h . '</p>';
                }
                ?>
            </div>
            <div class="col-md-12" id="contenido">
            <h1 class="border-bottom display-4 text-gray pb-2 mb-5"><span class="text-muted">CRUZ : PHP CRUD Generator</span> <br> Base de datos: <?=$hc->database;?></h1>
                <!-- <label>Base de datos: <?=$hc->database;?></label>  -->
                <a href="#" id="showtables" class="btn btn-secondary">Ver tablas</a>
                
                <a href="#" id="hidetables" class="btn btn-secondary" style="display:none">Ocultar tablas</a>
                <p></p>
                <br>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <a href="#" id="showtables" class="btn btn-default">Ver tablas</a>
                        <a href="#" id="hidetables" class="btn btn-default" style="display:none">Ocultar tablas</a> 
                    </div>
                </div> -->
                <div id="contenedor">
                <!-- <div class="row">
                    <div class="col-md-12">
                        <h2><a href="#" id="showtables" class="btn btn-default">Ver tablas</a><a href="#" id="hidetables" class="btn btn-default" style="display:none">Ocultar tablas</a> Tabla: </h2>
                    </div>
                </div> -->
            </div>
        </div>
        <script type="text/javascript">
            function capitalize(s) {
                return s && s[0].toUpperCase() + s.slice(1);
            }

            function setname() {
                var tabla = $("#table_name").val();
                if(tabla=='')
                    return false;
                $.post("tabla.php", {table_name: tabla}, function(result){
                    $("#contenedor").html(result);
                });
                var table_name = document.getElementById('table_name').value.toLowerCase();
                if (table_name != '') {
                    document.getElementById('controller').value = capitalize(table_name);
                    document.getElementById('model').value = capitalize(table_name) + '_model';
                } else {
                    document.getElementById('controller').value = '';
                    document.getElementById('model').value = '';
                }
            }

            function getTabla(boton){
                console.log('entramos')
                $('.buttontable').removeClass('active')
                boton.addClass('active');
                var tabla = boton.data( "tableName" );
                if(tabla=='')
                return false;
                $.post("tabla.php", {table_name: tabla}, function(result){
                    $("#contenedor").html(result);
                });
            }

            $(document).ready(function(){

                $(document).on('click','#showtables',function(){
                    $('#sidebar').show();
                    $('#contenido').removeClass('col-md-12').addClass('col-md-10');
                    $('#showtables').hide();
                    $('#hidetables').show();
                })
                $(document).on('click','#hidetables',function(){
                    $('#sidebar').hide();
                    $('#contenido').addClass('col-md-12').removeClass('col-md-10');
                    $('#showtables').show();
                    $('#hidetables').hide();
                })

                console.log($('.buttontable.active'));
                // <?
                // if(isset($_POST['table_name'])){
                //     ?>
                    getTabla($('.buttontable.active'));
                //     <?
                // }
                // ?>
                //$('.buttontable.active').click();
                //setname();
                $('.buttontable').click(function(){
                    console.log('entramos')
                    $('.buttontable').removeClass('active')
                    $(this).addClass('active');
                    var tabla = $( this).data( "tableName" );
                    if(tabla=='')
                    return false;
                    $.post("tabla.php", {table_name: tabla}, function(result){
                        $("#contenedor").html(result);
                    });
                    $('#hidetables').click();
                })
                $(document).on('click','#checkalllist',function(){
                    if($(this).is(':checked')){
                        $('.selectcheckbox_list').prop('checked',true);
                        $('.input_position_list').val('1').prop('disabled',false);
                    }
                    else{
                        $('.selectcheckbox_list').prop('checked',false);
                        $('.input_position_list').val('').prop('disabled',true);
                    }
                })
                $(document).on('click','#checkalledit',function(){
                    if($(this).is(':checked')){
                        $('.selectcheckbox_edit').prop('checked',true);
                        $('.input_position_edit').val('1').prop('disabled',false);
                        
                    }
                    else{
                        $('.selectcheckbox_edit').prop('checked',false);
                        $('.input_position_edit').val('').prop('disabled',true);                        
                    }
                    
                })
                $(document).on('change','.selectcheckbox_list',function(){
                    var input = $(this).parent().next().children();
                    if($(this).is(':checked')){
                        input.val('1').prop('disabled',false);
                    }
                    else{
                        input.val('').prop('disabled',true);
                    }
                })
                $(document).on('change','.selectcheckbox_edit',function(){
                    var input = $(this).parent().next().children();
                    if($(this).is(':checked')){
                        input.val('1').prop('disabled',false);
                    }
                    else{
                        input.val('').prop('disabled',true);
                    }
                })
                $(document).on('change','.selectcheckbox_ordenlist',function(){
                    
                    if($(this).is(':checked')){
                        $('.selectcheckbox_ordenlist:not(:checked)').prop('disabled',true);
                        $('.selectcheckbox_ordenlist:not(:checked)').next().prop('disabled',true);
                    }
                    else{
                        $('.selectcheckbox_ordenlist').prop('disabled',false);
                        $('.selectcheckbox_ordenlist').next().prop('disabled',false);                        
                    }
                })

                $(document).on('change','.relacioncheckbox',function(){
                    var select = $(this).next();
                    if($(this).is(':checked')){
                        select.val('').prop('disabled',false).show();
                    }
                    else{
                        select.val('').prop('disabled',true).hide();
                        select.next().val('').prop('disabled',true).hide();
                        select.next().next().val('').prop('disabled',true).hide();
                        select.next().next().next().val('').prop('disabled',true).hide();
                    }
                })

                $(document).on('change','.select_relacion_tabla',function(){
                    var select_rel = $(this).parent().siblings('.div_select_relacion_tabla_campo').children('select');
                    var select_mos = $(this).parent().siblings('.div_select_relacion_tabla_campo_mostrar').children('select');
                    var select_ord = $(this).parent().siblings('.div_select_relacion_tabla_campo_orden').children('select');
                    var tabla = $(this).val();
                    if(tabla!=''){
                        $.post("campostabla.php", {table_name: tabla}, function(result){
                            select_rel.html(result);
                            select_rel.find('option:eq(0)').prop('selected', true)
                            select_rel.prop('disabled',false).show().parent().show();

                            select_mos.html(result);
                            select_mos.find('option:eq(0)').prop('selected', true)
                            select_mos.prop('disabled',false).show().parent().show();

                            select_ord.html(result);
                            select_ord.find('option:eq(0)').prop('selected', true)
                            select_ord.prop('disabled',false).show().parent().show();



                            select.parent().siblings('.div_select_relacion_tabla_campo_mostrar').children('select').html(result);
                            // select.next().find('option').each(function(){
                            //     $(this).text('m - '+$(this).text())
                            // });
                            select.parent().next().children('select').find('option:eq(0)').prop('selected', true)
                            select.parent().next().children('select').prop('disabled',false).show();
                            select.parent().next().next().children('select').html(result);
                            // select.next().next().find('option').each(function(){
                            //     $(this).text('ord - '+$(this).text())
                            // });
                            select.parent().next().next().children('select').find('option:eq(0)').prop('selected', true)
                            select.parent().next().next().children('select').prop('disabled',false).show();
                            
                        });   
                    }
                })

                $(document).on('change','.select_formatos',function(){
                    console.log($(this).val())
                    var checkrelacion = $(this).next()
                    var valorcampo = checkrelacion.data( "valorCampo" );
                    console.log(valorcampo)
                    var select = checkrelacion.next().children('.div_select_relacion_tabla').children('select');

                    if($(this).val()=='relacionado'){
                        checkrelacion.val(valorcampo);
                        checkrelacion.next().show().children('.div_relacion_controlador').show();
                        
                        
                        //checkrelacion.val('');
                        select.val('').prop('disabled',false).show().parent().show();
                    }
                    else{
                        checkrelacion.val('');
                        checkrelacion.next().hide();
                        select.val('').prop('disabled',true).hide();
                        select.parent().siblings('.div_select_relacion_tabla_campo').hide().children('select').prop('disabled',true).hide();
                        select.parent().siblings('.div_select_relacion_tabla_campo_mostrar').hide().children('select').prop('disabled',true).hide();
                        select.parent().siblings('.div_select_relacion_tabla_campo_orden').hide().children('select').prop('disabled',true).hide();

                        // select.next().val('').prop('disabled',true).hide();
                        // select.next().next().val('').prop('disabled',true).hide();
                        // select.next().next().next().val('').prop('disabled',true).hide();
                    }
                    if($(this).val()=='file' || $(this).val()=='file_image'){
                        $(this).siblings('.divinputrutafichero').show();
                    }
                    else{
                        $(this).siblings('.divinputrutafichero').hide();
                    }
                    if($(this).val()=='link_sufijo'){
                        $(this).siblings('.divinputlinksufijo').show();
                    }
                    else{
                        $(this).siblings('.divinputlinksufijo').hide();
                    }
                    
                })

                $('#frmgenerator').submit(function(){
                    $(this).append($('.selectcheckbox_list'));
                    $(this).append($('.selectcheckbox_edit'));
                    $(this).append($('.input_position_list'));
                    $(this).append($('.input_position_edit'));

                    $(this).append($('.labelcampos'));
                    $(this).append($('.relacioncheckbox'));
                    $(this).append($('.select_relacion_tabla'));
                    $(this).append($('.select_relacion_tabla_campo'));
                    $(this).append($('.select_relacion_tabla_campo_mostrar'));
                    return true;
                })


            })

        </script>
    </body>
</html>

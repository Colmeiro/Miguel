<?php

$hasil = array();

if (isset($_POST['save']))
{
    $datos_file = $_POST;
    $datos_file['relacion'] = array_filter($_POST['relacion']);
    $string_file = json_encode($datos_file);
    $hasil_setting = createFile($string_file, 'project/'.$_POST['table_name'].'.cfg');
}

if (isset($_POST['generate']))
{
    
    $datos_file = $_POST;
    $datos_file['relacion'] = array_filter($_POST['relacion']);
    $string_file = json_encode($datos_file);
    $res = createFile($string_file, 'project/'.$_POST['table_name'].'.cfg');

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    // exit();
    // get form data
    $tipo_creacion = safe($_POST['tipo_creacion']);
    $modulo = safe($_POST['modulo']);

    $concampofile = false;

    $table_name = safe($_POST['table_name']);
    $jenis_tabel = safe($_POST['jenis_tabel']);
    $export_excel = safe($_POST['export_excel']);
    $export_word = safe($_POST['export_word']);
    $export_pdf = safe($_POST['export_pdf']);
    $controller = safe($_POST['controller']);
    $model = safe($_POST['model']);
    $titulo = safe($_POST['titulo']);
    $objeto = safe($_POST['objeto']);

    $action_add = safe($_POST['action_add']);
    $action_edit = safe($_POST['action_edit']);
    $action_del = safe($_POST['action_del']);

    $list_campos_x = $_POST['campos_list'];
    $list_posicion = $_POST['posicion_list'];
    $edit_campos_x = $_POST['campos_edit'];
    $edit_posicion = $_POST['posicion_edit'];
    $labels = $_POST['label'];
    $relaciones = array_filter($_POST['relacion']);
    $relaciones_tabla = $_POST['relacion_tabla'];
    $relaciones_tabla_campo = $_POST['relacion_tabla_campo'];
    $relaciones_tabla_campo_mostrar = $_POST['relacion_tabla_campo_mostrar'];
    $relaciones_tabla_campo_orden = $_POST['relacion_tabla_campo_orden'];
    $requeridos = $_POST['requerido'];
    $list_orden = $_POST['orden_list'];
    $type_format = $_POST['type_format'];

    foreach($type_format as $key=>$value){
        if(strpos($value,'file')!==false){
            $concampofile = true;
        }
    }

    $format_bold = $_POST['formato_campo_bold'];
    $format_color = $_POST['formato_campo_color'];
    $formato_align = $_POST['formato_campo_alineacion'];
    $formato_align_key = $_POST['formato_campo_alineacion_key'];
    $ruta_file = $_POST['tipo_campo_file_ruta'];
    foreach($ruta_file as $key=>$value){
        $ruta_file[$key] = str_replace("\\","/",$value);
    }
    $link_sufijo = $_POST['link_sufijo'];

    $relacion_controlador_link = $_POST['relacion_controlador_link'];
    $relacion_controlador_popup = $_POST['relacion_controlador_popup'];

    $estilo = $_POST['estilo'];
    $template = $_POST['template'];
    $posicion_botones = $_POST['posicion_botones'];
    $formato_botones = $_POST['formato_botones'];
    
    
    $list_ordendirection = $_POST['ordendirection_list'];
    $extrawhere = $_POST['extrawhere'];
    $showkey = $_POST['show_key'];
    $labelkey = $_POST['label_key'];
    $numregistros = $_POST['numregistros'];
    

    $list_campos = array_combine($list_posicion,$list_campos_x);
    $edit_campos = array_combine($edit_posicion,$edit_campos_x);
    ksort($list_campos);
    ksort($edit_campos);
/*
    echo '<pre>';
    var_dump($list_campos);
    echo '</pre>';
    echo '<pre>';
    var_dump($edit_campos);
    echo '</pre>';

exit;
*/
    if ($table_name <> '')
    {
        // set data
        $table_name = $table_name;
        $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name);
        $m = $model <> '' ? ucfirst($model) : ucfirst($table_name) . '_model';

        // $v_list = $table_name . "_list";
        // $v_read = $table_name . "_read";
        // $v_form = $table_name . "_form";
        // $v_doc = $table_name . "_doc";
        // $v_pdf = $table_name . "_pdf";
        $v_list = $objeto . "_list";
        $v_read = $objeto . "_read";
        $v_form = $objeto . "_form";
        $v_doc = $objeto . "_doc";
        $v_pdf = $objeto . "_pdf";

        // url
        $c_url = strtolower($c);

        // filename
        $c_file = $c . '.php';
        $m_file = $m . '.php';
        $v_list_file = $v_list . '.php';
        $v_read_file = $v_read . '.php';
        $v_form_file = $v_form . '.php';
        $v_doc_file = $v_doc . '.php';
        $v_pdf_file = $v_pdf . '.php';

        // read setting
        $get_setting = readJSON('core/settingjson.cfg');
        $target = $get_setting->target;
        if($tipo_creacion=='modulo'){
            if($modulo!='')
                $target = $target.'modules/'.$modulo.'/';
            else{
                $target = $target.'modules/'.$c_url.'/';
            }
            if (!file_exists($target . "views/"))
            {
                mkdir($target . "views/", 0777, true);
            }
            if (!file_exists($target . "controllers/"))
            {
                mkdir($target . "controllers/", 0777, true);
            }
            if (!file_exists($target . "models/"))
            {
                mkdir($target . "models/", 0777, true);
            }
        }
        else{
            if (!file_exists($target . "views/" . $c_url))
            {
                mkdir($target . "views/" . $c_url, 0777, true);
            }
        }

        

        $pk = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all = $hc->all_field($table_name);

        // generate
        /*
        if(!file_exists($target."config/pagination.php")){
            include 'core/create_config_pagination.php';
        }
        */
        
        if ($jenis_tabel == 'reguler_table') {
            include 'core/create_controller.php';
            include 'core/create_model.php';
            include 'core/create_view_list.php';
        } elseif($jenis_tabel == 'datatables') {
            include 'core/create_controller_datatables.php';
            include 'core/create_model_datatables.php';
            include 'core/create_view_list_datatables.php';
            if(!file_exists($target."libraries/Datatables.php")){
                include 'core/create_libraries_datatables.php';
            }
        }
        else{
            include 'core/create_view_list_footables.php';
        }

        include 'core/create_view_form.php';
        include 'core/create_view_read.php';
        
        $export_excel == 1 && !file_exists($target."helpers/exportexcel_helper.php") ? include 'core/create_exportexcel_helper.php' : '';
        $export_word == 1 ? include 'core/create_view_list_doc.php' : '';
        
        $export_pdf == 1 && !file_exists($target."libraries/pdf.php") ? include 'core/create_pdf_library.php' : '';
        $export_pdf == 1 ? include 'core/create_view_list_pdf.php' : '';

        $hasil[] = $hasil_controller;
        $hasil[] = $hasil_model;
        $hasil[] = $hasil_view_list;
        $hasil[] = $hasil_view_form;
        $hasil[] = $hasil_view_read;
        $hasil[] = $hasil_view_doc;
        $hasil[] = $hasil_view_pdf;
        $hasil[] = $hasil_config_pagination;
        $hasil[] = $hasil_exportexcel;
        $hasil[] = $hasil_pdf;
    } else
    {
        $hasil[] = 'No table selected.';
    }
}
/*
if (isset($_POST['generateall']))
{

    $jenis_tabel = safe($_POST['jenis_tabel']);
    $export_excel = safe($_POST['export_excel']);
    $export_word = safe($_POST['export_word']);
    $export_pdf = safe($_POST['export_pdf']);

    $table_list = $hc->table_list();
    foreach ($table_list as $row) {

        $table_name = $row['table_name'];
        $c = ucfirst($table_name);
        $m = ucfirst($table_name) . '_model';
        $v_list = $table_name . "_list";
        $v_read = $table_name . "_read";
        $v_form = $table_name . "_form";
        $v_doc = $table_name . "_doc";
        $v_pdf = $table_name . "_pdf";

        // url
        $c_url = strtolower($c);

        // filename
        $c_file = $c . '.php';
        $m_file = $m . '.php';
        $v_list_file = $v_list . '.php';
        $v_read_file = $v_read . '.php';
        $v_form_file = $v_form . '.php';
        $v_doc_file = $v_doc . '.php';
        $v_pdf_file = $v_pdf . '.php';

        // read setting
        $get_setting = readJSON('core/settingjson.cfg');
        $target = $get_setting->target;
        if (!file_exists($target . "views/" . $c_url))
        {
            mkdir($target . "views/" . $c_url, 0777, true);
        }

        $pk = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all = $hc->all_field($table_name);

        // generate
        include 'core/create_config_pagination.php';
        include 'core/create_controller.php';
        include 'core/create_model.php';
        if ($jenis_tabel == 'reguler_table') {
            include 'core/create_view_list.php';
        } else {
            include 'core/create_view_list_datatables.php';
            include 'core/create_libraries_datatables.php';
        }
        include 'core/create_view_form.php';
        include 'core/create_view_read.php';

        $export_excel == 1 ? include 'core/create_exportexcel_helper.php' : '';
        $export_word == 1 ? include 'core/create_view_list_doc.php' : '';
        $export_pdf == 1 ? include 'core/create_pdf_library.php' : '';
        $export_pdf == 1 ? include 'core/create_view_list_pdf.php' : '';

        $hasil[] = $hasil_controller;
        $hasil[] = $hasil_model;
        $hasil[] = $hasil_view_list;
        $hasil[] = $hasil_view_form;
        $hasil[] = $hasil_view_read;
        $hasil[] = $hasil_view_doc;
    }

    $hasil[] = $hasil_config_pagination;
    $hasil[] = $hasil_exportexcel;
    $hasil[] = $hasil_pdf;
}*/
?>
<?php 
$c_url_orig = $c_url;
if($tipo_creacion=='modulo' && strtolower($modulo)!=$c_url){
    $c_url = $modulo.'/'.$c_url;
}
$string = "";
if($estilo!=''){
    $string .= "<link rel=\"stylesheet\" href=\"<?php echo base_url('assets/".$estilo.".css') ?>\"/>";
}
$string .= '<div class="app-content content">'."\n";
$string .= '    <div class="content-overlay"></div>'."\n";
$string .= '    <div class="content-wrapper">'."\n";

$string .= '<!-- TITLE + BREADCRUMB -->'."\n";
$string .= '<div class="content-header row">'."\n";
$string .= '    <div class="content-header-left col-12 mb-2 mt-1">';
$string .= '        <div class="row breadcrumbs-top">'."\n";
$string .= '            <div class="col-12">'."\n";
$string .= '                <h5 class="content-header-title float-left pr-1 mb-0 text-capitalize"><?= $titulo ?></h5>'."\n";
$string .= '                <div class="breadcrumb-wrapper col-12">'."\n";
$string .= '                    <ol class="breadcrumb p-0 mb-0">'."\n";
$string .= '                        <li class="breadcrumb-item"><a href="<?=base_url();?>"><i class="bx bx-home-alt"></i></a>'."\n";
$string .= '                        </li>'."\n";
$string .= '                        <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>'."\n";
$string .= '                        </li>'."\n";
$string .= '                    </ol>'."\n";
$string .= '                </div>'."\n";
$string .= '            </div>'."\n";
$string .= '        </div>'."\n";
$string .= '    </div>'."\n";
$string .= '</div>'."\n";

$string .= '<div class="content-body">'."\n";
$string .= '<!-- table Transactions start -->'."\n";
$string .= '<section id="table-transactions">'."\n";
$string .= '    <div class="card">'."\n";
$string .= '        <div class="card-header">'."\n";
$string .= '            <!-- head -->'."\n";
$string .= '            <h5 class="card-title"><?php echo $total_rows ?> resultados</h5>'."\n";
$string .= '            <!-- Single Date Picker and button -->'."\n";
$string .= '            <div class="heading-elements">'."\n";
$string .= '                <ul class="list-inline mb-0">'."\n";
$string .= '                    <li>'."\n";
$string .= '                        <form action="<?php echo site_url(\''.$c_url.'/view\'); ?>" method="post">'."\n";
$string .= '                            <fieldset class="has-icon-left">'."\n";
$string .= '                                <input type="text" class="form-control single-daterange" placeholder="Buscar" name="q" value="<?= $q ?>">'."\n";
$string .= '                                <div class="form-control-position">'."\n";
$string .= '                                   <i class="bx bx-search font-medium-1"></i>'."\n";
$string .= '                                </div>'."\n";
$string .= '                            </fieldset>'."\n";
$string .= '                        </form>'."\n";
$string .= '                    </li>'."\n";

if ($action_add == '1') {
    $string .= '                    <li class="ml-2"><?php echo anchor(site_url(\''.$c_url.'/create\'), \'Añadir\', \'class="btn btn-primary add-btn"\'); ?></li>'."\n";
}

$string .= '                </ul>'."\n";
$string .= '            </div>'."\n";
$string .= '        </div>'."\n";
$string .= '        <!-- datatable start -->'."\n";
$string .= '        <div class="table-responsive">'."\n";

$string .= '            <table id="table-extended-transactions" class="table mb-0">'."\n";
$string .= '                <thead>'."\n";
$string .= '                    <tr>'."\n";


/*
        $string .="<div class=\"table-responsive\">
        <table class=\"table table-bordered table-striped estilos-tabla jambo_table bulk_action\" style=\"margin-bottom: 10px\">
        <thead>
            <tr class=\"color-fondo-tabla headings\">
                
                <th>
                    <input type=\"checkbox\" id=\"check-all\" class=\"flat\">
                </th>
";
*/

if($posicion_botones=='izquierda'){
    $string .= '                        <th>Acciones</th>'."\n";
}
$non_pk_list = array();

foreach ($non_pk as $row) {
    if(in_array($row['column_name'],$list_campos)){
        $non_pk_list[array_search($row['column_name'], $list_campos)] = $row;
    }
}
ksort($non_pk_list);

if(isset($showkey)){
    $nombrelabelkey = isset($labelkey)?$labelkey:'ID';
    $string .= '                        <th class="<?= sentidobusquedacrd(\''.$pk.'\',\''.$c_url_orig.'.\',true)?> w-80\">'."\n";
    $string .= '                            <a href=\"<?php echo site_url(\'$c_url/view?ob=\'.sentidobusquedacrd(\''.$pk.'\',\''.$c_url_orig.'.\')); ?>\">' . $nombrelabelkey . '</a>'."\n";
    $string .= '                        </th>'."\n";
}


foreach ($non_pk_list as $row) {
    if(in_array($row['column_name'],$list_campos)){
        $string .= "\n\t\t<th class=\"<?=sentidobusquedacrd('".$row['column_name']."','$c_url_orig.',true)?> \">
        <a href=\"<?php echo site_url('$c_url/view?ob='.sentidobusquedacrd('".$row['column_name']."','$c_url_orig.')); ?>\">" . label($labels[$row['column_name']]) . "</a>
        </th>";
    }
}
if($posicion_botones=='derecha'){
    $string .= '                        <th>Acciones</th>'."\n";
}
// $string .= '<th class="bulk-actions" colspan="'.(count($list_campos)+2).'">
// <a class="antoo" >Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
// </th>';
$string .= '                    </tr>'."\n";
$string .= '                </thead>'."\n";
$string .= '                <tbody>'."\n";


$string .= "                    <?\n";
$string .= "                    foreach ($" . $c_url_orig . "_data as \$row) {\n";
$string .= "                    ?>\n";
$string .= "                        <tr>\n";

/*                
$string .= "<td class=\"a-center \">
    <input type=\"checkbox\" class=\"flat\" name=\"table_records\" value=\"<?=\$row->". $pk . "?>\">
   </td>";
   */ 
   $botones = "                            <td class=\"text-left\">\n";
if($formato_botones=='iconos'){
    $botones .= "                                <a href=\"<?=site_url('".$c_url."/read/'.\$row->". $pk . ") ?>\" class=\"btn btn-xs btn-icon-only btn-info btn-table mb-1 mb-md-0\"><i class=\"bx bx-search\"></i></a>\n";
    if($action_edit == 1){
        $botones .= "                                <a href=\"<?=site_url('".$c_url."/update/'.\$row->". $pk . ") ?>\" class=\"btn btn-icon-only btn-xs btn-success btn-table mb-1 mb-md-0\"><i class=\"bx bx-edit\"></i></a>\n";
    }
    if($action_del == 1){
        $botones .= "                                <a href=\"<?=site_url('".$c_url."/delete/'.\$row->". $pk . ") ?>\" onclick=\"javascript: return confirm('Seguro que deseas eliminar este ".$objeto."?')\" class=\"btn btn-xs btn-icon-only btn-danger btn-table mb-1 mb-md-0\"><i class=\"bx bx-trash\"></i></a>\n";
    }
}
else{
    $botones .= "                                <a href=\"<?=site_url('".$c_url."/read/'.\$row->". $pk . ") ?>\" class=\"btn-text-only mb-1 mb-md-0\">Ver </a>\n";
    if($action_edit == 1){
        $botones .= "                                <a href=\"<?=site_url('".$c_url."/update/'.\$row->". $pk . ") ?>\" class=\"btn-text-only mb-1 mb-md-0\">Editar</a>\n";
    }
    if($action_del == 1){
        $botones .= "                                <a href=\"<?=site_url('".$c_url."/delete/'.\$row->". $pk . ") ?>\" onclick=\"javascript: return confirm('Seguro que deseas eliminar este ".$objeto."?')\" class=\"btn-text-only mb-1 mb-md-0\">Eliminar</a>\n";
    }
}
    $botones .= "                            </td>\n";

    if($posicion_botones=='izquierda'){
        $string .= $botones;
    }

    

    if(isset($showkey)){
        $tipo = 'int';
        $bold = isset($format_bold[$pk]) && $format_bold[$pk]!=''?1:0;
        $color = isset($format_color[$pk]) && $format_color[$pk]!=''?$format_color[$pk]:0;
        $formato = $bold.'-'.$color;
        if(isset($formato_align_key) && $formato_align_key!='')
                $align = ' class="text-'.$formato_align_key.'"';
            $string .= "\n\t\t\t<td".$align.">";
        
            $string .= "<?php echo daFormato(\$row->". $pk . ",'". $tipo . "','".$formato."','') ?>";

        $string .= "</td>";

    }                
    foreach ($non_pk_list as $row) {
        if(in_array($row['column_name'],$list_campos)){
            $ruta = '';
            $popup = '';
            $id = "''";
            if(isset($formato_align[$row['column_name']]) && $formato_align[$row['column_name']]!='')
                $align = ' text-'.$formato_align[$row['column_name']];
            
            $tipo = isset($type_format[$row['column_name']]) && $type_format[$row['column_name']]!=''?$type_format[$row['column_name']]:$row['data_type'];
            $bold = isset($format_bold[$row['column_name']]) && $format_bold[$row['column_name']]!=''?1:0;
            $color = isset($format_color[$row['column_name']]) && $format_color[$row['column_name']]!=''?$format_color[$row['column_name']]:0;
            $formato = $bold.'-'.$color;
            if(strpos($tipo,'file')!==false && !empty($ruta_file[$row['column_name']])){
                $ruta = $ruta_file[$row['column_name']];
            }
            if($tipo=='link_sufijo' && !empty($link_sufijo[$row['column_name']])){
                $ruta = $link_sufijo[$row['column_name']];
            }
            if($tipo=='relacionado' && !empty($relacion_controlador_link[$row['column_name']])){
                $ruta = $relacion_controlador_link[$row['column_name']];
                $popup = $relacion_controlador_popup[$row['column_name']];
                $id = "\$row->".$row['column_name']."_id";
            }
            if($tipo=='relacionado')
                $align = ' text-left';

            $string .= "                            <td class=\"".$align."\">";
            
            $string .= "<?php echo daFormato(\$row->". $row['column_name'] . ",'". $tipo . "','".$formato."','".$ruta."','".$popup."',".$id.") ?>";
            $string .= "</td>\n";
        }
    }

    if($posicion_botones=='derecha'){
        $string .= $botones;
    }


$string .=  "                        </tr>\n";
$string .=  "                   <?\n";
$string .=  "                   }\n";
$string .=  "                   ?>\n";
$string .=  "                </tbody>\n";
$string .=  "            </table>\n";
$string .=  "        </div>\n";
$string .=  "        <!-- datatable ends -->\n";
$string .=  "\n";

/*     
        $string .="<div class=\"row\">
            <div class=\"col-md-6\">
            
                ";
                if ($export_excel == '1') {
                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel-o\"></i> Excel', 'class=\"btn btn-primary custom\"'); ?>";
                }
                if ($export_word == '1') {
                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word-o\"></i> Word', 'class=\"btn btn-primary custom\"'); ?>";
                }
                if ($export_pdf == '1') {
                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), '<i class=\"fa fa-file-pdf-o\"></i> PDF', 'class=\"btn btn-primary custom\"'); ?>";
                }

$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
                <form method=\"get\" action=\"<?php echo site_url('$c_url/view'); ?>\" style=\"display:inline-block; vertical-align:top;margin-top:5px; margin-right:10px;\">
                <p style=\"margin:0\">Mostrando             
                <select name=\"nr\" onchange=\"this.form.submit()\">
                    <option value=\"10\" <?=\$this->session->userdata('$c_url.nr')==10?'selected':''?>>10</option>
                    <option value=\"25\" <?=\$this->session->userdata('$c_url.nr')==25?'selected':''?>>25</option>
                    <option value=\"50\" <?=\$this->session->userdata('$c_url.nr')==50?'selected':''?>>50</option>
                    <option value=\"100\" <?=\$this->session->userdata('$c_url.nr')==100?'selected':''?>>100</option>
                </select>
                
                de un total de <?php echo \$total_rows ?> registros
                </p>
                </form>

            </div>
        </div>
";*/

$string .=  "        <!-- Pagination -->\n";
$string .=  "        <nav aria-label=\"Page navigation example\">\n";
$string .=  "            <ul class=\"pagination justify-content-end mt-2 mr-2\">\n";
$string .=  "            <?\n";
$string .=  "            if(strpos(\$pagination, 'page-item previous') === FALSE && strpos(\$pagination, 'page-item activ') !== FALSE) {\n";
$string .=  "            ?>\n";
$string .=  "                <li class=\"page-item previous disabled\">\n";
$string .=  "                    <a class=\"page-link\" href=\"#\">\n";
$string .=  "                        <i class=\"bx bx-chevron-left\"></i>\n";
$string .=  "                    </a>\n";
$string .=  "                </li>\n";
$string .=  "            <?\n";
$string .=  "            }\n";
$string .=  "            ?>\n";
$string .=  "                <?= \$pagination ?>\n";
$string .=  "            <?\n";
$string .=  "            if(strpos(\$pagination, 'page-item next') === FALSE && strpos(\$pagination, 'page-item activ') !== FALSE) {\n";
$string .=  "            ?>\n";
$string .=  "                <li class=\"page-item next disabled\">\n";
$string .=  "                    <a class=\"page-link\" href=\"#\">\n";
$string .=  "                        <i class=\"bx bx-chevron-right\"></i>\n";
$string .=  "                    </a>\n";
$string .=  "                </li>\n";
$string .=  "            <?\n";
$string .=  "            }\n";
$string .=  "            ?>\n";
$string .=  "            </ul>\n";
$string .=  "        </nav>\n";
$string .=  "    </div>\n";
$string .=  "</section>\n";
$string .=  "</div>\n";
$string .=  "<!-- END -->\n";
$string .=  "</div>\n";
$string .=  "</div>\n";


if($tipo_creacion=='modulo'){
    $hasil_view_list = createFile($string, $target."views/" . $v_list_file);
    $c_url = $c_url_orig;
}
else{
    $hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);
}
?>
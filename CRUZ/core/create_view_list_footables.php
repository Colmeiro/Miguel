<?php 

$string = "";

if($estilo!=''){
    $string .= "<link rel=\"stylesheet\" href=\"<?php echo base_url('assets/".$estilo.".css') ?>\"/>";
}
$string .= "

        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-6\">
                <h2 style=\"margin-top:0px\">".ucfirst($titulo)."</h2>
            </div>
            <div class=\"col-md-4 text-center\">
                <div style=\"margin-top: 4px\"  id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class=\"col-md-2 text-right\">";
if ($action_add == '1') {
    $string .= "                <?php echo anchor(site_url('".$c_url."/create'), 'Añadir', 'class=\"btn btn-primary custom\"'); ?>";
}
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel-o\"></i> Excel', 'class=\"btn btn-primary custom\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word-o\"></i> Word', 'class=\"btn btn-primary custom\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), '<i class=\"fa fa-file-pdf-o\"></i> PDF', 'class=\"btn btn-primary custom\"'); ?>";
}

$pagelength = isset($numregistros)?$numregistros:10;

$string .= "\n\t    </div>
        </div>
        <table class=\"table table-bordered table-striped estilos-tabla\" id=\"mytable\" data-sorting=\"true\" data-paging=\"true\" data-paging-size=\"".$pagelength."\" data-filtering=\"true\">
            <thead>
                <tr class=\"color-fondo-tabla\">
                    ";

$non_pk_list = array();

foreach ($non_pk as $row) {
    if(in_array($row['column_name'],$list_campos)){
        $non_pk_list[array_search($row['column_name'], $list_campos)] = $row;
    }
}
ksort($non_pk_list);

$ordenlista=1;
$direccionordenlista = 'desc';
$incremento = 0;



$string .= "\n\t\t    <th width=\"100px\"></th>";
if(isset($showkey)){
    $nombrelabelkey = isset($labelkey)?$labelkey:'ID';
    $string .= "<th width=\"20px\"";
    
    if(isset($list_orden[$pk])){
        //$ordenlista = $list_posicion[$pk];
        $direccionordenlista = $list_ordendirection[$pk];
        $string .= " data-sorted=\"true\" data-direction=\"".$direccionordenlista."\"";
    }
    $string .= ">".$nombrelabelkey."</th>";
    $incremento = 1;
}
//<th width=\"20px\">ID</th>";
//$non_pk = $non_pk_list;

foreach ($non_pk_list as $row) {
    $align = '';
    if(in_array($row['column_name'],$list_campos)){
        if(isset($formato_align[$row['column_name']]) && $formato_align[$row['column_name']]!='')
            $align = ' class="text-'.$formato_align[$row['column_name']].'"';
        $string .= "\n\t\t    <th".$align."";
        
        if(isset($list_orden[$row['column_name']])){
            $ordenlista = $list_posicion[$row['column_name']]+$incremento;
            $direccionordenlista = $list_ordendirection[$row['column_name']];
            $string .= " data-sorted=\"true\" data-direction=\"".$direccionordenlista."\"";
        }
        $string .= ">" . label($labels[$row['column_name']]) . "</th>";
    }
}
$string .= "
                </tr>
            </thead>";



            $string .= "<?php
            foreach ($" . $c_url . "_data as \$row)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td class=\"text-center\">
\n\t <a href=\"<?=site_url('".$c_url."/read/'.\$row->". $pk . ") ?>\" class=\"btn btn-icon-only btn-info btn-table\"><i class=\"fa fa-search\"></i></a>";
if($action_edit == 1){
    $string .= "\n\t <a href=\"<?=site_url('".$c_url."/update/'.\$row->". $pk . ") ?>\" class=\"btn btn-icon-only btn-info btn-table\"><i class=\"fa fa-edit\"></i></a>  ";
}
if($action_del == 1){
    $string .= "\n\t <a href=\"<?=site_url('".$c_url."/delete/'.\$row->". $pk . ") ?>\" onclick=\"javascript: return confirm('Seguro que deseas eliminar este Oportunidad?')\" class=\"btn btn-icon-only btn-danger btn-table\"><i class=\"fa fa-trash\"></i></a>";
}
$string .= "\n\t </td>";
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
    $align = '';
    $formato = '';
    $ruta = '';
    if(in_array($row['column_name'],$list_campos)){
        if(isset($formato_align[$row['column_name']]) && $formato_align[$row['column_name']]!='')
            $align = ' class="text-'.$formato_align[$row['column_name']].'"';
        $string .= "\n\t\t\t<td".$align.">";
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
        
        $string .= "<?php echo daFormato(\$row->". $row['column_name'] . ",'". $tipo . "','".$formato."','".$ruta."') ?>";
        $string .= "</td>";
    }
}

$string .= "\n\t <? }?></tr>";

$string .= "\n\t    
        </table>";

        
$column_non_pk = array();




$string .= "
        <script src=\"<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>\"></script>
        <script src=\"<?php echo base_url('assets/footables/js/footable.min.js') ?>\"></script>
        <script type=\"text/javascript\">
            $(document).ready(function() {
                $('#mytable').footable();
            });


        </script>
";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>
<?php 

$string = "
        <h2 style=\"margin-top:0px\">".ucfirst($titulo)."</h2>
        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-3\">";
            if ($action_add == '1') {
                $string .= "<?php echo anchor(site_url('".$c_url."/create'), 'Añadir', 'class=\"btn btn-primary\"'); ?>";
            }

            
            
            $string .= "\n\t</div>
            <div class=\"col-md-4 text-right\">
                <form action=\"<?php echo site_url('$c_url/view'); ?>\" class=\"form-inline\" method=\"post\">
                    <div class=\"input-group\">
                        <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                        <span class=\"input-group-btn\">
                            <?php 
                                if (\$q <> '')
                                {
                                    ?>
                                    <a href=\"<?php echo site_url('$c_url'); ?>\" class=\"btn btn-default\">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class=\"btn btn-primary\" type=\"submit\"><i class=\"fa fa-search\"></i> </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class=\"col-md-2 text-center\">
                <div style=\"margin-top: 8px\" id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class=\"col-md-3 text-right\" style=\"margin-top:13px\">
            <form method=\"get\" action=\"<?php echo site_url('$c_url/view'); ?>\">
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
        <table class=\"table table-bordered\" style=\"margin-bottom: 10px\">
            <tr>
                <th width=\"100px\"></th>
";
$non_pk_list = array();

foreach ($non_pk as $row) {
    if(in_array($row['column_name'],$list_campos)){
        $non_pk_list[array_search($row['column_name'], $list_campos)] = $row;
    }
}
ksort($non_pk_list);

if(isset($showkey)){
    $nombrelabelkey = isset($labelkey)?$labelkey:'ID';
    $string .= "<th width=\"20px\" class=\"sortable\">
    <a class=\"<?=sentidobusqueda('".$pk."','$c_url.',true)?>\" href=\"<?php echo site_url('$c_url/view?ob='.sentidobusqueda('".$pk."','$c_url.')); ?>\">" . $nombrelabelkey . "</a>
    </th>";
}


foreach ($non_pk_list as $row) {
    if(in_array($row['column_name'],$list_campos)){
        $string .= "\n\t\t<th class=\"sortable\">
        <a class=\"<?=sentidobusqueda('".$row['column_name']."','$c_url.',true)?>\" href=\"<?php echo site_url('$c_url/view?ob='.sentidobusqueda('".$row['column_name']."','$c_url.')); ?>\">" . label($labels[$row['column_name']]) . "</a>
        </th>";
    }
}

$string .= "
            </tr>";

$string .= "\n<?php
            foreach ($" . $c_url . "_data as \$row)
            {
                ?>
                <tr>";

    $string .= "\n\t\t\t<td width=\"150px\" class=\"text-center\">
    \n\t <a href=\"<?=site_url('".$c_url."/read/'.\$row->". $pk . ") ?>\" class=\"btn btn-icon-only btn-info btn-table\"><i class=\"fa fa-search\"></i></a>";
    if($action_edit == 1){
        $string .= "\n\t <a href=\"<?=site_url('".$c_url."/update/'.\$row->". $pk . ") ?>\" class=\"btn btn-icon-only btn-info btn-table\"><i class=\"fa fa-edit\"></i></a>  ";
    }
    if($action_del == 1){
        $string .= "\n\t <a href=\"<?=site_url('".$c_url."/delete/'.\$row->". $pk . ") ?>\" onclick=\"javascript: return confirm('Seguro que deseas eliminar este ".$objeto."?')\" class=\"btn btn-icon-only btn-danger btn-table\"><i class=\"fa fa-trash\"></i></a>";
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
        if(in_array($row['column_name'],$list_campos)){
            $ruta = '';
            if(isset($formato_align[$row['column_name']]) && $formato_align[$row['column_name']]!='')
                $align = ' text-'.$formato_align[$row['column_name']];
            $string .= "\n\t\t\t<td class=\"".$align."\">";
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




$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        <div class=\"row\">
            <div class=\"col-md-6\">
            
                ";
                if ($export_excel == '1') {
                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel-o\"></i> Excel', 'class=\"btn btn-gris\"'); ?>";
                }
                if ($export_word == '1') {
                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word-o\"></i> Word', 'class=\"btn btn-gris\"'); ?>";
                }
                if ($export_pdf == '1') {
                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), '<i class=\"fa fa-file-pdf-o\"></i> PDF', 'class=\"btn btn-gris\"'); ?>";
                }
$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
                <?php echo \$pagination ?>
            </div>
        </div>
";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>
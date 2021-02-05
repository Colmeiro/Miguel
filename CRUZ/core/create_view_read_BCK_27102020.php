<?php 

$c_url_orig = $c_url;
if($tipo_creacion=='modulo' && strtolower($modulo)!=$c_url){
    $c_url = $modulo.'/'.$c_url;
}

$string = "";

$string .= '<div class="app-content content">'."\n";
$string .= '    <div class="content-overlay"></div>'."\n";
$string .= '    <div class="content-wrapper">'."\n";

$string .= '        <!-- TITLE + BREADCRUMB -->'."\n";
$string .= '        <div class="content-header row">'."\n";
$string .= '            <div class="content-header-left col-12 mb-2 mt-1">';
$string .= '                <div class="row breadcrumbs-top">'."\n";
$string .= '                    <div class="col-12">'."\n";
$string .= '                        <h5 class="content-header-title float-left pr-1 mb-0 text-capitalize"><?= $titulo ?></h5>'."\n";
$string .= '                        <div class="breadcrumb-wrapper col-12">'."\n";
$string .= '                            <ol class="breadcrumb p-0 mb-0">'."\n";
$string .= '                                <li class="breadcrumb-item"><a href="<?=base_url();?>"><i class="bx bx-home-alt"></i></a>'."\n";
$string .= '                                </li>'."\n";
$string .= '                                <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>'."\n";
$string .= '                                </li>'."\n";
$string .= '                            </ol>'."\n";
$string .= '                        </div>'."\n";
$string .= '                    </div>'."\n";
$string .= '                </div>'."\n";
$string .= '            </div>'."\n";
$string .= '        </div>'."\n";
$string .= "\n";
$string .= '        <div class="content-body">'."\n";
$string .= '			<!-- table Transactions start -->'."\n";
$string .= '			<section id="table-transactions">'."\n";
$string .= '				<div class="row match-height">'."\n";
$string .= '					<div class="col-md-6 col-12">'."\n";
$string .= '						<div class="card">'."\n";
$string .= '							<!-- datatable start -->'."\n";
$string .= '							<div class="table-responsive">'."\n";

$string .= '								<table id="table-extended-transactions" class="table mb-2">'."\n";
foreach ($non_pk as $row) {
    $ruta = '';
    $string .= "\n\t    <tr><td class=\"font-weight-bold\">".label($labels[$row["column_name"]])."</td><td>";
    if(isset($relaciones[$row['column_name']])){
        
        $string .= "<? foreach(\$s_".$row["column_name"]." as \$c){
            if(\$c->".$relaciones_tabla_campo[$row["column_name"]]."==\$data_fields['".$row["column_name"]."']){
                echo \$c->".$relaciones_tabla_campo_mostrar[$row["column_name"]].";
            }
            
        }?>";
       //$string .= "</td></tr>";
    }
    else{
        if(isset($formato_align[$row['column_name']]) && $formato_align[$row['column_name']]!='')
            $align = ' text-'.$formato_align[$row['column_name']];
//        $string .= "\n\t\t\t<td class=\"".$align."\">";
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
        
        $string .= "<?php echo daFormato(\$data_fields['". $row['column_name'] . "'],'". $tipo . "','".$formato."','".$ruta."') ?>";
/*
        switch($row['data_type']){
            case 'float':
            case 'decimal':
            $string .= "<?php echo number_format($".$row["column_name"].",2,',','.'); ?>";
            break;
            case 'date':
                $string .= "<?php echo date('d-m-Y',strtotime($".$row["column_name"].")); ?>";
            break;
            case 'datetime':
                $string .= "<?php echo date('d-m-Y H:i:s',strtotime($".$row["column_name"].")); ?>";
            break;
            case 'tinyint':
            $string .= "<?php if($".$row["column_name"]."==1){ \$check = 'checked=\"checked\"';} else \$check='';
                ?>
                <input type=\"checkbox\" <?=\$check?> disabled>";
            break;
            default:
                $string .= "<?php echo $".$row["column_name"]."; ?>";
        }
        */
        
    }
    $string .= "</td></tr>";
}
$string .= "								</table>\n";
$string .= "							</div>\n";
$string .= "							<div class=\"col-12 d-flex justify-content-start\">\n";

$string .= "								<a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-light-secondary mr-1 mb-1\"><i class=\"bx bx-chevrons-left\"></i>Volver</a>";

$string .= "							</div>\n";
$string .= "                        </div>\n";
$string .= "                    </div>\n";
$string .= "                </div>\n";
$string .= "            </section>\n";
$string .= "\n";

$string .= "        </div>\n";
$string .= "    </div>\n";
$string .= "</div>\n";


if($tipo_creacion=='modulo'){
    $hasil_view_read = createFile($string, $target."views/"  . $v_read_file);
    $c_url = $c_url_orig;
}
else{
    $hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);
}


?>
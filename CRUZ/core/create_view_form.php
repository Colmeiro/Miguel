<?php 
$c_url_orig = $c_url;
if($tipo_creacion=='modulo' && strtolower($modulo)!=$c_url){
    $c_url = $modulo.'/'.$c_url;
}

$string = "";

$string .= '<div class="app-content content">'."\n";
$string .= '    <div class="content-overlay"></div>'."\n";
$string .= '    <div class="content-wrapper">'."\n";

$string .= '            <!-- TITLE + BREADCRUMB -->'."\n";
$string .= '            <div class="content-header row">'."\n";
$string .= '                <div class="content-header-left col-12 mb-1 mb-sm-2 mt-1">';
$string .= '                    <div class="row breadcrumbs-top">'."\n";

$string .= '                        <div class="breadcrumb-wrapper col-12 d-xl-none">'."\n";
$string .= '                            <ol class="breadcrumb br">'."\n";
$string .= '                                <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="bx bx-home-alt"></i></a>'."\n";
$string .= '                                </li>'."\n";
$string .= '                                <li class="breadcrumb-item active text-capitalize"><?= $titulo ?>'."\n";
$string .= '                                </li>'."\n";
$string .= '                            </ol>'."\n";
$string .= '                        </div>'."\n";

$string .= '                        <div class="col-12">'."\n";
$string .= '                            <h4 class="content-header-title float-left no-border mb-0 text-capitalize"><i class="bx bx-group"></i><?= $titulo ?></h4>'."\n";
$string .= '                        </div>'."\n";

$string .= '                    </div>'."\n";
$string .= '                </div>'."\n";
$string .= '            </div>'."\n";

$string .= '<div class="content-body">'."\n";

$string .= '	<section id="basic-vertical-layouts">'."\n";
$string .= '		<div class="row match-height">'."\n";
$string .= '			<div class="col-md-6 col-12">'."\n";
$string .= '				<div class="card">'."\n";
$string .= '					<? if (isset($subtitulo) && $subtitulo==\'Añadir\') {'."\n";
$string .= '					    $bg_card="bg-light-blue";'."\n";
$string .= '					    $dots="";'."\n";
$string .= '					} else{'."\n";
$string .= '					    $bg_card="bg-light-green";'."\n";
$string .= '					    $dots=": ";'."\n";
$string .= '					}?>'."\n";
$string .= '					<div class="card-header <?=$bg_card?> mb-2">'."\n";
$string .= '						<h4 class="card-title color-white"><?=isset($subtitulo) ? $subtitulo : \'\'?><?=$dots;?> <?php echo daFormato($data_fields[\'nombre\'], \'varchar\', \'0-#ffffff\', \'\') ?></h4>'."\n";
$string .= '					</div>'."\n";
$string .= '					<div class="card-content">'."\n";
$string .= '						<div class="card-body card-body-xs">'."\n";

if($concampofile){
    $extraform = ' enctype="multipart/form-data"';
}
else{
    $extraform = '';
}

// $string = "";
// if($template=='adminlte'){
//     $string .= '<div class="box"><div class="box-header">';
// }

/*
$string .= "        <h2 style=\"margin-top:0px\"><?php echo \$button ?> ".ucfirst($objeto)." </h2>";
if($template=='adminlte'){
    $string .= '</div><div class="box-body">';
} */

$string .= "						<? if(isset(\$data_fields)) extract(\$data_fields); //Provisional ?>\n\n";
$string .= "						    <form class=\"form form-vertical form-edit\" action=\"<?php echo \$action; ?>\" method=\"post\"".$extraform.">\n";
$string .= "						        <div class=\"form-body\">\n";
$string .= "						            <div class=\"row\">\n";

$non_pk_edit = array();

foreach ($non_pk as $row) {
    if(in_array($row['column_name'],$edit_campos)){
        $non_pk_edit[array_search($row['column_name'], $edit_campos)] = $row;
    }
}
ksort($non_pk_edit);

//$non_pk = $non_pk_edit;

foreach ($non_pk_edit as $row) {
    if(in_array($row['column_name'],$edit_campos)){
        $required = isset($requeridos[$row['column_name']])?' required':'';
        $requiredf = isset($requeridos[$row['column_name']])?'1':'0';
        if(isset($relaciones[$row['column_name']])){
            $string .= "						            <div class=\"col-12\">\n";
            $string .= "						                <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
                <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <select class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" ".$required.">";
                if(!isset($requeridos[$row['column_name']])){
                    $string .= "<option value=''>Seleccionar ".label($labels[$row["column_name"]])."</option>";    
                }
                $string .= "<? foreach(\$s_".$row["column_name"]." as \$c){
                    ?>
                    <option value=\"<?=\$c->".$relaciones_tabla_campo[$row["column_name"]]."?>\" <?=\$c->".$relaciones_tabla_campo[$row["column_name"]]."==\$data_fields['".$row["column_name"]."']?'selected=\"selected\"':''?>><?=\$c->".$relaciones_tabla_campo_mostrar[$row["column_name"]]."?></option>
                    <?
                }?>";    
            $string .= "</select>
            <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            $string .= "						            </div>\n";
        }
        else{
            $string .= "						            <div class=\"col-12\">\n";
            $string .= "						                <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
            <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>";
            $string .= "\n\t<?=daFormatoEdit(\$data_fields['".$row["column_name"]."'],'".$row["column_name"]."','".label($labels[$row["column_name"]])."','".$row['data_type']."','".$type_format[$row['column_name']]."',".$requiredf.");?>";
            if(strpos($type_format[$row['column_name']],'file')!==false){
                $string .= "\n\t<? if (!empty(\$this->session->flashdata('error_upload'))) { ?> <span class=\"help-block\"><?= \$this->session->flashdata('error_upload') ?></span> <? }?>";
            }
            $string .= "\n<? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            $string .= "						            </div>\n";
        }
        /*
        switch($row["data_type"]){
            case 'text':
            $string .= "\n\t    <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
                <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($labels[$row["column_name"]])."\" ".$required."><?php echo $".$row["column_name"]."; ?></textarea>
                <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            break;
            case 'tinyint':
            $string .= "\n\t    <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
            <?
            if($".$row["column_name"]."==1){}
            ?>
                <label for=\"".$row["column_name"]."\">
                <input type=\"checkbox\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" value=\"1\" <?=$".$row["column_name"]."==1?'checked=\"checked\"':''?> ".$required.">
                ".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            break;
            case 'date':
            $string .= "\n\t    <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
                <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <input type=\"date\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($labels[$row["column_name"]])."\" value=\"<?php echo $".$row["column_name"]."; ?>\"  ".$required."/>
                <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            break;
            case 'datetime':
            $string .= "\n\t    <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
                <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <input type=\"datetime\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($labels[$row["column_name"]])."\" value=\"<?php echo $".$row["column_name"]."; ?>\"  ".$required."/>
                <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            break;
            case 'int':
            $string .= "\n\t    <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
                <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <input type=\"number\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($labels[$row["column_name"]])."\" value=\"<?php echo $".$row["column_name"]."; ?>\"  ".$required."/>
                <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            break;
            case 'float':
            case 'decimal':
            $string .= "\n\t    <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
                <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <input type=\"number\" step=\"0.01\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($labels[$row["column_name"]])."\" value=\"<?php echo $".$row["column_name"]."; ?>\"  ".$required."/>
                <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            break;
            default:
            $string .= "\n\t    <div class=\"form-group<?=form_error('".$row["column_name"]."')!=''?' has-error':''?>\">
                <label for=\"".$row["column_name"]."\">".label($labels[$row["column_name"]])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($labels[$row["column_name"]])."\" value=\"<?php echo $".$row["column_name"]."; ?>\"  ".$required."/>
                <? if(form_error('".$row["column_name"]."')!=''){?> <span class=\"help-block\"><?=form_error('".$row["column_name"]."')?></span> <? }?>
            </div>";
            break;
        }*/
        /*
        if ($row["data_type"] == 'text')
        {
        $string .= "\n\t    <div class=\"form-group\">
                <label for=\"".$row["column_name"]."\">".$row["data_type"]."".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
            </div>";
        } else
        {
        $string .= "\n\t    <div class=\"form-group\">
                <label for=\"".$row["data_type"]."\">".$row["data_type"]."".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
                <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
            </div>";
        }
        */
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";

$string .= "						            <div class=\"col-6 d-flex justify-content-start\">\n";
$string .= "\n\t                                    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-light-secondary ml-0\"><i class=\"bx bx-chevrons-left\"></i>Volver</a>";
$string .= "						            </div>\n";
$string .= "						            <div class=\"col-6 d-flex justify-content-end\">\n";
$string .= "\n\t                                    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "						            </div>\n";

$string .= "                                </div>\n";
$string .= "                            </div>\n";
$string .= "                        </form>\n";
$string .= "                    </div>\n";
$string .= "                </div>\n";
$string .= "            </div>\n";
$string .= "        </div>\n";
$string .= "    </div>\n";
$string .= "</section>\n";
$string .= "</div>\n";
$string .= "</div>\n";
$string .= "</div>\n";

// if($template=='adminlte'){
//     $string .= '</div></div>';
// }

if($tipo_creacion=='modulo'){
    $hasil_view_form = createFile($string, $target."views/" . $v_form_file);
    $c_url = $c_url_orig;
}
else{
    $hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);
}

?>
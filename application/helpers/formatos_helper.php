<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function daFormato($valor,$tipo,$formato,$ruta='',$popup='',$id=''){
    if($valor=='')
        return $valor;
    $hascolor=false;
    $color='';
    $bold = 0;
    if($formato!=''){
        $frmt = explode('-',$formato);
        $bold = $frmt[0];
        if(isset($frmt[1]) && $frmt[1]!='' && $frmt[1]!='#333333'){
            $hascolor=true;
            $color = ' style="color:'.$frmt[1].'"';
        }
    }
    $return2 ='';

    switch($tipo){
        case 'tinyint':
        case 'checkbox':
        if ($valor == "1") {
            $return = '<input type="checkbox" disabled checked value="'.$valor.'">';
        } else {
            $return = '<input type="checkbox" disabled value="'.$valor.'">';
        }
        break;
        case 'decimal':
        case 'float':
            $return = number_format($valor,2,',','.');
        break;
        case 'currency':
            $return = number_format($valor,2,',','.').' €';
        break;
        case 'percent':
            $return = number_format($valor,2,',','.').' %';
        break;
        case 'date':
            $return = date('d/m/Y',strtotime($valor));
        break;
        case 'datetime':
            $return = date('d/m/Y H:i:s',strtotime($valor));
        break;
        case 'year':
            $return = date('Y', strtotime($valor));
        break;
        case 'month':
            $return = date('m', strtotime($valor));
        break;
        case 'str_month':
            $return = getStrMonth(date('m', strtotime($valor)));
        break;
        case 'month_day':
            $return = date('d', strtotime($valor));
        break;
        case 'str_week_day':
            $return = getStrWeekDay(date('w', strtotime($valor)));
        break;
        case 'time':
            $return = date('H:i:s',strtotime($valor));
        break;
        case 'sec_to_time':
            $return = getTimeFromSec($valor);
        break;
        case 'email':
            $return = '<a href="mailto:'.$valor.'">'.$valor.'</a>';
        break;
        case 'email_ver':
            $return = '<a href="mailto:'.$valor.'">Correo</a>';
        break;
        case 'link':
            $return = '<a href="'.$valor.'" target="_blank">'.$valor.'</a>';
        break;
        case 'link_ver':
            $return = '<a href="'.$valor.'" target="_blank">Ver</a>';
        break;
        case 'link_sufijo':
            $return = '<a href="'.$ruta.$valor.'" target="_blank">'.$valor.'</a>';
        break;
        case 'relacionado':
            if($ruta!=''){
                if($popup!=''){
                    $return = '<a href="#" onClick="vermodalajax(\''.site_url($ruta).$id.'\')">'.$valor.'</a>';
                }
                else{
                    $return = '<a href="'.site_url($ruta).$id.'">'.$valor.'</a>';
                }
            }
            else    $return = $valor;
            
        break;
        case 'file':
            $ruta = base_url().str_replace('../','',$ruta);
            $return = '<a href="'.$ruta.$valor.'" target="_blank"><i class="fa fa-file-pdf-o"></i></a>';
        break;
        case 'file_image':
            $ruta = base_url().str_replace('../','',$ruta);
            $return = '<img src="'.$ruta.$valor.'" width="100px" />';
        break;
        case 'text':
        case 'html':
            $rand = rand();
            $return = '<a href="#" onClick="vermodal(\'t'.$rand.'\')">'.substr($valor,0,50).'...</a>';
            $return2 = '<div id="t'.$rand.'" style="display:none">'.$valor.'</div>';
        break;
        case 'html_ver':
            $rand = rand();
            $return = '<a href="#" onClick="vermodal(\'t'.$rand.'\')">Ver</a>';
            $return2 = '<div id="t'.$rand.'" style="display:none">'.$valor.'</div>';
        break;
        case 'varchar':
            if (filter_var($valor, FILTER_VALIDATE_EMAIL)) {
                $return = '<a href=""mailto:'.$valor.'">'.$valor.'</a>';
            }else
            if (filter_var($valor, FILTER_VALIDATE_URL)) {
                $return = '<a href="'.$valor.'" traget="_blank">'.$valor.'</a>';
            }else
                $return = $valor;
        default:
            $return = $valor;
    }
    if($bold){
        $return = '<strong'.$color.'>'.$return.'</strong>';
    }
    else
        if($hascolor){
            $return = '<span'.$color.'>'.$return.'</span>';
        }

    return $return.$return2;
}

function getTimeFromSec($seconds)
{
    if(empty($seconds))
    {
        return '';
    }
    
    $hours = floor($seconds / 3600);
    $mins = floor($seconds / 60 % 60);
    $secs = floor($seconds % 60);

    return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
}

function getStrMonth($month)
{
    switch($month)
    {
        case 1:
            $strMonth = 'enero';
        break;
        case 2:
            $strMonth = 'febrero';
        break;
        case 3:
            $strMonth = 'marzo';
        break;
        case 4:
            $strMonth = 'abril';
        break;
        case 5:
            $strMonth = 'mayo';
        break;
        case 6:
            $strMonth = 'junio';
        break;
        case 7:
            $strMonth = 'julio';
        break;
        case 8:
            $strMonth = 'agosto';
        break;
        case 9:
            $strMonth = 'septiembre';
        break;
        case 10:
            $strMonth = 'octubre';
        break;
        case 11:
            $strMonth = 'noviembre';
        break;
        case 12:
            $strMonth = 'diciembre';
        break;
        default:
            $strMonth = '';
        break;
    }
    return $strMonth;
}

function getStrWeekDay($weekDay)
{
    switch($weekDay)
    {
        case 0:
            $strWeekDay = 'domingo';
        break;
        case 1:
            $strWeekDay = 'lunes';
        break;
        case 2:
            $strWeekDay = 'martes';
        break;
        case 3:
            $strWeekDay = 'miércoles';
        break;
        case 4:
            $strWeekDay = 'jueves';
        break;
        case 5:
            $strWeekDay = 'viernes';
        break;
        case 6:
            $strWeekDay = 'sabado';
        break;
        default:
            $strWeekDay = '';
        break;
    }
    return $strWeekDay;
}

function daFormatoEdit($valor,$nombre,$label,$tipo,$formato, $required, $class='form-control'){
    $required = $required==1?' required':'';
    if($formato=='readonly'){
        $required .= ' readonly';
        $formato=$tipo;
    }
    switch($formato){
        case 'tinyint':
        case 'checkbox':
        
        if ($valor == "1") {
            return '<input type="checkbox" name="'.$nombre.'" id="'.$nombre.'" value="1" checked '.$required.'>';
        } else {
            return '<input type="checkbox" name="'.$nombre.'" id="'.$nombre.'" value="1" '.$required.'>';
        }
        break;
        case 'text':
        case 'html':
        case 'html_ver':
            return '<textarea class="'.$class.'" rows="7" name="'.$nombre.'" id="'.$nombre.'"  '.$required.'>'.$valor.'</textarea>';
        break;
        case 'date':
            if($tipo=='datetime'){
                $type='text';
            }
            else
                $type='date';
            return '<input type="'.$type.'" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.date('Y-m-d',strtotime($valor)).'" '.$required.'/>';
        break;
        case 'datetime':
            return '<input type="text" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.'/>';
        break;
        case 'int':
            return '<input type="number" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.'/>';
        break;
        case 'decimal':
        case 'float':
            return '<input type="number" step="0.01" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.'/>';
        break;
        case 'email':
        case 'email_ver':
            return '<input type="email" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.' />';
        break;
        case 'password':
            return '<input type="password" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.' />';
        break;
        case 'color':
            return '<input type="color" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.' />';
        break;
        case 'file':
        case 'file_image':
            if($valor!='')
                $required = '';
            else
                $required = $required;

            return '<input type="file" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.' />
            <p>'.$valor.'</p>';
        break;
        case 'link':
        case 'link_ver':
        case 'varchar':
        case 'decimal':
        case 'float':
        case 'currency':
        default:
            //return '<input type="text" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'" placeholder="'.$label.'" value="'.$valor.'" '.$required.' />';
            return '<input type="text" class="'.$class.'" name="'.$nombre.'" id="'.$nombre.'"  value="'.$valor.'" '.$required.' />';
    }
}

function sentidobusquedacrd($campo,$prefix,$showclass=FALSE){

	if(isset($_SESSION[$prefix.'oc']) && $_SESSION[$prefix.'oc']==$campo){
		if($_SESSION[$prefix.'od']=='ASC'){
			$dir = 'd'.$campo;
			$class = 'sorting_asc';
		}
		else{
			$dir = 'a'.$campo;
			$class = 'sorting_desc';
		}
	}
	else{
		$dir = 'a'.$campo;
		$class = 'sorting';
	}
	if($showclass){
		return $class;
	}
	else
	return $dir;
}
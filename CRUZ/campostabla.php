<?
error_reporting(0);
require_once 'core/CRUZcode.php';
require_once 'core/helper.php';
require_once 'core/process.php';


$tabla = $_POST['table_name'];

$campos = $hc->all_field($tabla);
?>

<?
foreach($campos as $c){
    ?>
    <option value='<?=$c['column_name']?>'><?=$c['column_name']?></option>
    <?
}
?>
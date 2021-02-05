<?php 

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $m . " extends CI_Model
{

    public \$table = '$table_name';
    public \$id = '$pk';
    public \$order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }";

    $column_all = array();
    $column_all_s = array();
    $joins = array();
    foreach ($all as $row) {
        if(in_array($row['column_name'],$list_campos)){
            if(isset($relaciones[$row['column_name']])){
                $column_all[] = $relaciones_tabla[$row['column_name']].'.'.$relaciones_tabla_campo_mostrar[$row['column_name']] .' as '.$row['column_name'];
                $column_all[] = $table_name.'.'.$row['column_name'].' as '.$row['column_name'].'_id';
                $column_all_s[] = $relaciones_tabla[$row['column_name']].'.'.$relaciones_tabla_campo_mostrar[$row['column_name']];
                $joins[] = '$this->datatables->join("'.$relaciones_tabla[$row['column_name']].'","'.$table_name.'.'.$row['column_name'].' = '.$relaciones_tabla[$row['column_name']].'.'.$relaciones_tabla_campo[$row['column_name']].'","left");';
                $joins_regular[] = '$this->db->join("'.$relaciones_tabla[$row['column_name']].'","'.$table_name.'.'.$row['column_name'].' = '.$relaciones_tabla[$row['column_name']].'.'.$relaciones_tabla_campo[$row['column_name']].'","left");';
    
            }
            else{
                $column_all[] = $table_name.'.'.$row['column_name'];
                $column_all_s[] = $table_name.'.'.$row['column_name'];
            }
            if(isset($list_orden[$row['column_name']])){
                $ordenlista = $table_name.'.'.$row['column_name'];
                $direccionordenlista = $list_ordendirection[$row['column_name']];
            }
                
        }
    }    
$column_all[] = $pk;
if(isset($list_orden[$pk])){
    $ordenlista = $table_name.'.'.$pk;
    $direccionordenlista = $list_ordendirection[$pk];
}
$columnall = implode(',', $column_all);

if ($jenis_tabel == 'datatables') {
    

$columnall = implode(',', $column_all);
    
$string .="\n\n    // datatables
    function json() {
        \$atts=array('class'=>'btn btn-icon-only btn-info');
        \$this->datatables->add_column('action', anchor(site_url('".$c_url."/read/\$1'),'<i class=\"fa fa-search\"></i>','class=\"btn btn-icon-only btn-info\"')";
if($action_edit == 1){
        $string .=".\"  \".anchor(site_url('".$c_url."/update/\$1'),'<i class=\"fa fa-edit\"></i>','class=\"btn btn-icon-only btn-info\"')";
}
if($action_del == 1){
        $string .=".\"  \".anchor(site_url('".$c_url."/delete/\$1'),'<i class=\"fa fa-trash\"></i>','onclick=\"javascript: return confirm(\\'Seguro que deseas eliminar este ".$objeto."?\\')\" class=\"btn btn-icon-only btn-danger\"')";
}
        $string .=", '$pk');
        \$this->datatables->select('".$columnall."');
        \$this->datatables->from('".$table_name."');";
        if(isset($extrawhere) && $extrawhere!=''){
            $string .="\$this->datatables->where('".$extrawhere."');";
        }
        //add this line for join
        //\$this->datatables->join('table2', '".$table_name.".field = table2.field');
        if(count($joins)>0){
            foreach($joins as $j){
                $string .="\n$j";
            }
        }
$string .="
        return \$this->datatables->generate();
    }";
}

$string .="\n\n    // get all
    function get_all()
    {
        ";
if ($jenis_tabel == 'datatables') {        
    $string .="        \$this->datatables->select('".$columnall."');";
}
else{
    $string .="        \$this->db->select('".$columnall."');";
}

$string .="        
        \$this->db->order_by(\$this->id, \$this->order);";
        if(isset($extrawhere) && $extrawhere!=''){
            $string .="\$this->db->where('".$extrawhere."');";
        }
        if(count($joins_regular)>0){
            foreach($joins_regular as $j){
                $string .="\n$j";
            }
        }
 $string .=       "return \$this->db->get(\$this->table)->result();
    }
";
/*
$columns_all_select = array();
foreach ($all as $row) {
    if(in_array($row['column_name'],$list_campos)){
        if(isset($relaciones[$row['column_name']])){
            $columns_all_select[] = $relaciones_tabla[$row['column_name']].'.'.$relaciones_tabla_campo_mostrar[$row['column_name']] .' as '.$row['column_name'];
            $joins[] = '$this->datatables->join("'.$relaciones_tabla[$row['column_name']].'","'.$table_name.'.'.$row['column_name'].' = '.$relaciones_tabla[$row['column_name']].'.'.$relaciones_tabla_campo[$row['column_name']].'","left");';
        }
        else
            $columns_all_select[] = $table_name.'.'.$row['column_name'];
    }
}*/
$string .="
    // get data by id
    function get_by_id(\$id)
    {
        \$this->db->where(\$this->id, \$id);
        return \$this->db->get(\$this->table)->row();
    }
    
    // get total rows
    function total_rows(\$q = NULL) {
        \$this->db->select('".$columnall."');
        ";

        if(isset($extrawhere) && $extrawhere!=''){
            $string .="\$this->db->where('".$extrawhere."');";
        }
        if(count($joins_regular)>0){
            foreach($joins_regular as $j){
                $string .="\n$j";
            }
        }
/*foreach ($non_pk as $row) {
    if(in_array($row['column_name'],$list_campos)){
        $string .= "\n\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
    }
}*/    
$string .= "\nif(!empty(\$q)){\n";        
$string .= "        \$this->db->like('$pk', \$q);";
foreach ($column_all_s as $campo) {
    $string .= "\n\t\$this->db->or_like('" . $campo ."', \$q);";
}
$string .= "\n}";
$string .= "\n\t\$this->db->from(\$this->table);
        return \$this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data(\$limit, \$start = 0, \$q = NULL, \$oc='', \$od='') {
        \$this->db->select('".$columnall."');
        
        ";
        if(isset($extrawhere) && $extrawhere!=''){
            $string .="\$this->db->where('".$extrawhere."');";
        }
        if(count($joins_regular)>0){
            foreach($joins_regular as $j){
                $string .="\n$j";
            }
        }
/*foreach ($non_pk as $row) {
    if(in_array($row['column_name'],$list_campos)){
        $string .= "\n\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
    }
}*/
$string .= "\nif(!empty(\$q)){";
$string .= "\n\$this->db->like('$table_name.$pk', \$q);";
foreach ($column_all_s as $campo) {
    $string .= "\n\t\$this->db->or_like('" . $campo ."', \$q);";
}
$string .= "\n}";
    
$string .="\n
if(\$oc!=''){
    \$this->db->order_by(\$oc,\$od);
}
else
\$this->db->order_by('".$ordenlista."', '".$direccionordenlista."');";

$string .= "\n\t\$this->db->limit(\$limit, \$start);
        return \$this->db->get(\$this->table)->result();
    }

    // insert data
    function insert(\$data)
    {
        \$this->db->insert(\$this->table, \$data);
    }

    // update data
    function update(\$id, \$data)
    {
        \$this->db->where(\$this->id, \$id);
        \$this->db->update(\$this->table, \$data);
    }

    // delete data
    function delete(\$id)
    {
        \$this->db->where(\$this->id, \$id);
        \$this->db->delete(\$this->table);
    }

}

/* End of file $m_file */
/* Location: ./application/models/$m_file */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */
";




$hasil_model = createFile($string, $target."models/" . $m_file);

?>
<?php

$tipo_controller = $tipo_creacion=='modulo'?'MX_Controller':'CI_Controller';

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends ".$tipo_controller."
{
    function __construct()
    {
        parent::__construct();
        \$this->load->model('$m');
        \$this->load->library('form_validation');
        \$this->load->helper('formatos');
        ";
        

if ($jenis_tabel == 'datatables') {
    $string .= "        \n\t\$this->load->library('datatables');";
}
        
$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {
    
    $pagelength = isset($numregistros)?$numregistros:10;


    $string .= "\n\n        public function index()
    {
        \$this->session->set_userdata(array('$c_url.q' => ''));
        //\$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url().'/view', 'location');
    }    
";
$string .= "\n\n    public function view(\$page=1)
    {

        if(intval(\$page)<=0)
		{
			
			\$this->session->set_userdata(array('$c_url.q' => ''));
            redirect(base_url().\$this->uri->segment(1).'/'.\$this->uri->segment(2).'/view','location');
            redirect(current_url(), 'location');
        }
        if(count(\$_POST)>0)
			\$this->session->set_userdata(array('$c_url.q' => \$this->input->post('q')));

        \$q=\$this->session->userdata('$c_url.q');
        
        \$ob = urldecode(\$this->input->get('ob', TRUE));
        \$nr = urldecode(\$this->input->get('nr', TRUE));
		
		if(\$ob != ''){
			\$orddir = substr(\$ob,0,1);
			\$ordencampo = substr(\$ob,1);
			switch(\$orddir){
				case 'a':
					\$ordendir = 'ASC';
				break;
				case 'd':
					\$ordendir = 'DESC';
				break;
			}
			\$this->session->set_userdata(array('$c_url.od' => \$ordendir, '$c_url.oc' => \$ordencampo));
		}
		
		\$oc = \$this->session->userdata('$c_url.oc');
        \$od = \$this->session->userdata('$c_url.od');
        
        if(\$nr!=''){
            \$config['per_page'] = \$nr;
            \$this->session->set_userdata(array('$c_url.nr' => \$nr));
        }
        
        \$nr = \$this->session->userdata('$c_url.nr');

        if(\$nr!=''){
            \$config['per_page'] = \$nr;
        }
        else{
            \$config['per_page'] = ".$pagelength.";
            \$this->session->set_userdata(array('$c_url.nr' => ".$pagelength."));
        }
        
        
        
        
            \$config['base_url'] = current_url().'/';
            \$config['first_url'] = current_url().'/';
        
            

        
        \$config['uri_segment'] = 4;
        \$config['use_page_numbers'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);

        \$start = \$config['per_page']*(\$page-1);

        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q, \$oc, \$od);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$data['titulo']='$titulo';
        \$data['main'] = '$c_url/$v_list';
        \$this->load->view('template', \$data);
    }";

} else {
    
$string .="\n\n    public function index()
    {
        \$$c_url = \$this->" . $m . "->get_all();
        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
        );
        \$data['titulo']='$titulo';
        \$data['main'] = '$c_url/$v_list';
        \$this->load->view('template', \$data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo \$this->" . $m . "->json();
    }";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    );";
foreach ($all as $row) {
    if(isset($relaciones[$row['column_name']])){
        if(isset($relaciones_tabla_campo_orden[$row['column_name']]) && $relaciones_tabla_campo_orden[$row['column_name']]!=''){
            $string .= "\n\t\t \$this->db->order_by('".$relaciones_tabla_campo_orden[$row['column_name']]."','ASC');";
        }
        $string .= "\n\t\t \$data['s_".$row['column_name']."'] = \$this->db->get('".$relaciones_tabla[$row['column_name']]."')->result();";
    }
}
            
$string .= "\n\t\$data['main'] = '$c_url/$v_read';
\$data['titulo']='$titulo';
            \$this->load->view('template', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$c_url'));
        }
    }
";
if($action_add == '1'){
    $string .= "\n\n    public function create() 
        {
            \$data = array(
                'button' => 'Añadir',
                'action' => site_url('$c_url/create_action'),";
    foreach ($all as $row) {
        if(in_array($row['column_name'],$edit_campos)){
            $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
        }
    }
    $string .= "\n\t\t'" . $pk . "' => set_value('" . $pk . "'),";
    
    $string .= "\n\t);";
    foreach ($all as $row) {
        if(in_array($row['column_name'],$edit_campos) && isset($relaciones[$row['column_name']])){
            if(isset($relaciones_tabla_campo_orden[$row['column_name']]) && $relaciones_tabla_campo_orden[$row['column_name']]!=''){
                $string .= "\n\t\t \$this->db->order_by('".$relaciones_tabla_campo_orden[$row['column_name']]."','ASC');";
            }
            $string .= "\n\t\t \$data['s_".$row['column_name']."'] = \$this->db->get('".$relaciones_tabla[$row['column_name']]."')->result();";
        }
    }
    $string .= "\$data['main'] = '$c_url/$v_form';
    \$data['titulo']='$titulo';
    \$this->load->view('template', \$data);
        }
    ";


    $string .= "\n\n    public function create_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
    foreach ($non_pk as $row) {
        if(in_array($row['column_name'],$edit_campos)){
            $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
        }
    }
    $string .= "\n\t    );

            \$this->".$m."->insert(\$data);
            \$this->session->set_flashdata('message', '".$objeto." creado correctamente');
            redirect(site_url('$c_url'));
        }
    }
    
    ";
}

if($action_edit == '1'){
    $string .= "\n\npublic function update(\$id) 
        {
            \$row = \$this->".$m."->get_by_id(\$id);
    if (\$row) {
                \$data = array(
                    'button' => 'Modificar',
                    'action' => site_url('$c_url/update_action'),";
    foreach ($all as $row) {
        if(in_array($row['column_name'],$edit_campos)){
            $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
        }
    }
    $string .= "\n\t\t'" . $pk . "' => set_value('" . $pk . "', \$row->". $pk."),";
    $string .= "\n\t    );
    ";

    foreach ($all as $row) {
        if(in_array($row['column_name'],$edit_campos) && isset($relaciones[$row['column_name']])){
            if(isset($relaciones_tabla_campo_orden[$row['column_name']]) && $relaciones_tabla_campo_orden[$row['column_name']]!=''){
                $string .= "\n\t\t \$this->db->order_by('".$relaciones_tabla_campo_orden[$row['column_name']]."','ASC');";
            }
            $string .= "\n\t\t \$data['s_".$row['column_name']."'] = \$this->db->get('".$relaciones_tabla[$row['column_name']]."')->result();";
        }
    }

    $string .= "            
                \$data['main'] = '$c_url/$v_form';
                \$data['titulo']='$titulo';
                \$this->load->view('template', \$data);
            } else {
                \$this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('$c_url'));
            }
        }
    
    public function update_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$pk', TRUE));
        } else {
            \$data = array(";
        foreach ($non_pk as $row) {
            if(in_array($row['column_name'],$edit_campos)){
                $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
            }
        }    
        $string .= "\n\t    );

            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$this->session->set_flashdata('message', '".$objeto." modificado correctamente');
            redirect(site_url('$c_url'));
        }
    }
    ";  
}

if($action_del == '1')    {
    $string .= "\n\t    public function delete(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->delete(\$id);
            \$this->session->set_flashdata('message', '".$objeto." eliminado correctamente');
            redirect(site_url('$c_url'));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$c_url'));
        }
    }
    ";
}
$string .= "\n\t    public function _rules() 
    {";
foreach ($non_pk as $row) {
    if(in_array($row['column_name'],$edit_campos)){
        $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
        $required = isset($requeridos[$row['column_name']]) ? '|required' : '';
        $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim$required$int');";
    }
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table_name.xls\";
        \$judul = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        \$this->load->view('" . $c_url ."/". $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $c_url ."/". $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */
";




$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>
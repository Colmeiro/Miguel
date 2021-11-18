<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Productos_model');
        $this->load->library('form_validation');
        $this->load->helper('formatos');
        
    }

        public function index()
    {
        $this->session->set_userdata(array('productos.q' => ''));
        //$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url().'/view', 'location');
    }    


    public function view($page=1)
    {

        if(intval($page)<=0)
		{
			
			$this->session->set_userdata(array('productos.q' => ''));
            redirect(base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/view','location');
            redirect(current_url(), 'location');
        }
        if(count($_POST)>0)
			$this->session->set_userdata(array('productos.q' => $this->input->post('q')));

        $q=$this->session->userdata('productos.q');
        
        $ob = urldecode($this->input->get('ob', TRUE));
        $nr = urldecode($this->input->get('nr', TRUE));
		
		if($ob != ''){
			$orddir = substr($ob,0,1);
			$ordencampo = substr($ob,1);
			switch($orddir){
				case 'a':
					$ordendir = 'ASC';
				break;
				case 'd':
					$ordendir = 'DESC';
				break;
			}
			$this->session->set_userdata(array('productos.od' => $ordendir, 'productos.oc' => $ordencampo));
		}
		
		$oc = $this->session->userdata('productos.oc');
        $od = $this->session->userdata('productos.od');
        
        if($nr!=''){
            $config['per_page'] = $nr;
            $this->session->set_userdata(array('productos.nr' => $nr));
        }
        
        $nr = $this->session->userdata('productos.nr');

        if($nr!=''){
            $config['per_page'] = $nr;
        }
        else{
            $config['per_page'] = 10;
            $this->session->set_userdata(array('productos.nr' => 10));
        }
        
        
        
        
            $config['base_url'] = current_url().'/';
            $config['first_url'] = current_url().'/';
        
            

        
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->Productos_model->total_rows($q);

        $start = $config['per_page']*($page-1);

        $productos = $this->Productos_model->get_limit_data($config['per_page'], $start, $q, $oc, $od);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'productos_data' => $productos,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['titulo']='productos';
        
            $data['main'] = 'productos_list';
            $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->Productos_model->get_by_id($id);
        if ($row) {
            $data = array(
                'data_fields' => array(
		'producto_id' => $row->producto_id,
		'producto_nombre' => $row->producto_nombre,
		'producto_ref' => $row->producto_ref,
	)
	    );
            $data['main'] = 'productos_read';
            
$data['titulo']='productos';
$data['subtitulo']='Ver Productos';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('productos'));
        }
    }


    public function create() 
        {
            $data = array(
                'button' => 'Añadir',
                'action' => site_url('productos/create_action'),
                'data_fields' => array(
		'producto_id' => set_value('producto_id'),
	)
	);
            $data['main'] = 'productos_form';
            
    $data['titulo']='productos';
    $data['subtitulo']='Añadir Productos';
    $this->load->view('template', $data);
        }
    

    public function create_action() 
    {
        $this->_rules('create');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {            $data = array(
	    );

            $this->Productos_model->insert($data);
            $this->session->set_flashdata('message', 'Productos creado correctamente');
            redirect(site_url('productos'));
        }
    }    
    

public function update($id) 
        {
            $row = $this->Productos_model->get_by_id($id);
    if ($row) {
                $data = array(
                    'button' => 'Modificar',
                    'action' => site_url('productos/update_action'),
                    'data_fields' => array(
		'producto_id' => set_value('producto_id', $row->producto_id),
	)
	    );
    
            $data['main'] = 'productos_form';
            
                $data['titulo']='productos';
                $data['subtitulo']='Modificar Productos';
                $this->load->view('template', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('productos'));
            }
        }
    
    public function update_action() 
    {
        $this->_rules('update');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('producto_id', TRUE));
        } else {            $data = array(
	    );
	
            $this->Productos_model->update($this->input->post('producto_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Productos modificado correctamente');
            redirect(site_url('productos'));

        }
    }
    
	    public function delete($id) 
    {
        $row = $this->Productos_model->get_by_id($id);

        if ($row) {
            $this->Productos_model->delete($id);
            $this->session->set_flashdata('message', 'Productos eliminado correctamente');
            redirect(site_url('productos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('productos'));
        }
    }
    
	    public function _rules($raction) 
    {

	$this->form_validation->set_rules('producto_id', 'producto_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "productos.xls";
        $judul = "productos";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "");
	xlsWriteLabel($tablehead, $kolomhead++, "Producto Nombre");
	xlsWriteLabel($tablehead, $kolomhead++, "Producto Ref");

	foreach ($this->Productos_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->);
	    xlsWriteLabel($tablebody, $kolombody++, $data->producto_nombre);
	    xlsWriteNumber($tablebody, $kolombody++, $data->producto_ref);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=productos.doc");

        $data = array(
            'productos_data' => $this->Productos_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('productos/productos_doc',$data);
    }

}

/* End of file Productos.php */
/* Location: ./application/controllers/Productos.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2021-11-11 11:09:16 */

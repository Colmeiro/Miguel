<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ContactosController extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contactos_model');
        $this->load->library('form_validation');
        $this->load->helper('formatos');
        $this->load->model('Modelo_provincias');
        
    }

        public function index()
    {
        $this->session->set_userdata(array('contactoscontroller.q' => ''));
        //$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url().'/view', 'location');
    }    


    public function view($page=1)
    {

        if(intval($page)<=0)
		{
			
			$this->session->set_userdata(array('contactoscontroller.q' => ''));
            redirect(base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/view','location');
            redirect(current_url(), 'location');
        }
        if(count($_POST)>0)
			$this->session->set_userdata(array('contactoscontroller.q' => $this->input->post('q')));

        $q=$this->session->userdata('contactoscontroller.q');
        
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
			$this->session->set_userdata(array('contactoscontroller.od' => $ordendir, 'contactoscontroller.oc' => $ordencampo));
		}
		
		$oc = $this->session->userdata('contactoscontroller.oc');
        $od = $this->session->userdata('contactoscontroller.od');
        
        if($nr!=''){
            $config['per_page'] = $nr;
            $this->session->set_userdata(array('contactoscontroller.nr' => $nr));
        }
        
        $nr = $this->session->userdata('contactoscontroller.nr');

        if($nr!=''){
            $config['per_page'] = $nr;
        }
        else{
            $config['per_page'] = 10;
            $this->session->set_userdata(array('contactoscontroller.nr' => 10));
        }
        
        $config['base_url'] = current_url().'/';
        $config['first_url'] = current_url().'/';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->Contactos_model->total_rows($q);

        $start = $config['per_page']*($page-1);

        $contactoscontroller = $this->Contactos_model->get_limit_data($config['per_page'], $start, $q, $oc, $od);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'contactoscontroller_data' => $contactoscontroller,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['titulo']='contactos';
        
            $data['main'] = 'contactos_list';
            $this->load->view('template', $data);
    }



    public function read($id) 
    {
        $row = $this->Contactos_model->get_by_id($id);
        if ($row) {
            $data = array(
                'data_fields' => array(
                'contacto_id' => $row->contacto_id,
                'contacto_nombre' => $row->contacto_nombre,
                'contacto_telefono' => $row->contacto_telefono,
                'contacto_activo' => $row->contacto_activo,
                'orden' => $row->orden,
                'foto' => $row->foto,
                'provincia' => $row->provincia,
                'sexo' => $row->sexo,
                'fechaNacimiento' => $row->fechaNacimiento,
	            )
	        );
            
            $data['main'] = 'contactos_read';
            $data['titulo']='contactos';
            $data['subtitulo']='Ver Contactos';

            $this->load->view('template', $data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contactos/contactoscontroller'));
        }
    }


    public function create() 
        {
            $provincias = array();
            $provincias = $this->Modelo_provincias->get_all();            

            $data = array(
                'button' => 'Añadir',
                'action' => site_url('contactos/contactoscontroller/create_action'),
                'provincias' => $provincias,
                
                'data_fields' => array(
		            'contacto_id' => set_value('contacto_id'),
                    'contacto_nombre' => set_value('contacto_nombre'),
                    'contacto_telefono' => set_value('contacto_telefono'),
                    'contacto_activo' => set_value('contacto_activo'),
                    'foto' => set_value('foto'),
                    'provincia' => set_value('provincia'),
                    'sexo' => set_value('sexo'),
                    'fechaNacimiento' => set_value('fechaNacimiento'),
	)
	);
            $data['main'] = 'contactos_form';            
            $data['titulo']='contactos';
            $data['subtitulo']='Añadir Contacto';
            $this->load->view('template', $data);
        }



    public function create_action()
    {
        $data = array(
            'contacto_nombre' => $this->input->post('contacto_nombre', TRUE),
            'contacto_telefono' => $this->input->post('contacto_telefono', TRUE),
            'contacto_activo' => $this->input->post('contacto_activo', TRUE),
            'foto' => $this->input->post('foto', TRUE),
            'provincia' => $this->input->post('provincia', TRUE),
            'sexo' => $this->input->post('sexo', TRUE),
            'fechaNacimiento' => $this->input->post('fechaNacimiento', TRUE),
        );

        $this->Contactos_model->insert($data);
        $this->session->set_flashdata('message', 'contacto creado correctamente');
        redirect(site_url('contactos/contactoscontroller'));
    }
    

    // public function create_action() 
    // {
    //     $this->_rules('create');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->create();
    //     } else {            $data = array(
	//     );

    //         $this->Contactos_model->insert($data);
    //         $this->session->set_flashdata('message', 'Contacto creado correctamente');
    //         redirect(site_url('contactos/contactoscontroller'));
    //     }
    // }    
    

public function update($id) 
{
    $row = $this->Contactos_model->get_by_id($id);
    if ($row) {

            $data = array(
                'button' => 'Modificar',
                'action' => site_url('contactos/contactoscontroller/update_action'),
                
                'data_fields' => array(
                    'contacto_id' => set_value('contacto_id', $row->contacto_id),
                    'contacto_nombre' => set_value('contacto_nombre', $row->contacto_nombre),
                    'contacto_telefono' => set_value('contacto_telefono', $row->contacto_telefono),
                    'contacto_activo' => set_value('contacto_activo', $row->contacto_activo),
                    'foto' => set_value('foto', $row->foto),
                    'provincia' => set_value('provincia', $row->provincia),
                    'sexo' => set_value('sexo', $row->sexo),
                    'fechaNacimiento' => set_value('fechaNacimiento', $row->fechaNacimiento),
                    )
	        );
    
            $data['main'] = 'contactos_form';
            $data['titulo']='Gestión de contactos';
            $data['subtitulo']='Modificar Contacto';
            $this->load->view('template', $data);

    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('contactos/contactoscontroller'));
    }
}

    
public function update_action() 
{
    $this->_rules('update');

    if ($this->form_validation->run() == FALSE) {
        $this->update($this->input->post('contacto_id', TRUE));
    } else {            
            $data = array(
            'contacto_nombre' => $this->input->post('contacto_nombre', TRUE),
            'contacto_telefono' => $this->input->post('contacto_telefono', TRUE),
            'contacto_activo' => $this->input->post('contacto_activo', TRUE),
            'provincia' => $this->input->post('provincia', TRUE),
            'foto' => $this->input->post('foto', TRUE),
            'sexo' => $this->input->post('sexo', TRUE),
            'fechaNacimiento' => $this->input->post('fechaNacimiento', TRUE),
            );

        $this->Contactos_model->update($this->input->post('contacto_id', TRUE), $data);
        $this->session->set_flashdata('message', 'Contacto modificado correctamente');
        redirect(site_url('contactos/contactoscontroller'));

    }
}
    
	    public function delete($id) 
    {
        $row = $this->Contactos_model->get_by_id($id);

        if ($row) {
            $this->Contactos_model->delete($id);
            $this->session->set_flashdata('message', 'Contactos eliminado correctamente');
            redirect(site_url('contactos/contactoscontroller'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contactos/contactoscontroller'));
        }
    }
    
	    public function _rules($raction) 
    {

	$this->form_validation->set_rules('contacto_id', 'contacto_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    // public function excel()
    // {
    //     $this->load->helper('exportexcel');
    //     $namaFile = "contactos.xls";
    //     $judul = "contactos";
    //     $tablehead = 0;
    //     $tablebody = 1;
    //     $nourut = 1;
    //     //penulisan header
    //     header("Pragma: public");
    //     header("Expires: 0");
    //     header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    //     header("Content-Type: application/force-download");
    //     header("Content-Type: application/octet-stream");
    //     header("Content-Type: application/download");
    //     header("Content-Disposition: attachment;filename=" . $namaFile . "");
    //     header("Content-Transfer-Encoding: binary ");

    //     xlsBOF();

    //     $kolomhead = 0;
    //     xlsWriteLabel($tablehead, $kolomhead++, "No");
	// xlsWriteLabel($tablehead, $kolomhead++, "");
	// xlsWriteLabel($tablehead, $kolomhead++, "Contacto Nombre");
	// xlsWriteLabel($tablehead, $kolomhead++, "Contacto Telefono");
	// xlsWriteLabel($tablehead, $kolomhead++, "Contacto Activo");
	// xlsWriteLabel($tablehead, $kolomhead++, "Orden");
	// xlsWriteLabel($tablehead, $kolomhead++, "Foto");
	// xlsWriteLabel($tablehead, $kolomhead++, "Provincia");
	// xlsWriteLabel($tablehead, $kolomhead++, "Sexo");
	// xlsWriteLabel($tablehead, $kolomhead++, "FechaNacimiento");

	// foreach ($this->Contactos_model->get_all() as $data) {
    //         $kolombody = 0;

    //         //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    //         xlsWriteNumber($tablebody, $kolombody++, $nourut);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->contacto_nombre);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->contacto_telefono);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->contacto_activo);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->orden);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->foto);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->provincia);
	//     xlsWriteNumber($tablebody, $kolombody++, $data->sexo);
	//     xlsWriteLabel($tablebody, $kolombody++, $data->fechaNacimiento);

	//     $tablebody++;
    //         $nourut++;
    //     }

    //     xlsEOF();
    //     exit();
    // }

    // public function word()
    // {
    //     header("Content-type: application/vnd.ms-word");
    //     header("Content-Disposition: attachment;Filename=contactos.doc");

    //     $data = array(
    //         'contactos_data' => $this->Contactos_model->get_all(),
    //         'start' => 0
    //     );
        
    //     $this->load->view('contactoscontroller/contactos_doc',$data);
    // }

}

/* End of file ContactosController.php */
/* Location: ./application/controllers/ContactosController.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2021-11-23 17:50:29 */

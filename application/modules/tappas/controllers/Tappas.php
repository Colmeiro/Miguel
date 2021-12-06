<?php
class Tappas extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tappas_model');
        $this->load->library('form_validation');
        $this->load->helper('formatos');
        
    }

    function index()
    {

        $data['titulo'] = 'TITULOTAPPAS';
        $data['description'] = '';

        $data['seccion'] = 'INICIOTAPPAS';
        $data['main'] = 'inicio';
        $this->load->vars($data);
        $this->load->view('inicio', $data);
    }

    

    public function view($page=1)
    {

        if(intval($page)<=0)
		{
			
			$this->session->set_userdata(array('tappas.q' => ''));
            redirect(base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/view','location');
            redirect(current_url(), 'location');
        }
        if(count($_POST)>0)
			$this->session->set_userdata(array('tappas.q' => $this->input->post('q')));

        $q=$this->session->userdata('tappas.q');
        
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
			$this->session->set_userdata(array('tappas.od' => $ordendir, 'tappas.oc' => $ordencampo));
		}
		
		// $oc = $this->session->userdata('tappas.oc');
        // $od = $this->session->userdata('tappas.od');
        
        // if($nr!=''){
        //     $config['per_page'] = $nr;
        //     $this->session->set_userdata(array('tappas.nr' => $nr));
        // }
        
        // $nr = $this->session->userdata('tappas.nr');

        // if($nr!=''){
        //     $config['per_page'] = $nr;
        // }
        // else{
        //     $config['per_page'] = 10;
        //     $this->session->set_userdata(array('tappas.nr' => 10));
        // }
        
        $config['base_url'] = current_url().'/';
        $config['first_url'] = current_url().'/';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->Tappas_model->total_rows($q);

        // $start = $config['per_page']*($page-1);

        $tappas = $this->Tappas_model->get_all();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tappas_data' => $tappas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            // 'start' => $start,
        );
        $data['titulo']='locales';
        
            $data['main'] = 'listado';
            $this->load->view('listado', $data);
    }

    public function search()
    {
        // var_dump($_POST);
        // die();
        $data = $_POST["barrabusqueda"];
       
        $resultados = $this->Tappas_model->get_search($data);
        $q=$this->session->userdata('tappas.q');
        $config['base_url'] = current_url().'/';
        $config['first_url'] = current_url().'/';
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->Tappas_model->total_rows($q);

        $tappas = array(
            'tappas_data' => $resultados,
            'q' => $q,
            'total_rows' => $config['total_rows'],
        );
        $tappas['titulo'] = 'listado busqueda';

       
        $this->load->view('listado', $tappas);
    }
}

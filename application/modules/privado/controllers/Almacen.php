<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Almacen extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MAlmacen_historial');
        $this->load->library('form_validation');
        $this->load->helper('formatos');

        modules::run('auth/is_loggedin');

        $tienePermiso = modules::run('security/check_admin');
        if(!$tienePermiso) {
            redirect('');
        }
    }

    public function index()
    {
        $this->session->set_userdata(array('almacen.q' => ''));
        //$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url() . '/view', 'location');
    }


    public function view_cruz($page = 1)
    {

        if (intval($page) <= 0) {

            $this->session->set_userdata(array('almacen.q' => ''));
            redirect(base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/view', 'location');
            redirect(current_url(), 'location');
        }
        if (count($_POST) > 0)
            $this->session->set_userdata(array('almacen.q' => $this->input->post('q')));

        $q = $this->session->userdata('almacen.q');

        $ob = urldecode($this->input->get('ob', TRUE));
        $nr = urldecode($this->input->get('nr', TRUE));

        if ($ob != '') {
            $orddir = substr($ob, 0, 1);
            $ordencampo = substr($ob, 1);
            switch ($orddir) {
                case 'a':
                    $ordendir = 'ASC';
                    break;
                case 'd':
                    $ordendir = 'DESC';
                    break;
            }
            $this->session->set_userdata(array('almacen.od' => $ordendir, 'almacen.oc' => $ordencampo));
        }

        $oc = $this->session->userdata('almacen.oc');
        $od = $this->session->userdata('almacen.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            $this->session->set_userdata(array('almacen.nr' => $nr));
        }

        $nr = $this->session->userdata('almacen.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = 10000;
            $this->session->set_userdata(array('almacen.nr' => 10000));
        }




        $config['base_url'] = current_url() . '/';
        $config['first_url'] = current_url() . '/';




        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->MAlmacen_historial->total_rows($q);

        $start = $config['per_page'] * ($page - 1);

        $almacen = $this->MAlmacen_historial->get_limit_data($config['per_page'], $start, $q, $oc, $od);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'almacen_data' => $almacen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['titulo'] = 'Almacén';

        $data['seccion'] = 'admin-almacen';

        $data['main'] = 'almacen_list';
        $this->load->view('template', $data);
    }

    public function view()
    {
        if ($this->input->post('post_check')) {
            
            $this->form_validation->set_rules('limit', '"Limitado a"', 'trim|required|numeric');

            $data = array(
                // 'fecha_ini' => $this->input->post('fecha_ini'),
                // 'fecha_fin' => $this->input->post('fecha_fin'),
                'limit' => $this->input->post('limit')
            );

            if ($this->form_validation->run()) {
                $data['almacen_data'] = $this->MAlmacen_historial->getBy($data);
                $data['total_rows'] = $this->MAlmacen_historial->getCountBy($data);
            }

            if (empty($data['total_rows'])) {
                $data['total_rows'] = 0;
            } else {
                if (empty($data['limit']) || $data['limit'] < 1) {
                    $data['limit'] = $data['total_rows'];
                }
                $data['total_rows'] = number_format($data['total_rows'], 0, ',', '.');
            }
        } else {
            $data = array(
                // 'fecha_ini' => date("Y-m-d", strtotime(date('Y-m-d') . " -1 month")),
                // 'fecha_fin' => date('Y-m-d'),
                'limit' => 1500
            );
            $data['almacen_data'] = $this->MAlmacen_historial->getBy($data);
            $data['total_rows'] = $this->MAlmacen_historial->getCountBy($data);
        }

        $data['q'] = '';
        $data['titulo'] = 'Almacén';

        $data['seccion'] = 'admin-almacen';

        $data['main'] = 'almacen_list';
        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->MAlmacen_historial->get_by_id($id);
        if ($row) {
            $data = array(
                'data_fields' => array(
                    'ID' => $row->ID,
                    'tag' => $row->tag,
                    'tipo' => $row->tipo,
                    'situacion' => $row->situacion,
                    'fecha' => $row->fecha,
                    'modo' => $row->modo,
                )
            );

            $data['seccion'] = 'admin-almacen';
            
            $data['main'] = 'almacen_read';

            $data['titulo'] = 'Almacén';
            $data['subtitulo'] = 'Ver Almacén';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/almacen'));
        }
    }
}

/* End of file Almacen.php */
/* Location: ./application/controllers/Almacen.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2021-01-28 13:17:21 */

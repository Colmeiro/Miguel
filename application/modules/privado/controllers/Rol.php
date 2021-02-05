<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rol extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MRol');
        $this->load->library('form_validation');
        $this->load->helper('formatos');

        modules::run('auth/is_loggedin');

        $tienePermiso = modules::run('security/check_gestion_roles');
        if(!$tienePermiso) {
            redirect('');
        }
    }

    public function index()
    {
        $this->session->set_userdata(array('rol.q' => ''));
        //$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url() . '/view', 'location');
    }


    public function view($page = 1)
    {
        $page_get = $this->input->get('p', TRUE);
        if($page_get) {
            $page = $page_get;
        }

        if (intval($page) <= 0) {

            $this->session->set_userdata(array('rol.q' => ''));
            redirect(base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/view', 'location');
            redirect(current_url(), 'location');
        }
        if (count($_POST) > 0)
            $this->session->set_userdata(array('rol.q' => $this->input->post('q')));

        $q = $this->session->userdata('rol.q');

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
            $this->session->set_userdata(array('rol.od' => $ordendir, 'rol.oc' => $ordencampo));
        }

        $oc = $this->session->userdata('rol.oc');
        $od = $this->session->userdata('rol.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            $this->session->set_userdata(array('rol.nr' => $nr));
        }

        $nr = $this->session->userdata('rol.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = 10;
            $this->session->set_userdata(array('rol.nr' => 10));
        }


        $config['base_url'] = current_url() . '/';
        $config['first_url'] = current_url() . '/';


        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->MRol->total_rows($q);

        $start = $config['per_page'] * ($page - 1);

        $rol = $this->MRol->get_limit_data($config['per_page'], $start, $q, $oc, $od);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'rol_data' => $rol,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['titulo'] = 'Gestión de Roles';

        $data['seccion'] = 'admin-users';
        $data['main'] = 'rol_list';
        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->MRol->get_by_id($id);
        if ($row) {
            $data = array(
                'data_fields' => array(
                    'rol_id' => $row->rol_id,
                    'nombre' => $row->nombre,
                    'activo' => $row->activo,
                    'orden' => $row->orden,
                )
            );
            $data['seccion'] = 'admin-users';
            $data['main'] = 'rol_read';

            $data['titulo'] = 'Gestión de Roles';
            $data['subtitulo']='Ver Rol';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/rol'));
        }
    }


    public function create()
    {
        $data = array(
            'button' => 'Añadir',
            'action' => site_url('privado/rol/create_action'),
            'data_fields' => array(
                'nombre' => set_value('nombre'),
                'activo' => set_value('activo') ? set_value('activo') : 0,
                'orden' => set_value('orden'),
                'rol_id' => set_value('rol_id'),
            )
        );
        $data['seccion'] = 'admin-users';
        $data['main'] = 'rol_form';

        $data['titulo'] = 'Gestión de Roles';
        $data['subtitulo']='Añadir Rol';
        $this->load->view('template', $data);
    }


    public function create_action()
    {
        $this->_rules('create');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre', TRUE),
                'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
                'orden' => $this->input->post('orden', TRUE),
            );

            $this->MRol->insert($data);
            $this->session->set_flashdata('message', 'Rol creado correctamente');
            redirect(site_url('privado/rol'));
        }
    }


    public function update($id)
    {
        $row = $this->MRol->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'action' => site_url('privado/rol/update_action'),
                'data_fields' => array(
                    'nombre' => set_value('nombre', $row->nombre),
                    'activo' => set_value('activo', $row->activo),
                    'orden' => set_value('orden', $row->orden),
                    'rol_id' => set_value('rol_id', $row->rol_id),
                )
            );

            $data['seccion'] = 'admin-users';
            $data['main'] = 'rol_form';

            $data['titulo'] = 'Gestión de Roles';
            $data['subtitulo']='Modificar Rol';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/rol'));
        }
    }

    public function update_action()
    {
        $this->_rules('update');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('rol_id', TRUE));
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre', TRUE),
                'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
                'orden' => $this->input->post('orden', TRUE),
            );

            $this->MRol->update($this->input->post('rol_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Rol modificado correctamente');
            redirect(site_url('privado/rol'));
        }
    }

    public function delete($id)
    {
        $row = $this->MRol->get_by_id($id);

        if ($row) {
            $this->MRol->delete($id);
            $this->session->set_flashdata('message', 'Rol eliminado correctamente');
            redirect(site_url('privado/rol'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/rol'));
        }
    }

    public function _rules($raction)
    {
        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
        $this->form_validation->set_rules('activo', 'activo', 'trim');
        $this->form_validation->set_rules('orden', 'orden', 'trim');

        $this->form_validation->set_rules('rol_id', 'rol_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Rol.php */
/* Location: ./application/controllers/Rol.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2020-03-12 11:43:28 */

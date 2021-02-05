<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_grupo extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MUsuario_grupo');
        $this->load->library('form_validation');
        $this->load->helper('formatos');

        modules::run('auth/is_loggedin');

        $tienePermiso = modules::run('security/check_gestion_usuarios');
        if (!$tienePermiso) {
            redirect('');
        }
    }

    public function index()
    {
        $this->session->set_userdata(array('usuario_grupo.q' => ''));
        //$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url() . '/view', 'location');
    }


    public function view($grupo_id=0, $page = 1)
    {
        if($this->input->get('p', TRUE)) {
            $page = $this->input->get('p', TRUE);
        }

        if (intval($page) <= 0) {

            $this->session->set_userdata(array('usuario_grupo.q' => ''));
            redirect(base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/view', 'location');
            redirect(current_url(), 'location');
        }
        if (count($_POST) > 0)
            $this->session->set_userdata(array('usuario_grupo.q' => $this->input->post('q')));

        $q = $this->session->userdata('usuario_grupo.q');

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
            $this->session->set_userdata(array('usuario_grupo.od' => $ordendir, 'usuario_grupo.oc' => $ordencampo));
        }

        $oc = $this->session->userdata('usuario_grupo.oc');
        $od = $this->session->userdata('usuario_grupo.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            $this->session->set_userdata(array('usuario_grupo.nr' => $nr));
        }

        $nr = $this->session->userdata('usuario_grupo.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = 10;
            $this->session->set_userdata(array('usuario_grupo.nr' => 10));
        }

        $config['base_url'] = current_url() . '/';
        $config['first_url'] = current_url() . '/';


        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->MUsuario_grupo->total_rows($q);

        $start = $config['per_page'] * ($page - 1);

        $usuario_grupo = $this->MUsuario_grupo->get_limit_data($config['per_page'], $start, $q, $oc, $od, $grupo_id);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'usuario_grupo_data' => $usuario_grupo,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        if(!empty($grupo_id)) {
            $data['grupo'] = $this->MUsuario_grupo->getGrupoById($grupo_id);
            $this->session->set_userdata('usuario_grupo_grupo_id', $grupo_id);
        }

        $data['url_plus'] = $this->getUrlPlusGrupo();

        $data['titulo'] = 'Gestión de Grupos';
        $data['titulo_grupo'] = 'Usuarios del Grupo ';

        $data['seccion'] = 'admin-grupos';
        $data['main'] = 'usuario_grupo_list';
        $this->load->view('template', $data);
    }

    private function getUrlPlusGrupo() 
    {
        if($this->session->has_userdata('usuario_grupo_grupo_id')) {
            $grupo_id = $this->session->userdata('usuario_grupo_grupo_id');
            return '/view/' . $grupo_id;
        } else {
            return '';
        }
    }

    public function read($id)
    {
        $url_plus = $this->getUrlPlusGrupo();

        $row = $this->MUsuario_grupo->get_by_id($id);
        if ($row) {
            $data = array(
                'data_fields' => array(
                    'usuario_grupo_id' => $row->usuario_grupo_id,
                    'grupo_id' => $row->grupo_id,
                    'usuario_id' => $row->usuario_id,
                    'activo' => $row->activo,
                    'orden' => $row->orden,
                )
            );
            $this->db->order_by('grupo_id', 'ASC');
            $data['s_grupo_id'] = $this->db->get('grupo')->result();
            $this->db->order_by('nombre', 'ASC');
            $data['s_usuario_id'] = $this->db->get('usuario')->result();
            $data['seccion'] = 'admin-grupos';
            $data['main'] = 'usuario_grupo_read';

            $data['url_plus'] = $url_plus;

            $data['titulo'] = 'Gestión de Usuarios de un Grupo';
            $data['subtitulo'] = 'Ver Relación de Usuario y Grupo';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/usuario-grupo' . $url_plus));
        }
    }


    public function create()
    {
        $url_plus = $this->getUrlPlusGrupo();

        $data = array(
            'button' => 'Añadir',
            'action' => site_url('privado/usuario-grupo/create_action'),
            'data_fields' => array(
                'grupo_id' => set_value('grupo_id'),
                'usuario_id' => set_value('usuario_id'),
                'activo' => set_value('activo') ? set_value('activo') : 0,
                'orden' => set_value('orden'),
                'usuario_grupo_id' => set_value('usuario_grupo_id'),
            )
        );
        $this->db->order_by('grupo_id', 'ASC');
        $data['s_grupo_id'] = $this->db->get('grupo')->result();

        // $this->db->select('usuario.*');
        // // $this->db->join("usuario_grupo", "usuario_grupo.usuario_id = usuario.usuario_id", "left");
        // $this->db->where("usuario.usuario_id NOT IN (select usuario_id FROM usuario_grupo)");
        // $this->db->order_by('nombre', 'ASC');
        // $data['s_usuario_id'] = $this->db->get('usuario')->result();

        if($this->session->has_userdata('usuario_grupo_grupo_id')) {
            $grupo_id = $this->session->userdata('usuario_grupo_grupo_id');
        } else {
            $grupo_id = 0;
        }
        $data['grupo_id_def']  = $grupo_id;
        $data['s_usuario_id'] = $this->MUsuario_grupo->getUsuariosGrupoUnique($grupo_id);
        $data['seccion'] = 'admin-grupos';
        $data['main'] = 'usuario_grupo_form';

        $data['url_plus'] = $url_plus;

        $data['titulo'] = 'Gestión de Usuarios de un Grupo';
        $data['subtitulo'] = 'Añadir Relación de Usuario y Grupo';
        $this->load->view('template', $data);
    }


    public function create_action()
    {
        $url_plus = $this->getUrlPlusGrupo();

        $this->_rules('create');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'grupo_id' => $this->input->post('grupo_id', TRUE),
                'usuario_id' => $this->input->post('usuario_id', TRUE),
                'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
                'orden' => $this->input->post('orden', TRUE),
            );

            $this->MUsuario_grupo->insert($data);
            $this->session->set_flashdata('message', 'Relación de Usuario y Grupo añadida correctamente');
            redirect(site_url('privado/usuario-grupo' . $url_plus));
        }
    }


    public function update($id)
    {
        $url_plus = $this->getUrlPlusGrupo();

        $row = $this->MUsuario_grupo->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'action' => site_url('privado/usuario-grupo/update_action'),
                'data_fields' => array(
                    'grupo_id' => set_value('grupo_id', $row->grupo_id),
                    'usuario_id' => set_value('usuario_id', $row->usuario_id),
                    'activo' => set_value('activo', $row->activo),
                    'orden' => set_value('orden', $row->orden),
                    'usuario_grupo_id' => set_value('usuario_grupo_id', $row->usuario_grupo_id),
                )
            );

            $this->db->order_by('grupo_id', 'ASC');
            $data['s_grupo_id'] = $this->db->get('grupo')->result();

            // $this->db->order_by('nombre', 'ASC');
            // $data['s_usuario_id'] = $this->db->get('usuario')->result();
            if($this->session->has_userdata('usuario_grupo_grupo_id')) {
                $grupo_id = $this->session->userdata('usuario_grupo_grupo_id');
            } else {
                $grupo_id = 0;
            }
            $data['s_usuario_id'] = $this->MUsuario_grupo->getUsuariosGrupoUnique($grupo_id);
            
            $data['seccion'] = 'admin-grupos';
            $data['main'] = 'usuario_grupo_form';

            $data['url_plus'] = $url_plus;

            $data['titulo'] = 'Gestión de Usuarios de un Grupo';
            $data['subtitulo'] = 'Modificar Relación de Usuario y Grupo';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/usuario-grupo' . $url_plus));
        }
    }

    public function update_action()
    {
        $url_plus = $this->getUrlPlusGrupo();

        $this->_rules('update');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('usuario_grupo_id', TRUE));
        } else {
            $data = array(
                'grupo_id' => $this->input->post('grupo_id', TRUE),
                'usuario_id' => $this->input->post('usuario_id', TRUE),
                'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
                'orden' => $this->input->post('orden', TRUE),
            );

            $this->MUsuario_grupo->update($this->input->post('usuario_grupo_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Relación de Usuario y Grupo modificada correctamente');
            redirect(site_url('privado/usuario-grupo' . $url_plus));
        }
    }

    public function delete($id)
    {
        $url_plus = $this->getUrlPlusGrupo();

        $row = $this->MUsuario_grupo->get_by_id($id);

        if ($row) {
            $this->MUsuario_grupo->delete($id);
            $this->session->set_flashdata('message', 'Usuario retirado de la relación correctamente');
            redirect(site_url('privado/usuario-grupo' . $url_plus));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/usuario-grupo' . $url_plus));
        }
    }

    public function _rules($raction)
    {
        $this->form_validation->set_rules('grupo_id', 'grupo id', 'trim|required');
        $this->form_validation->set_rules('usuario_id', 'usuario id', 'trim|required');
        $this->form_validation->set_rules('activo', 'activo', 'trim');
        $this->form_validation->set_rules('orden', 'orden', 'trim');

        $this->form_validation->set_rules('usuario_grupo_id', 'usuario_grupo_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Usuario_grupo.php */
/* Location: ./application/controllers/Usuario_grupo.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2021-01-28 10:51:27 */

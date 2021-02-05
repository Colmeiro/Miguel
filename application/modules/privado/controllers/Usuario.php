<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MUsuario_priv');
        $this->load->library('form_validation');
        $this->load->helper('formatos');

        modules::run('auth/is_loggedin');

        $tienePermiso = modules::run('security/check_gestion_usuarios');
        if(!$tienePermiso) {
            redirect('');
        }
    }

    public function index()
    {
        $this->session->set_userdata(array('usuario.q' => ''));
        //$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url() . '/view', 'location');
    }


    public function view($page = 1)
    {
        if($this->input->get('p', TRUE)) {
            $page = $this->input->get('p', TRUE);
        }

        if (intval($page) <= 0) {

            $this->session->set_userdata(array('usuario.q' => ''));
            redirect(base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/view', 'location');
            redirect(current_url(), 'location');
        }
        if (count($_POST) > 0)
            $this->session->set_userdata(array('usuario.q' => $this->input->post('q')));

        $q = $this->session->userdata('usuario.q');

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
            $this->session->set_userdata(array('usuario.od' => $ordendir, 'usuario.oc' => $ordencampo));
        }

        $oc = $this->session->userdata('usuario.oc');
        $od = $this->session->userdata('usuario.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            $this->session->set_userdata(array('usuario.nr' => $nr));
        }

        $nr = $this->session->userdata('usuario.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = 10;
            $this->session->set_userdata(array('usuario.nr' => 10));
        }




        $config['base_url'] = current_url() . '/';
        $config['first_url'] = current_url() . '/';




        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->MUsuario_priv->total_rows($q);

        $start = $config['per_page'] * ($page - 1);

        $usuario = $this->MUsuario_priv->get_limit_data($config['per_page'], $start, $q, $oc, $od);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'usuario_data' => $usuario,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['titulo'] = 'Gestión de Usuarios';

        $data['seccion'] = 'admin-users';
        $data['main'] = 'usuario_list';
        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->MUsuario_priv->get_by_id($id);
        if ($row) {
            $data = array(
                'data_fields' => array(
                    'usuario_id' => $row->usuario_id,
                    'fecha_creacion' => $row->fecha_creacion,
                    'nombre' => $row->nombre,
                    'apellidos' => $row->apellidos,
                    // 'dni' => $row->dni,
                    // 'ciudad' => $row->ciudad,
                    'email' => $row->email,
                    'rol_id' => $row->rol_id,
                    'activo' => $row->activo,
                    // 'orden' => $row->orden,
                )
            );
            $this->db->order_by('orden', 'ASC');
            $data['s_rol_id'] = $this->db->get('rol')->result();
            $data['seccion'] = 'admin-users';
            $data['main'] = 'usuario_read';

            $data['titulo'] = 'Gestión de Usuarios';
            $data['subtitulo'] = 'Ver Usuario';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/usuario'));
        }
    }


    public function create()
    {
        $data = array(
            'button' => 'Añadir',
            'action' => site_url('privado/usuario/create_action'),
            'data_fields' => array(
                'nombre' => set_value('nombre'),
                'apellidos' => set_value('apellidos'),
                // 'dni' => set_value('dni'),
                // 'ciudad' => set_value('ciudad'),
                'email' => set_value('email'),
                'password' => set_value('password'),
                'rol_id' => set_value('rol_id'),
                'activo' => set_value('activo') ? set_value('activo') : 0,
                // 'orden' => set_value('orden'),
                'usuario_id' => set_value('usuario_id'),
            )
        );
        $this->db->order_by('orden', 'ASC');
        $data['s_rol_id'] = $this->db->get('rol')->result();
        $data['seccion'] = 'admin-users';
        $data['main'] = 'usuario_form';

        $data['titulo'] = 'Gestión de Usuarios';
        $data['subtitulo'] = 'Añadir Usuario';
        $this->load->view('template', $data);
    }


    public function create_action()
    {
        $this->_rules('create');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'fecha_creacion' => date('Y-m-d H:i:s'),
                'nombre' => $this->input->post('nombre', TRUE),
                'apellidos' => $this->input->post('apellidos', TRUE),
                // 'dni' => $this->input->post('dni', TRUE),
                // 'ciudad' => $this->input->post('ciudad', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => md5($this->input->post('password', TRUE)),
                'rol_id' => $this->input->post('rol_id', TRUE),
                'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
                // 'orden' => $this->input->post('orden', TRUE),
            );

            $this->MUsuario_priv->insert($data);
            $this->session->set_flashdata('message', 'Usuario creado correctamente');
            redirect(site_url('privado/usuario'));
        }
    }


    public function update($id)
    {
        $row = $this->MUsuario_priv->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'action' => site_url('privado/usuario/update_action'),
                'data_fields' => array(
                    'nombre' => set_value('nombre', $row->nombre),
                    'apellidos' => set_value('apellidos', $row->apellidos),
                    // 'dni' => set_value('dni', $row->dni),
                    // 'ciudad' => set_value('ciudad', $row->ciudad),
                    'email' => set_value('email', $row->email),
                    'rol_id' => set_value('rol_id', $row->rol_id),
                    'activo' => set_value('activo', $row->activo),
                    // 'orden' => set_value('orden', $row->orden),
                    'usuario_id' => set_value('usuario_id', $row->usuario_id),
                )
            );

            $this->db->order_by('orden', 'ASC');
            $data['s_rol_id'] = $this->db->get('rol')->result();
            $data['seccion'] = 'admin-users';
            $data['main'] = 'usuario_form';

            $data['titulo'] = 'Gestión de Usuarios';
            $data['subtitulo'] = 'Modificar Usuario';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/usuario'));
        }
    }

    public function update_action()
    {
        $this->_rules('update');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('usuario_id', TRUE));
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre', TRUE),
                'apellidos' => $this->input->post('apellidos', TRUE),
                // 'dni' => $this->input->post('dni', TRUE),
                // 'ciudad' => $this->input->post('ciudad', TRUE),
                'email' => $this->input->post('email', TRUE),
                'rol_id' => $this->input->post('rol_id', TRUE),
                'activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
                // 'orden' => $this->input->post('orden', TRUE),
            );

            $this->MUsuario_priv->update($this->input->post('usuario_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Usuario modificado correctamente');
            redirect(site_url('privado/usuario'));
        }
    }

    public function delete($id)
    {
        $row = $this->MUsuario_priv->get_by_id($id);

        if ($row) {
            $this->MUsuario_priv->delete($id);
            $this->session->set_flashdata('message', 'Usuario eliminado correctamente');
            redirect(site_url('privado/usuario'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/usuario'));
        }
    }

    public function _rules($raction)
    {
        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'trim|required');
        // $this->form_validation->set_rules('dni', 'dni', 'trim|required');
        // $this->form_validation->set_rules('ciudad', 'ciudad', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        if ($raction == 'create') {
            $this->form_validation->set_rules('password', 'password', 'trim|required');
        }
        $this->form_validation->set_rules('rol_id', 'rol id', 'trim|required');
        $this->form_validation->set_rules('activo', 'activo', 'trim');
        // $this->form_validation->set_rules('orden', 'orden', 'trim');

        $this->form_validation->set_rules('usuario_id', 'usuario_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2020-03-13 10:24:50 */

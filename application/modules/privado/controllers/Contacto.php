<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacto extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MContacto_priv');
        $this->load->library('form_validation');
        $this->load->helper('formatos');

        modules::run('auth/is_loggedin');

        // $tienePermiso = modules::run('security/check_gestion_contactos');
        // if(!$tienePermiso) {
        //     redirect('');
        // }
    }

    public function index()
    {
        $this->session->set_userdata(array('contacto.q' => ''));
        //$this->session->set_userdata(array('od' => '', 'oc' => ''));
        redirect(current_url() . '/view', 'location');
    }


    public function view($page = 1)
    {
        if($this->input->get('p', TRUE)) {
            $page = $this->input->get('p', TRUE);
        }

        if (intval($page) <= 0) {

            $this->session->set_userdata(array('contacto.q' => ''));
            redirect(base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/view', 'location');
            redirect(current_url(), 'location');
        }
        if (count($_POST) > 0)
            $this->session->set_userdata(array('contacto.q' => $this->input->post('q')));

        $q = $this->session->userdata('contacto.q');

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
            $this->session->set_userdata(array('contacto.od' => $ordendir, 'contacto.oc' => $ordencampo));
        }

        // echo "HEY";
        // die();
        
        $oc = $this->session->userdata('contacto.oc');
        $od = $this->session->userdata('contacto.od');

        if ($nr != '') {
            $config['per_page'] = $nr;
            $this->session->set_userdata(array('contacto.nr' => $nr));
        }

        $nr = $this->session->userdata('contacto.nr');

        if ($nr != '') {
            $config['per_page'] = $nr;
        } else {
            $config['per_page'] = 10;
            $this->session->set_userdata(array('contacto.nr' => 10));
        }

        $config['base_url'] = current_url() . '/';
        $config['first_url'] = current_url() . '/';


        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->MContacto_priv->total_rows($q);

        $start = $config['per_page'] * ($page - 1);

        $contacto = $this->MContacto_priv->get_limit_data($config['per_page'], $start, $q, $oc, $od);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'contacto_data' => $contacto,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['titulo'] = 'Gestión de contactos';

        $data['seccion'] = 'admin-users';
        $data['main'] = 'contacto_list';
        $this->load->view('template', $data);

        // echo "HEY";
        // die();
        // $this->load->view('template', $data);

        // redirect('privado/contacto/view');
    }

    public function read($id)
    {
        $row = $this->MContacto_priv->get_by_id($id);
        if ($row) {
            // var_dump($id);
            // die();
            $data = array(
                'data_fields' => array(
                    'contacto_id' => $row->contacto_id,
                    'contacto_nombre' => $row->contacto_nombre,
                    'contacto_telefono' => $row->contacto_telefono,
                    'contacto_activo' => $row->contacto_activo,
                    // 'fecha_creacion' => $row->fecha_creacion,
                    // 'apellidos' => $row->apellidos,
                    // 'dni' => $row->dni,
                    // 'ciudad' => $row->ciudad,
                    // 'email' => $row->email,
                    // 'rol_id' => $row->rol_id,
                    // 'orden' => $row->contacto_id,
                )
            );
            $this->db->order_by('contacto_id', 'ASC');
            // $data['s_rol_id'] = $this->db->get('rol')->result();
            // $data['seccion'] = 'admin-users';
            $data['main'] = 'contacto_read';

            $data['titulo'] = 'Gestión de contactos';
            $data['subtitulo'] = 'Contacto';

            // var_dump($data);
            // die();

            $this->load->view('contacto_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/contacto'));
        }
    }


    public function create()
    {
        $data = array(
            'button' => 'Añadir',
            'action' => site_url('privado/contacto/create_action'),
            'data_fields' => array(
                'contacto_nombre' => set_value('contacto_nombre'),
                'contacto_telefono' => set_value('contacto_telefono'),
                'contacto_activo' => set_value('contacto_activo'),
                // 'apellidos' => set_value('apellidos'),
                // // 'dni' => set_value('dni'),
                // // 'ciudad' => set_value('ciudad'),
                // 'email' => set_value('email'),
                // 'password' => set_value('password'),
                // 'rol_id' => set_value('rol_id'),
                'contacto_activo' => set_value('activo') ? set_value('activo') : 0,
                // 'orden' => set_value('orden'),
                // 'contacto_id' => set_value('contacto_id'),
            )
        );
        $this->db->order_by('contacto_id', 'ASC');
        $data['s_rol_id'] = $this->db->get('rol')->result();
        $data['seccion'] = 'admin-users';
        $data['main'] = 'contacto_form';

        $data['titulo'] = 'Gestión de contactos';
        $data['subtitulo'] = 'Añadir contacto';
        $this->load->view('template', $data);
    }


    public function create_action()
    {
        $this->_rules('create');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                // 'fecha_creacion' => date('Y-m-d H:i:s'),
                'contacto_nombre' => $this->input->post('contacto_nombre', TRUE),
                'contacto_telefono' => $this->input->post('contacto_telefono', TRUE),
                'contacto_activo' => $this->input->post('contacto_activo', TRUE),
                // 'apellidos' => $this->input->post('apellidos', TRUE),
                // // 'dni' => $this->input->post('dni', TRUE),
                // // 'ciudad' => $this->input->post('ciudad', TRUE),
                // 'email' => $this->input->post('email', TRUE),
                // 'password' => md5($this->input->post('password', TRUE)),
                // 'rol_id' => $this->input->post('rol_id', TRUE),
                // 'contacto_activo' => $this->input->post('activo', TRUE) ? $this->input->post('activo', TRUE) : 0,
                // 'orden' => $this->input->post('orden', TRUE),
            );

            $this->MContacto_priv->insert($data);
            $this->session->set_flashdata('message', 'contacto creado correctamente');
            redirect(site_url('privado/contacto'));
        }
    }


    public function update($id)
    {
        $row = $this->MContacto_priv->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'action' => site_url('privado/contacto/update_action'),
                'data_fields' => array(
                    'contacto_nombre' => set_value('contacto_nombre', $row->contacto_nombre),
                    'contacto_telefono' => set_value('contacto_telefono', $row->contacto_telefono),
                    'contacto_activo' => set_value('contacto_activo', $row->contacto_activo),
                    'contacto_id' => set_value('contacto_id', $row->contacto_id),
                    // 'apellidos' => set_value('apellidos', $row->apellidos),
                    // // 'dni' => set_value('dni', $row->dni),
                    // // 'ciudad' => set_value('ciudad', $row->ciudad),
                    // 'email' => set_value('email', $row->email),
                    // 'rol_id' => set_value('rol_id', $row->rol_id),
                    // 'orden' => set_value('orden', $row->orden),
                    // 'contacto_id' => set_value('contacto_id', $row->contacto_id),
                )
            );

            // $this->db->order_by('contacto_id', 'ASC');
            // $data['s_rol_id'] = $this->db->get('rol')->result();
            // $data['seccion'] = 'admin-users';
            $data['main'] = 'contacto_form';

            $data['titulo'] = 'Gestión de contactos';
            $data['subtitulo'] = 'Modificar contacto';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/contacto'));
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
                // 'apellidos' => $this->input->post('apellidos', TRUE),
                // // 'dni' => $this->input->post('dni', TRUE),
                // // 'ciudad' => $this->input->post('ciudad', TRUE),
                // 'email' => $this->input->post('email', TRUE),
                // 'rol_id' => $this->input->post('rol_id', TRUE),
                // 'orden' => $this->input->post('orden', TRUE),
            );

            $this->MContacto_priv->update($this->input->post('contacto_id', TRUE), $data);
            $this->session->set_flashdata('message', 'contacto modificado correctamente');
            redirect(site_url('privado/contacto'));
        }
    }

    public function delete($id)
    {
        $row = $this->MContacto_priv->get_by_id($id);

        if ($row) {
            $this->MContacto_priv->delete($id);
            $this->session->set_flashdata('message', 'contacto eliminado correctamente');
            redirect(site_url('privado/contacto'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/contacto'));
        }
    }

    public function _rules($raction)
    {
        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
        // $this->form_validation->set_rules('apellidos', 'apellidos', 'trim|required');
        // // $this->form_validation->set_rules('dni', 'dni', 'trim|required');
        // // $this->form_validation->set_rules('ciudad', 'ciudad', 'trim|required');
        // $this->form_validation->set_rules('email', 'email', 'trim|required');
        if ($raction == 'create') {
            $this->form_validation->set_rules('password', 'password', 'trim|required');
        }
        $this->form_validation->set_rules('rol_id', 'rol id', 'trim|required');
        $this->form_validation->set_rules('activo', 'activo', 'trim');
        // $this->form_validation->set_rules('orden', 'orden', 'trim');

        $this->form_validation->set_rules('contacto_id', 'contacto_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file contacto.php */
/* Location: ./application/controllers/contacto.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2020-03-13 10:24:50 */

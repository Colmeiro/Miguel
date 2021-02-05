<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mi_perfil extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MUsuario_perfil');
        $this->load->library('form_validation');
        $this->load->helper('formatos');

        modules::run('auth/is_loggedin');

    }

    public function index()
    {
        // $this->session->set_userdata(array('usuario.q' => ''));
        $id = $this->session->userdata('identifier');
        
        $row = $this->MUsuario_perfil->get_by_id($id);
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
                    'orden' => $row->orden,
                )
            );
            $this->db->order_by('orden', 'ASC');
            $data['s_rol_id'] = $this->db->get('rol')->result();

            $data['usuario_grupo'] = $this->MUsuario_perfil->get_grupo_by_usuario_id($id);

            $data['seccion'] = 'mi-perfil';
            $data['main'] = 'mi-perfil';

            $data['titulo'] = 'Mi Perfil';
            $data['subtitulo'] = 'Usuario';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('privado/usuario'));
        }
    }
}

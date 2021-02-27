<?php
class Security extends MX_Controller
{
    private $permisos;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('authentication');
        $this->load->model('auth/MUsuario');

        $this->permisos = $this->MUsuario->getPermisos();
    }

    public function index()
    {
        modules::run('auth/is_loggedin');
    }

    public function check_acceso()
    {
        if(!isset($this->permisos)) {
            $this->permisos = $this->MUsuario->getPermisos();
        }

        if ($this->permisos->activo) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_admin()
    {
        //Indica si es Administrador
        return $this->permisos->es_admin;
    }

    public function check_resto()
    {
        //Indica si es Administrador
        return !$this->permisos->es_admin;
    }

    public function check_gestion_usuarios()
    {
        //Si es Administrador puede acceder a Gestión de Usuarios, si no, no.
        return $this->check_admin();
    }

    public function check_gestion_roles()
    {
        //Si es Administrador puede acceder a Gestión de Roles, si no, no.
        return $this->check_admin();
    }
}

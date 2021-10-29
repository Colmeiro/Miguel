<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MContacto_perfil extends CI_Model
{

    public $table = 'contactos';
    public $id = 'contactos_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by grupo_id
    function get_grupo_by_contacto_id($id)
    {
        $this->db->select('contactos.contacto_nombre as nombre');
        
        return $this->db->get('grupo')->result();
    }
}

/* End of file MUsuario.php */
/* Location: ./application/models/MUsuario.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2020-03-13 10:24:50 */

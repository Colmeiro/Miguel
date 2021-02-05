<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MUsuario_perfil extends CI_Model
{

    public $table = 'usuario';
    public $id = 'usuario_id';
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
    function get_grupo_by_usuario_id($id)
    {
        $this->db->select('grupo.grupo_id as grupo_id, grupo.nombre as nombre');
        $this->db->join("usuario_grupo", "usuario_grupo.grupo_id = grupo.grupo_id", "left");
        $this->db->where('usuario_grupo.usuario_id', $id);
        $this->db->where('usuario_grupo.activo', 1);
        $this->db->where('grupo.activo', 1);
		$this->db->order_by('usuario_grupo.orden', 'ASC');
        return $this->db->get('grupo')->result();
    }
}

/* End of file MUsuario.php */
/* Location: ./application/models/MUsuario.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2020-03-13 10:24:50 */

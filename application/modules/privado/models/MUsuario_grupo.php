<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MUsuario_grupo extends CI_Model
{

    public $table = 'usuario_grupo';
    public $id = 'usuario_grupo_id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->select('grupo.nombre as grupo_id,usuario_grupo.grupo_id as grupo_id_id,usuario.nombre as usuario_id, usuario.apellidos as apellidos,usuario_grupo.usuario_id as usuario_id_id,usuario_grupo.activo,usuario_grupo.orden,usuario_grupo_id');
        $this->db->order_by($this->id, $this->order);
        $this->db->order_by('orden', 'ASC');
        $this->db->join("grupo", "usuario_grupo.grupo_id = grupo.grupo_id", "left");
        $this->db->join("usuario", "usuario_grupo.usuario_id = usuario.usuario_id", "left");
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by grupo_id
    function get_by_grupo_id($id)
    {
        $this->db->select('usuario_grupo.grupo_id as grupo_id, rol.nombre as rol, usuario.nombre as nombre, usuario.apellidos as apellidos');
        $this->db->join("usuario", "usuario_grupo.usuario_id = usuario.usuario_id", "left");
        $this->db->join("rol", "usuario.rol_id = rol.rol_id", "left");
        $this->db->where('usuario_grupo.grupo_id', $id);
        $this->db->where('usuario_grupo.activo', 1);
        $this->db->where('usuario.activo', 1);
        $this->db->where('rol.activo', 1);
		$this->db->order_by('usuario_grupo.orden', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->select('grupo.nombre as grupo_id,usuario_grupo.grupo_id as grupo_id_id,usuario.nombre as usuario_id,usuario_grupo.usuario_id as usuario_id_id,usuario_grupo.activo,usuario_grupo.orden,usuario_grupo_id');

        $this->db->join("grupo", "usuario_grupo.grupo_id = grupo.grupo_id", "left");
        $this->db->join("usuario", "usuario_grupo.usuario_id = usuario.usuario_id", "left");
        if (!empty($q)) {
            $this->db->like('usuario_grupo_id', $q);
            $this->db->or_like('grupo.nombre', $q);
            $this->db->or_like('usuario.nombre', $q);
            $this->db->or_like('usuario_grupo.activo', $q);
            $this->db->or_like('usuario_grupo.orden', $q);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $oc = '', $od = '', $grupo_id=NULL)
    {
        $this->db->select('grupo.nombre as grupo_id,usuario_grupo.grupo_id as grupo_id_id,usuario.nombre as usuario_id, usuario.apellidos as apellidos,usuario_grupo.usuario_id as usuario_id_id,usuario_grupo.activo,usuario_grupo.orden,usuario_grupo_id,rol.nombre as rol');


        $this->db->join("grupo", "usuario_grupo.grupo_id = grupo.grupo_id", "left");
        $this->db->join("usuario", "usuario_grupo.usuario_id = usuario.usuario_id", "left");
        $this->db->join("rol", "usuario.rol_id = rol.rol_id", "left");

        if(!empty($grupo_id)) {
            $this->db->where('usuario_grupo.grupo_id', $grupo_id);
        }

        if (!empty($q)) {
            $this->db->like('usuario_grupo.usuario_grupo_id', $q);
            $this->db->or_like('grupo.nombre', $q);
            $this->db->or_like('usuario.nombre', $q);
            $this->db->or_like('usuario_grupo.activo', $q);
            $this->db->or_like('usuario_grupo.orden', $q);
        }

        if ($oc != '') {
            $this->db->order_by($oc, $od);
        } else {
            $this->db->order_by('usuario_grupo.grupo_id', 'asc');
            $this->db->order_by('orden', 'ASC');
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function getGrupoById($grupo_id)
    {
        $this->db->where('grupo_id', $grupo_id);
        return $this->db->get('grupo')->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    
    function getByUsuarioId($usuario_id)
    {
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->get($this->table)->row();
    }

    function getNombresStrByUsuarioId($usuario_id)
    {
        $this->db->select('grupo.nombre as nombre');
        $this->db->join("grupo", "usuario_grupo.grupo_id = grupo.grupo_id", "left");
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('usuario_grupo.activo', 1);
        $this->db->where('grupo.activo', 1);
        $result = $this->db->get($this->table)->result();
        if(empty($result)) {
            return '';
        }

        $str = '';
        foreach($result as $row) {
            if($str != '') {
                $str .= ',';
            }
            $str .= $row->nombre;
        }

        return $str;
    }

    function getUsuariosGrupoUnique($grupo_id)
    {
        $this->db->select('usuario.*');
        // $this->db->where("usuario.usuario_id NOT IN (SELECT usuario_id FROM usuario_grupo WHERE grupo_id = " . $grupo_id . ")");
        $this->db->order_by('nombre', 'ASC');
        return $this->db->get('usuario')->result();
    }
}

/* End of file MUsuario_grupo.php */
/* Location: ./application/models/MUsuario_grupo.php */
/* Please DO NOT modify this information : */
/* Generated by CRUZ Codeigniter CRUD Generator 2021-01-28 10:56:27 */

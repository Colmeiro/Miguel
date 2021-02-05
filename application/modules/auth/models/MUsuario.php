<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MUsuario extends CI_Model
{
    function getPermisos($id=0)
    {
        $this->db->select('usuario.activo, rol.nombre AS rol_usuario');
        $this->db->join('rol','rol.rol_id=usuario.rol_id','left');
        if(empty($id) && !empty($this->session->identifier)) {
            $id = $this->session->identifier;
        }
        $this->db->where('usuario_id', $id);
        $row = $this->db->get('usuario')->row();
        return $row;
    }

    function getDatos($id=0)
    {
        $this->db->select('usuario.usuario_id, usuario.fecha_creacion, usuario.nombre, usuario.apellidos, usuario.dni, usuario.ciudad, usuario.email');
        if(empty($id) && !empty($this->session->identifier)) {
            $id = $this->session->identifier;
        }
        $this->db->where('usuario_id', $id);
        $row = $this->db->get('usuario')->row();
        return $row;
    }

    function getPass($id=0)
    {
        $this->db->select('password');
        if(empty($id) && !empty($this->session->identifier)) {
            $id = $this->session->identifier;
        }
        $this->db->where('usuario_id', $id);
        $row = $this->db->get('usuario')->row();
        if(!empty($row))
        {
            return $row->password;
        }
        else
        {
            return NULL;
        }
    }

    function actualizarDatos($datos, $id=0)
    {
        if(empty($id) && !empty($this->session->identifier)) {
            $id = $this->session->identifier;
        }
        $this->db->where('usuario_id', $id);
        return $this->db->update('usuario', $datos);
    }
}
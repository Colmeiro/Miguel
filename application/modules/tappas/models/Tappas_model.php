<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tappas_model extends CI_Model
{

    public $table = 'locales';
    public $id = 'local_id';
    public $order = 'DESC';

    
    function __construct()
    {
        parent::__construct();
    }


    // get all
    function get_all()
    {
        $this->db->select('locales.local_nombre,
                            locales.local_telefono,
                            locales.local_ciudad,
                            locales.local_valoracion'
                        );

        $this->db->order_by($this->id, $this->order);return $this->db->get($this->table)->result();
    }


    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    
    // get total rows
    function total_rows($q = NULL) 
    {
        $this->db->select('locales.local_nombre,
                            locales.local_telefono,
                            locales.local_ciudad,
                            locales.local_valoracion'
                         );
        if(!empty($q)){
                $this->db->like('locales.local_id', $q);
                $this->db->or_like('locales.local_nombre', $q);
        }
        
        $this->db->from($this->table);
            return $this->db->count_all_results();
    }



    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $oc='', $od='') 
    {
        $this->db->select('locales.local_nombre,
                            locales.local_telefono,
                            locales.local_ciudad,
                            locales.local_valoracion'
                         );
        if(!empty($q)){
        $this->db->like('locales.local_id', $q);
            $this->db->or_like('locales.local_nombre', $q);
        }

        if($oc!=''){
            $this->db->order_by($oc,$od);
        }
        else
        $this->db->order_by('', '');
            $this->db->limit($limit, $start);
                return $this->db->get($this->table)->result();
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

}
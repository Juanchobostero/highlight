<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {


    //retorna todas las categorias con sus respectivas subcategorias
    public function get_full(){
        $categorias = $this->db->get('categorias')->result();
        foreach($categorias as $categoria){
        $this->db->where('id_cat', $categoria->id_categoria);
        $this->db->order_by('descripcionSC');
        $categoria->subcategorias = $this->db->get('subcategorias')->result();
        }

        return $categorias;

    }
  

    public function get_categoria($id)
    {
        $this->db->where('id_categoria', $id);
        return $this->db->get('categorias')->row();
    }

  
}
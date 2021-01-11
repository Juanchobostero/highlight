<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portadas_model extends CI_Model {

//--------------------------------------------
  public function getPortadas(){
    return $this->db->get('portadas')->result();
  }	

  public function get_habs(){
    $this->db->order_by('id_port', 'ASC');
    $this->db->where("estado", 1)->where("publicado", 'SI');
    return $this->db->get('portadas')->result();
  }

  public function get_imagenes(){
    return $this->db->get('imagenes')->row();
  }

}

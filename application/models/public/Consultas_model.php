<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas_model extends CI_Model {

//--------------------------------------------
public function add($data){
    return $this->db->insert('mensajes', $data);
}

}
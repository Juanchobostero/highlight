<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institucional_model extends CI_Model {

    public function get_nosotros(){
        $titulo = 'nosotros';
        $this->db->where('titulo', $titulo);

        $nosotros = $this->db->get('institucional')->row();

        return $nosotros;
    }
}
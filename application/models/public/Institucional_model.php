<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institucional_model extends CI_Model {

    public function get_nosotros(){
        $titulo = 'nosotros';
        $this->db->where('titulo', $titulo);

        $nosotros = $this->db->get('institucional')->row();

        return $nosotros;
    }

    public function get_privacidad(){
        $titulo = 'Politica de Privacidad';
        $this->db->where('titulo', $titulo);

        $privacidad = $this->db->get('institucional')->row();

        return $privacidad;
    }

    public function get_terminos(){
        $titulo = 'Terminos y condiciones';
        $this->db->where('titulo', $titulo);

        $terminos = $this->db->get('institucional')->row();

        return $terminos;
    }
}
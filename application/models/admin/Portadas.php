<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portadas extends CI_Model {

	//--------------------------------------------------------------
	public function get_portadas($estado, $publica = '') {
		$this->db->where('estado', $estado);
		if ($publica) {
			// 1 => SI; 2 => NO
			$this->db->where('publicado', $publica);
		}
		return $this->db->get('portadas')->result();
	}

	//--------------------------------------------------------------
	public function get_portada($id_port) {
		$this->db->where('id_port', $id_port);
		return $this->db->get('portadas')->row();
	}

	//--------------------------------------------------------------
	public function crear($portada) {
		return $this->db->insert('portadas', $portada);
	}

	//--------------------------------------------------------------
	public function actualizar($id_port, $portada) {
		$this->db->where('id_port', $id_port);
		return $this->db->update('portadas', $portada);
	}
}

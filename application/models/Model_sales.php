<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sales extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function count() {
		return $this->db->get('sales')->num_rows();
	}

	public function insert($data = array()) {

		return $this->db->insert('sales', $data);
	}

	public function update($data = array(), $id) {
		$this->db->where('id', $id);
		return $this->db->update('sales', $data);
	} 

	public function get($id) {
		return $this->db->where('id', $id)->get('sales')->row();
	}    
 

	public function delete($id) {
		$this->db->where('id', $id); 
		return $this->db->delete('sales');
	} 

	public function show($limit = 0, $offset = 0) {
		if($limit != 0) {
			$query = $this->db->limit($limit, $offset)->get('sales');
		} else {
			$query = $this->db->get('sales');
		}
		return $query->result();
	} 

	public function getNama($id) {
		return $this->db->where('id', $id)->get('sales')->row()->nama;
	}
  
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pelanggan extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function count() {
		return $this->db->get('pelanggan')->num_rows();
	}

	public function insert($data = array()) {

		return $this->db->insert('pelanggan', $data);
	}

	public function insertpengiriman($data = array()) {

		return $this->db->insert('pengiriman', $data);
	}


	public function search_pelanggan($keyword) {
		$query = $this->db->query("SELECT * FROM pelanggan WHERE nama LIKE '%$keyword%' ");
    return $query->result();
	}

	public function update($data = array(), $id) {
		$this->db->where('id', $id);
		return $this->db->update('pelanggan', $data);
	} 

	public function get($id) {
		return $this->db->where('id', $id)->get('pelanggan')->row();
	}  

	public function GetDataPengiriman($query) {
		// return $this->db->get('pengiriman')->result();
		return $this->db->query($query)->result();
	} 

	public function GetDataJoin($query) {
		// return $this->db->get('pengiriman')->result();
		return $this->db->query($query)->result();
	}   
 

	public function delete($id) {
		$this->db->where('id', $id); 
		return $this->db->delete('pelanggan');
	} 

	public function show($limit = 0, $offset = 0) {
		if($limit != 0) {
			$query = $this->db->limit($limit, $offset)->get('pelanggan');
		} else {
			$query = $this->db->get('pelanggan');
		}
		return $query->result();
	} 

	public function getNama($id) {
		return $this->db->where('id', $id)->get('pelanggan')->row()->nama;
	}
 

	public function getPengirimanByPelangganID($produk_id){ 
		$this->db->select('pelanggan.*, pengiriman.*');
		$this->db->join('pelanggan', 'pelanggan.id = pengiriman.pelanggan_id');
		$this->db->where('pelanggan_id', $pelanggan_id);
		$query = $this->db->get('pengiriman'); 
		return $query->result();
	}
}


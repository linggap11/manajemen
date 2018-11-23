<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_admin extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function count() {
		return $this->db->get('admin')->num_rows();
	}

	public function insert($data = array()) {

		return $this->db->insert('admin', $data);
	}

	public function update($data = array(), $id) {
		$this->db->where('id', $id);
		return $this->db->update('admin', $data);
	}

	public function hakAkses() {
		if($this->session->has_userdata('admin_id')) {
			$this->db->select('hak_akses');
			$this->db->where('id', $this->session->admin_id);
			$query = $this->db->get('admin')->row();
			return $query->hak_akses;
		} else {
			return array();
		}
	}

	public function updateLastLogin($id) {
		$data = array(
			'last_login' => date('Y-m-d H:i:s')
			);
		return $this->db->where('id', $id)->update('admin',$data);
	}

	public function get($id) {
		return $this->db->where('id', $id)->get('admin')->row();
	}
 

	public function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('admin');
	}

	public function show($limit = 0, $offset = 0) {
		if($limit != 0) {
			$query = $this->db->limit($limit, $offset)->get('admin');
		} else {
			$query = $this->db->get('admin');
		}
		return $query->result();
	}

	public function getLogin($input) {
		return $this->db->where('username', $input)->or_where('email', $input)->get('admin')->result();
	}

	public function getNama($id) {
		return $this->db->where('id', $id)->get('admin')->result()[0]->nama;
	}

	/* Search */
	public function countSearch($nama) {
		return $this->db->like('nama', $nama)->or_like('username', $nama)->or_like('email', $nama)->get('admin')->num_rows();
	}

	public function showSearch($nama, $limit = 0, $offset = 0) {
		if($limit != 0) {
			$query = $this->db->like('nama', $nama)->or_like('username', $nama)->or_like('email', $nama)->limit($limit, $offset)->get('admin');
		} else {
			$query = $this->db->like('nama', $nama)->or_like('username', $nama)->or_like('email', $nama)->get('admin');
		}
		return $query->result();
	}

	/* Check username & email */
	public function cek_username($username) {
		$query = $this->db->where('username', $username)->get('admin');
		return ($query->num_rows() > 0) ? true : false;
	}

	public function cek_email($email) {
		$query = $this->db->where('email', $email)->get('admin');
		return ($query->num_rows() > 0) ? true : false;
	}
}
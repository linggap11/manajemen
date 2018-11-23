<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			$this->session->set_flashdata('warning', 'Silahkan login untuk melanjutkan.');
			redirect(site_url('admin/login'));
		}
		$this->load->model('model_admin');
	}

	public function index($offset = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
		    );
 
		$data['result'] = $this->model_admin->show();
		$data['curr_page'] = ($offset != '') ? $offset + 1: 1;
		$data['query'] = '';

		$this->load->view('admin/layout/header', array('title' => 'Kelola Admin', 'menu' => 'kelola_admin', 'css' => $css));
		$this->load->view('admin/kelola_admin/list', $data);
	}

	public function delete($id = 0) {
		$referred_from = $this->agent->referrer();
		if($id == 0) {
			$this->session->set_flashdata('info', 'Admin tidak ditemukan.');
		} else {
			if($id == $this->session->admin_id) {
				$this->session->set_flashdata('info', 'Tidak bisa menghapus diri sendiri.');
			} else {
				if($this->model_admin->delete($id)) {
					$this->session->set_flashdata('sukses', 'Berhasil menghapus admin.');
				} else {
					$this->session->set_flashdata('error', 'Gagal menghapus admin.');
				}
			}
		}
		redirect($referred_from, 'refresh');
	}
 
	public function tambah() {
		if($this->input->post('submit')) {

			// validasi

			$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|callback_cek_username');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_cek_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|required|matches[password]');  
			$this->form_validation->set_rules('hak_akses', 'Hak Akses', 'trim|required');  

			if ($this->form_validation->run() == false) {
				$this->load->view('admin/layout/header', array('title' => 'Tambah Admin', 'menu' => 'kelola_admin'));
				$this->load->view('admin/kelola_admin/tambah');
			} else {

				$data['nama'] = $this->input->post('nama');
				$data['username'] = $this->input->post('username');
				$data['email'] = $this->input->post('email');
				$data['password'] = encrypt_password($this->input->post('password')); 
				$data['hak_akses'] = $this->input->post('hak_akses'); 

				if($this->model_admin->insert($data)) {
					$this->session->set_flashdata('sukses', 'Berhasil menambah admin.');
				} else {
					$this->session->set_flashdata('error', 'Gagal menambah admin.');
				}
				redirect(site_url('admin/kelola_admin'), 'refresh');
			}
		} else {
			$this->load->view('admin/layout/header', array('title' => 'Tambah Admin', 'menu' => 'kelola_admin'));
			$this->load->view('admin/kelola_admin/tambah'); 
		}
	}

	public function edit($id = 0) {
		$data['admin'] = $this->model_admin->get($id);
		if(($id == 0) || (!$data['admin'])) {
			$this->session->set_flashdata('info', 'Admin tidak ditemukan.');
			redirect(site_url('admin/kelola_admin'), 'refresh');
		} 
		$data['id'] = $id;
		if($this->input->post('submit')) {

			$data_edit['nama'] = $this->input->post('nama');
			$data_edit['username'] = $this->input->post('username');
			$data_edit['email'] = $this->input->post('email');  
			$data_edit['hak_akses'] = $this->input->post('hak_akses');  

			// validasi

			$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

			if($data['admin']->username != $data_edit['username']) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|callback_cek_username');
			}
			if($data['admin']->email != $data_edit['email']) {
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_cek_email');
			} 
			if($data['admin']->hak_akses != $data_edit['hak_akses']) { 
				$this->form_validation->set_rules('hak_akses', 'Hak Akses', 'trim|required');  
			}  
			if($this->input->post('password') != '') {
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
				$this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|required|matches[password]');
				$data_edit['password'] = encrypt_password($this->input->post('password'));
			}

			if ($this->form_validation->run() == false) {
				$this->load->view('admin/layout/header', array('title' => 'Edit Admin - ' . $data['admin']->nama, 'menu' => 'kelola_admin'));
				$this->load->view('admin/kelola_admin/edit', $data);
			} else {

				if($this->model_admin->update($data_edit, $id)) {
					$this->session->set_flashdata('sukses', 'Berhasil mengubah admin.');
				} else {
					$this->session->set_flashdata('error', 'Gagal mengubah admin.');
				}
				redirect(site_url('admin/kelola_admin'), 'refresh');
			}
		} else {
			$this->load->view('admin/layout/header', array('title' => 'Edit Admin - ' . $data['admin']->nama, 'menu' => 'kelola_admin'));
			$this->load->view('admin/kelola_admin/edit', $data); 
		}
	}
	// callback username dan password
	public function cek_username($username) {
		if($this->model_admin->cek_username($username)) {
			$this->form_validation->set_message('cek_username', 'Username sudah ada yang menggunakan.');
			return false;
		} else {
			return true;
		}
	}

	public function cek_email($email) {
		if($this->model_admin->cek_email($email)) {
			$this->form_validation->set_message('cek_email', 'Email sudah ada yang menggunakan.');
			return false;
		} else {
			return true;
		}
	}
}
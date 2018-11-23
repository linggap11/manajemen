<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_sales extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			$this->session->set_flashdata('warning', 'Silahkan login untuk melanjutkan.');
			redirect(site_url('admin/login'));
		}
		$this->load->model('model_sales');
	}

	public function index($offset = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
		    );
 
		$data['result'] = $this->model_sales->show();
		$data['curr_page'] = ($offset != '') ? $offset + 1: 1;
		$data['query'] = '';

		$this->load->view('admin/layout/header', array('title' => 'Kelola Sales', 'menu' => 'kelola_sales', 'css' => $css));
		$this->load->view('admin/kelola_sales/list', $data);
	}

	public function delete($id = 0) {
		$referred_from = $this->agent->referrer();
		if($id == 0) {
			$this->session->set_flashdata('info', 'Sales tidak ditemukan.');
		} else { 
			if($this->model_sales->delete($id)) {
				$this->session->set_flashdata('sukses', 'Berhasil menghapus Sales.');
			} else {
				$this->session->set_flashdata('error', 'Gagal menghapus Sales.');
			} 
		}
		redirect($referred_from, 'refresh');
	}
 
	public function tambah() {
		if($this->input->post('submit')) { 
			
			// validasi 
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required'); 
			$this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'trim|required'); 
			$this->form_validation->set_rules('no_telp', 'Nomor Telfon', 'trim|required'); 
			$this->form_validation->set_rules('no_gps', 'Nomor GPS', 'trim|required'); 

			if ($this->form_validation->run() == false) {
				$this->load->view('admin/layout/header', array('title' => 'Tambah Sales', 'menu' => 'kelola_sales'));
				$this->load->view('admin/kelola_sales/tambah');
			} else {

				$data['nama'] = $this->input->post('nama'); 
				$data['plat_nomor'] = $this->input->post('plat_nomor'); 
				$data['no_telp'] = $this->input->post('no_telp'); 
				$data['no_gps'] = $this->input->post('no_gps'); 

				if($this->model_sales->insert($data)) {
					$this->session->set_flashdata('sukses', 'Berhasil menambah Sales.');
				} else {
					$this->session->set_flashdata('error', 'Gagal menambah Sales.');
				}
				redirect(site_url('admin/kelola_sales'), 'refresh');
			}
		} else {
			$this->load->view('admin/layout/header', array('title' => 'Tambah Sales', 'menu' => 'kelola_sales'));
			$this->load->view('admin/kelola_sales/tambah'); 
		}
	}

	public function edit($id = 0) {
		$data['sales'] = $this->model_sales->get($id); 
		if(($id == 0) || (!$data['sales'])) {
			$this->session->set_flashdata('info', 'sales tidak ditemukan.');
			redirect(site_url('admin/kelola_sales'), 'refresh');
		} 
		$data['id'] = $id;
		if($this->input->post('submit')) {

			$data_edit['nama'] = $this->input->post('nama'); 
			$data_edit['plat_nomor'] = $this->input->post('plat_nomor');  
			$data_edit['no_telp'] = $this->input->post('no_telp'); 
			$data_edit['no_gps'] = $this->input->post('no_gps'); 

			// validasi  
			if($data['sales']->nama != $data_edit['nama']) {
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
			}  
			if($data['sales']->plat_nomor != $data_edit['plat_nomor']) {
				$this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'trim|required');
			}  
			if($data['sales']->no_telp != $data_edit['no_telp']) {
				$this->form_validation->set_rules('no_telp', 'Nomor Telfon', 'trim|required');
			}   
			if($data['sales']->no_gps != $data_edit['no_gps']) {
				$this->form_validation->set_rules('no_gps', 'Nomor Gps', 'trim|required');
			}   
			if ($this->form_validation->run() == false) {
				$this->load->view('admin/layout/header', array('title' => 'Edit Sales - ' . $data['sales']->nama, 'menu' => 'kelola_sales'));
				$this->load->view('admin/kelola_sales/edit', $data);
			} else {

				if($this->model_sales->update($data_edit, $id)) {
					$this->session->set_flashdata('sukses', 'Berhasil mengubah Sales.');
				} else {
					$this->session->set_flashdata('error', 'Gagal mengubah Sales.');
				}
				redirect(site_url('admin/kelola_sales'), 'refresh');
			}
		} else {
			$this->load->view('admin/layout/header', array('title' => 'Edit Sales - ' . $data['sales']->nama, 'menu' => 'kelola_sales'));
			$this->load->view('admin/kelola_sales/edit', $data); 
		}
	}  
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_produk extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			$this->session->set_flashdata('warning', 'Silahkan login untuk melanjutkan.');
			redirect(site_url('admin/login'));
		}
		$this->load->model('model_produk');
		$this->load->model('model_pelanggan');		
		$this->load->helpers('custom_helper');
	}

	public function get_produk() {
		if (isset($_GET['term'])) {
			$arr_result = array();
			$result = $this->model_produk->search_produk($_GET['term']);
			if (count($result) > 0) {
			foreach ($result as $row)
					$arr_result[] = $row->nama.' (Kode: '.$row->kode.')';
					echo json_encode($arr_result);
			}
		}
	}

	public function get_data_produk_bykode($kode) {
		$data = $this->model_produk->get_data_produk_bykode($kode);
		$value ="";
		foreach ($data as $row) {
			$value = $row;
		}
		echo json_encode($value);
	}

	public function get_data_sales_byid($id) {
		$data = $this->model_produk->get_data_sales_byid($id);
		$value ="";
		foreach ($data as $row) {
			$value = $row;
		}
		echo json_encode($value);
	}

	

	public function surat_jalan($no_pengiriman, $pelanggan_id) {
		echo $no_pengiriman;
	}

	public function batal($no_pengiriman, $pelanggan_id) {
		$this->db->where('no_pengiriman', $no_pengiriman);
		$this->db->delete('pengiriman');
		redirect('admin/kelola_pelanggan/produk/'.$pelanggan_id,'refresh');
	}

	public function get_pengiriman_by_pelanggan($id_pelanggan) {
		$data_pengiriman = $this->model_produk->get_pengiriman_by_pelanggan($id_pelanggan);

		foreach ($data_pengiriman as $row) {
			$value = $row;
			$value->aksi = '<a href="'.base_url().'admin/Kelola_pengiriman/print_surat_jalan/'.$row->no_pengiriman.'" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-print"></i> Surat Jalan</a>';
		}
		echo json_encode($data_pengiriman);
	}

	public function index($offset = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
		    );
 
		$data['result'] = $this->model_produk->show();
		$data['curr_page'] = ($offset != '') ? $offset + 1: 1;
		$data['query'] = '';

		$this->load->view('admin/layout/header', array('title' => 'Kelola Produk', 'menu' => 'kelola_produk', 'css' => $css));
		$this->load->view('admin/kelola_produk/list', $data);
	}

	public function delete($id = 0) {
		$referred_from = $this->agent->referrer();
		if($id == 0) {
			$this->session->set_flashdata('info', 'Produk tidak ditemukan.');
		} else { 
			if($this->model_produk->delete($id)) {
				$this->session->set_flashdata('sukses', 'Berhasil menghapus Produk.');
			} else {
				$this->session->set_flashdata('error', 'Gagal menghapus Produk.');
			} 
		}
		redirect($referred_from, 'refresh');
	}
 
	public function tambah() {
		if($this->input->post('submit')) { 
			
			// validasi 
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required'); 

			if ($this->form_validation->run() == false) {
				$data['data_pelanggan'] = $this->model_pelanggan->data_pelanggan();
				$this->load->view('admin/layout/header', array('title' => 'Tambah Produk', 'menu' => 'kelola_produk'));
				$this->load->view('admin/kelola_produk/tambah', $data);
			} else {
				$id = $this->model_produk->get_pelanggan_id();
				$tipe = $this->input->post('pilih_pelanggan');
				$nama_produk = $this->input->post('nama');
				$deskripsi = $this->input->post('deskripsi');
				$harga = $this->input->post('harga');

				$pelanggan_id = $this->input->post('pelanggan_id');
				$nama_pelanggan = $this->input->post('nama_pelanggan');
				$telp = $this->input->post('telp_pelanggan');
				$alamat = $this->input->post('alamat_pelanggan');
				$kode_pos = $this->input->post('kode_pos');


				$kode_produk = $this->model_produk->get_kode_produk();
				$kode_produk++;
				$data_pelanggan = array(
					'nama' => $nama_pelanggan,
					'no_telp' => $telp,
					'alamat' => $alamat,
					'kode_pos' => $kode_pos
				);

				$data_produk = array(
					'kode' => $kode_produk,
					'nama' => $nama_produk,
					'deskripsi' => $deskripsi,
					'harga' => $harga,
					'pelanggan_id' => $pelanggan_id // nu di post
				);			
				if(($this->model_produk->insert($data_produk))) {
					$this->session->set_flashdata('sukses', 'Berhasil menambah Produk.');
				} else {
					$this->session->set_flashdata('error', 'Gagal menambah Produk.');
				}		 
						
				redirect(site_url('admin/kelola_produk'), 'refresh');
			}
		} else {
			$data['data_pelanggan'] = $this->model_pelanggan->data_pelanggan();
			$this->load->view('admin/layout/header', array('title' => 'Tambah Produk', 'menu' => 'kelola_produk'));
			$this->load->view('admin/kelola_produk/tambah', $data); 
		}
	}

	public function edit($id = 0) {
		$data['produk'] = $this->model_produk->get($id); 
		if(($id == 0) || (!$data['produk'])) {
			$this->session->set_flashdata('info', 'produk tidak ditemukan.');
			redirect(site_url('admin/kelola_produk'), 'refresh');
		} 
		$data['id'] = $id;
		if($this->input->post('submit')) {

			$data_edit['deskripsi'] = $this->input->post('deskripsi'); 
			$data_edit['nama'] = $this->input->post('nama'); 
			$data_edit['harga'] = $this->input->post('harga');

			// validasi   
			if($data['produk']->nama != $data_edit['nama']) {
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
			}  
			if($data['produk']->harga != $data_edit['harga']) {
				$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
			}  
			if ($this->form_validation->run() == false) {
				$this->load->view('admin/layout/header', array('title' => 'Edit produk - ' . $data['produk']->nama, 'menu' => 'kelola_produk'));
				$this->load->view('admin/kelola_produk/edit', $data);
			} else {

				if($this->model_produk->update($data_edit, $id)) {
					$this->session->set_flashdata('sukses', 'Berhasil mengubah produk.');
				} else {
					$this->session->set_flashdata('error', 'Gagal mengubah produk.');
				}
				redirect(site_url('admin/kelola_produk'), 'refresh');
			}
		} else {
			$this->load->view('admin/layout/header', array('title' => 'Edit produk - ' . $data['produk']->nama, 'menu' => 'kelola_produk'));
			$this->load->view('admin/kelola_produk/edit', $data); 
		}
	}   
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pelanggan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			$this->session->set_flashdata('warning', 'Silahkan login untuk melanjutkan.');
			redirect(site_url('admin/login'));
		}
		$this->load->model('model_pelanggan');
		$this->load->model('model_produk');		
	}

	public function index($offset = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
		    );
		$data['result'] = $this->model_pelanggan->show();
		$data['curr_page'] = ($offset != '') ? $offset + 1: 1;
		$data['query'] = '';

		$this->load->view('admin/layout/header', array('title' => 'Kelola Pelanggan', 'menu' => 'kelola_pelanggan', 'css' => $css));
		$this->load->view('admin/kelola_pelanggan/list', $data);
	}

	public function delete($id = 0) {
		$referred_from = $this->agent->referrer();
		if($id == 0) {
			$this->session->set_flashdata('info', 'Pelanggan tidak ditemukan.');
		} else { 
			if($this->model_pelanggan->delete($id)) {
				$this->session->set_flashdata('sukses', 'Berhasil menghapus pelanggan.');
			} else {
				$this->session->set_flashdata('error', 'Gagal menghapus pelanggan.');
			} 
		}
		redirect($referred_from, 'refresh');
	}
 
	public function tambah() {
		if($this->input->post('submit')) { 
			
			// validasi 
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required'); 
			$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required'); 
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');  
			$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');  
			$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');  
			$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'trim|required'); 

			if ($this->form_validation->run() == false) {
				$this->load->view('admin/layout/header', array('title' => 'Tambah Pelanggan', 'menu' => 'kelola_pelanggan'));
				$this->load->view('admin/kelola_pelanggan/tambah');
			} else {

				$data['nama'] = $this->input->post('nama'); 
				$data['no_telp'] = $this->input->post('no_telp'); 
				$data['alamat'] = $this->input->post('alamat');
				$data['kode_pos'] = $this->input->post('kode_pos'); 
				$data['kecamatan'] = $this->input->post('kecamatan'); 
				$data['kelurahan'] = $this->input->post('kelurahan');  

				if($this->model_pelanggan->insert($data)) {
					$this->session->set_flashdata('sukses', 'Berhasil menambah pelanggan.');
				} else {
					$this->session->set_flashdata('error', 'Gagal menambah pelanggan.');
				}
				redirect(site_url('admin/kelola_pelanggan'), 'refresh');
			}
		} else {
			$this->load->view('admin/layout/header', array('title' => 'Tambah Pelanggan', 'menu' => 'kelola_pelanggan'));
			$this->load->view('admin/kelola_pelanggan/tambah'); 
		}
	}

	public function edit($id = 0) {
		$data['pelanggan'] = $this->model_pelanggan->get($id); 
		if(($id == 0) || (!$data['pelanggan'])) {
			$this->session->set_flashdata('info', 'Pelanggan tidak ditemukan.');
			redirect(site_url('admin/kelola_pelanggan'), 'refresh');
		} 
		$data['id'] = $id;
		if($this->input->post('submit')) {

			$data_edit['nama'] = $this->input->post('nama'); 
			$data_edit['no_telp'] = $this->input->post('no_telp');  
			$data_edit['alamat'] = $this->input->post('alamat');  
			$data_edit['kode_pos'] = $this->input->post('kode_pos');   
			$data_edit['kecamatan'] = $this->input->post('kecamatan');   
			$data_edit['kelurahan'] = $this->input->post('kelurahan');  

			// validasi  
			if($data['pelanggan']->nama != $data_edit['nama']) {
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
			}  
			if($data['pelanggan']->no_telp != $data_edit['no_telp']) {
				$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required');
			}  
			if($data['pelanggan']->alamat != $data_edit['alamat']) {
				$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			}
			if($data['pelanggan']->kode_pos != $data_edit['kode_pos']) {
				$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');
			} 
			if($data['pelanggan']->kecamatan != $data_edit['kecamatan']) {
				$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
			}  
			if($data['pelanggan']->kelurahan != $data_edit['kelurahan']) {
				$this->form_validation->set_rules('kelurahan', 'kelurahan', 'trim|required');
			}      
			if ($this->form_validation->run() == false) {
				$this->load->view('admin/layout/header', array('title' => 'Edit Pelanggan - ' . $data['pelanggan']->nama, 'menu' => 'kelola_pelanggan'));
				$this->load->view('admin/kelola_pelanggan/edit', $data);
			} else {

				if($this->model_pelanggan->update($data_edit, $id)) {
					$this->session->set_flashdata('sukses', 'Berhasil mengubah pelanggan.');
				} else {
					$this->session->set_flashdata('error', 'Gagal mengubah pelanggan.');
				}
				redirect(site_url('admin/kelola_pelanggan'), 'refresh');
			}
		} else {
			$this->load->view('admin/layout/header', array('title' => 'Edit Pelanggan - ' . $data['pelanggan']->nama, 'menu' => 'kelola_pelanggan'));
			$this->load->view('admin/kelola_pelanggan/edit', $data); 
		}
	}   


	public function produk($pelanggan_id = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css',
		    'assets/plugins/select2/dist/css/select2.css'
		    );
		$data['js'] = array(    
			'assets/plugins/select2/dist/js/select2.min.js',   
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
		    );
	
		if($pelanggan_id == 0)die; 

		$data['list_pelanggan'] = $this->model_pelanggan->show(); 
		$data['pelanggan'] = $this->model_pelanggan->get($pelanggan_id);
		$data['DataPelanggan'] = $this->model_produk->get_pengiriman_by_pelanggan($pelanggan_id); 
		// $data['DataPelanggan'] = $this->model_pelanggan->GetDataPengiriman("SELECT produk.kode, produk.nama, produk.harga, pengiriman.* FROM pengiriman LEFT OUTER JOIN produk ON produk.id = pengiriman.produk_id");

		$this->load->view('admin/layout/header', array('title' => 'Kelola Pelanggan', 'menu' => 'kelola_pelanggan', 'css' => $css));
		$this->load->view('admin/kelola_pelanggan/produk', $data);
	}


	public function get_produk($pelanggan_id = 0) {
	    if($pelanggan_id != 0){
	        $produk = $this->model_produk->getProdukByPelangganID($pelanggan_id);

	        $data = array();
	        foreach ($produk as $idx => $res) { 
	            $data[$idx][] = $res->no_pengiriman;
	            $data[$idx][] = $res->alamat;
	            $data[$idx][] = $res->kecamatan;
	            $data[$idx][] = $res->kelurahan;
	            $data[$idx][] = $res->berat;
	            $data[$idx][] = $res->kodepos;
	            $data[$idx][] = format_rupiah($res->harga);
	            $data[$idx][] = format_rupiah($res->biaya_tambahan);
	            $data[$idx][] = '<a data-id="'.$res->harga_id.'" data-produk_id="'.$res->id.'" data-nama="'.$res->nama.'" class="btn-hapus btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i> Hapus</a>';
	        }
	        echo json_encode(array('data' => $data));
	    }
	}

	public function get_produk_tambah($pelanggan_id = 0) {
	    if($pelanggan_id != 0){
	        $produk = $this->DataPelanggan($pelanggan_id);
	        $data = array();
	        foreach ($produk as $idx => $res) {
	            $data[$idx][] = $res->no_pengiriman;
	            $data[$idx][] = $res->alamat;
	            $data[$idx][] = $res->kecamatan;
	            $data[$idx][] = $res->kelurahan;
	            $data[$idx][] = $res->berat;
	            $data[$idx][] = $res->kodepos;
	            $data[$idx][] = format_rupiah($res->harga);
	            $data[$idx][] = format_rupiah($res->biaya_tambahan);
	            $data[$idx][] = '<input type="text" class="form-control input-sm data_input_'.$res->id.' currency" data-a-sep="." >'; 
	            $data[$idx][] = '<a class="btn-tambah-produk btn btn-xs btn-primary" data-produk_id="'.$res->id.'"  data-harga="'.$res->harga.'" href="#"><i class="fa fa-plus"></i> Tambahkan</a>';
	        }
	        echo json_encode(array('data' => $data));
	    }
	}
 
	public function tambah_produk() {
	    if($this->input->post('submit')){
	        $data['pelanggan_id'] = $this->input->post('pelanggan_id');
	        $data['kode'] = $this->input->post('kode'); 
	        $data['produk_id'] = $this->input->post('produk_id'); 
	        $data['no_pengiriman'] = $this->input->post('no_pengiriman'); 
	        $data['alamat'] = $this->input->post('alamat'); 
	        $data['kelurahan'] = $this->input->post('kelurahan'); 
	        $data['kecamatan'] = $this->input->post('kecamatan'); 
	        $data['berat'] = $this->input->post('berat'); 
	        $data['kodepos'] = $this->input->post('kodepos'); 
	        $data['harga'] = format_angka($this->input->post('harga'));
	        $data['biaya_tambahan'] = format_angka($this->input->post('biaya_tambahan')); 

	        $kode = $data['kode'];

	        $data['GetIdProduk'] = $this->model_pelanggan->GetDataJoin("SELECT id FROM produk WHERE kode = '$kode'");

	        foreach ($data['GetIdProduk'] as $datafix) {
	        	$produk_id = $datafix->id;
	        }

	        // INSERT INTO `pengiriman`(`id`, `no_pengiriman`, `alamat`, `kecamatan`, `kelurahan`, `harga`, `berat`, `biaya_tambahan`, `kodepos`, `produk_id`, `pelanggan_id`) VALUE

	        $data = array('no_pengiriman' => $data['no_pengiriman'],
	        			'alamat' => $data['alamat'],
	        			'kecamatan' => $data['kecamatan'],
	        			'kelurahan' => $data['kelurahan'],
	        			'harga' => $data['harga'],
	        			'berat' => $data['berat'],
	        			'biaya_tambahan' => $data['biaya_tambahan'],
	        			'kodepos' => $data['kodepos'],
	        			'biaya_tambahan' => $data['biaya_tambahan'],
	        			'produk_id' => $produk_id);

            if($this->model_pelanggan->insertPengiriman($data)){
               echo 'berhasil ditambahkan';
            }else{
                echo 'gagal ditambahkan';
            } 
	    }
	}

	public function hapus_produk_dari_pelanggan() {
	    if($this->input->post('submit')){
	        $id = $this->input->post('id');
	        if($this->model_produk->deleteHargaPengiriman($id)){
	           echo 'berhasil dihapus';
	        }else{
	            echo 'gagal dihapus';
	        }
	    }
	 }
}
	


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pengiriman extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			$this->session->set_flashdata('warning', 'Silahkan login untuk melanjutkan.');
			redirect(site_url('admin/login'));
		}
		$this->load->model('model_pelanggan');
		$this->load->model('model_produk');		
		$this->load->model('model_pengiriman');		
		$this->load->model('model_pengaturan');		
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

		$data['link'] = 'pengiriman';
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'kelola_pengiriman', 'css' => $css));
		$this->load->view('admin/kelola_pengiriman/pengiriman', $data);
	}

	public function list_pesanan() {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		$data['list_pesanan'] = $this->model_pengiriman->get_list_pesanan('PENDING');
		$this->load->view('admin/kelola_pengiriman/list_pesanan', $data);
	}

	public function list_pesanan_approve() {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		$data['list_pesanan'] = $this->model_pengiriman->get_list_pesanan('APPROVED');
		$data['pengiriman_berhasil'] = $this->model_pengiriman->get_pengiriman_berhasi();
		$this->load->view('admin/kelola_pengiriman/list_pesanan_approve', $data);
	}


	public function catat_transaksi() {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		$this->load->view('admin/kelola_pengiriman/catat_transaksi', $data);
	}

	public function simpan_pengiriman() {
		$tanggal_transaksi = $this->input->post('tanggal_transaksi');
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$telp_pelanggan = $this->input->post('telp_pelanggan');
		$alamat = $this->input->post('alamat');
		$kode_pos = $this->input->post('kode_pos');

		$nama_produk = $this->input->post('nama_produk');
		$deskripsi_produk = $this->input->post('deskripsi_produk');
		$berat = $this->input->post('berat');
		$harga = $this->input->post('harga');
		$biaya_tambahan = $this->input->post('biaya_tambahan');
		$total = $this->input->post('total');
		
		$id_sales = $this->input->post('id_sales');

		$pelanggan_id = $this->model_produk->get_pelanggan_id();
		$pelanggan_id++;
		$produk_id = $this->model_produk->get_produk_id();
		$produk_id++;
		$id_pengiriman = $this->model_produk->get_pengiriman_id();
		$id_pengiriman++;
		$no_pengiriman = $this->model_produk->get_no_pengiriman();
		$no_pengiriman++;
		$no_bukti = $this->model_produk->get_no_bukti();
		$no_bukti++;
		$transaksi_id = $this->model_produk->get_transaksi_id();
		$transaksi_id++;

		foreach ($id_sales as $idx => $kode) {
			$data_pelanggan = array(
				'id' => $pelanggan_id,
				'nama' => $nama_pelanggan[$idx],
				'no_telp' => $telp_pelanggan[$idx],
				'alamat' => $alamat[$idx],
				'kode_pos' => $kode_pos[$idx]
			);

			$data_produk = array(
				'id' => $produk_id,
				'nama' => $nama_produk[$idx],
				'deskripsi' => $deskripsi_produk[$idx],
			);
			$data_transaksi = array(
				'id' => ++$transaksi_id,
				'no_bukti' => $no_bukti,
				'status' => 'PENDING'
			);
			$data_pengiriman = array(
				'no_pengiriman' => $no_pengiriman,
				'tgl_transaksi' => $tanggal_transaksi,
				'alamat' => $alamat[$idx],
				'berat' => $berat[$idx],
				'harga' => $total[$idx],
				'biaya_tambahan' => $biaya_tambahan[$idx],
				'status' => 'INORDER',
				'produk_id' => $produk_id,
				'pelanggan_id' => $pelanggan_id,
				'sales_id' => $id_sales[$idx],
				'transaksi_id' => $transaksi_id
			);
			$this->model_pengiriman->simpan_pengiriman($data_pelanggan, $data_produk, $data_transaksi, $data_pengiriman);
			$this->model_pengiriman->ubah_status_sales($id_sales[$idx], array('status' => 'MENGIRIM'));

			$pelanggan_id++;
			$produk_id++;
			$id_pengiriman++;
			$no_pengiriman++;
			$no_bukti++;
			$transaksi_id++;
		}

		$this->session->set_flashdata('tambah_transaksi', '<div>Transaksi Berhasil Di Tambahkan! Lihat di Tab List Pesanan</div>');
		redirect('admin/kelola_pengiriman');
	}


	public function approve_pesanan($no_pengiriman = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		

		$data['link'] = "list_pesanan_approve";
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'kelola_pengiriman', 'css' => $css));
		$transaksi_id = $this->model_pengiriman->get_transaksi_id($no_pengiriman);
		if ($this->db->where('id', $transaksi_id->id)->update('transaksi', array('tgl_terima' => date("Y-m-d"),'status'=>'APPROVED'))) {
			$this->db->where('id', $transaksi_id->sales_id)->update('sales', array('status'=>'FREE'));
			$this->session->set_flashdata('sukses', 'Pesanan Berhasil Disetujui');
			$this->load->view('admin/Kelola_pengiriman/pengiriman', $data);
		}
	}

	public function batal_pesanan($no_pengiriman = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		

		$data['link'] = "list_pesanan";
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'kelola_pengiriman', 'css' => $css));
		
		if ($this->db->where('no_pengiriman', $no_pengiriman)->update('pengiriman', array('status'=>'BATAL'))) {
			$transaksi_id = $this->model_pengiriman->get_transaksi_id($no_pengiriman);
			$this->db->where('id', $transaksi_id->id)->update('transaksi', array('status'=>'BATAL'));
			$this->session->set_flashdata('error', 'Pesanan Berhasil Dibatalkan');
			$this->load->view('admin/Kelola_pengiriman/pengiriman', $data);
		}
	}

	public function print_surat_jalan($no_pengiriman = 0) {  
		 $data['profile'] = $this->model_pengaturan->get_profile();
		 
     $data['print'] = $this->model_pengiriman->get_data($no_pengiriman);
     $this->load->view('admin/kelola_pengiriman/print', $data);
  } 

	public function test() {
		// $data['profile'] = $this->model_pengaturan->get_profile();
     $data= date("Y-m-d");
     print_r($data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_keuangan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			$this->session->set_flashdata('warning', 'Silahkan login untuk melanjutkan.');
			redirect(site_url('admin/login'));
		}
		$this->load->model('model_keuangan');
		$this->load->model('model_pengaturan');
	}

	public function buku_kas() {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);


		$data['data_kas'] = $this->total_saldo_kas();	
		$this->load->view('admin/layout/header', array('title' => 'Buku Kas', 'menu' => 'buku_kas', 'css' => $css));
		$this->load->view('admin/kelola_keuangan/buku_kas', $data);
	}

	public function tambah_kas() {
		$tanggal = $this->input->post('tanggal');
		$keterangan = $this->input->post('keterangan');
		$deskripsi = $this->input->post('deskripsi');
		$nominal = $this->input->post('nominal');
		
		if ($keterangan == 'KREDIT') {
			$data_kas = array(
				'tanggal' => $tanggal,
				'deskripsi' => $deskripsi,
				'jenis' => $keterangan,
				'nominal' => 0
			);
			$no_piutang = $this->model_keuangan->get_no_piutang_tbhutang();
			$kas_id = $this->model_keuangan->get_kas_id();

			$data_hutang = array(
				'tanggal_masuk' => $tanggal,
				'tanggal_hutang' => $tanggal,
				'no_piutang' => ++$no_piutang,
				'deskripsi' => $deskripsi,
				'keterangan' => $keterangan,
				'nominal' => $nominal,
				'jumlah_hutang' => $nominal,
				'sisa_bayar' => $nominal,
				'status' => 'BELUM BAYAR',
				'kas_id' => $kas_id
			);

			$this->model_keuangan->tambah_kas($data_kas);
			$this->model_keuangan->tambah_kas_hutang($data_hutang);

		} else {
			$data_kas = array(
				'tanggal' => $tanggal,
				'deskripsi' => $deskripsi,
				'jenis' => $keterangan,
				'nominal' => $nominal
			);
			$this->model_keuangan->tambah_kas($data_kas);
		}
		$this->session->set_flashdata('sukses', 'Berhasil Menambahkan Kas.');
		redirect('admin/Kelola_keuangan/buku_kas','refresh');
		
	}

	public function tambah_hutang() {
		$tanggal = $this->input->post('tanggal');
		$deskripsi = $this->input->post('deskripsi');
		$nominal = $this->input->post('nominal');
		
		$data_kas = array(
			'tanggal' => $tanggal,
			'deskripsi' => $deskripsi,
			'jenis' => 'KREDIT',
			'nominal' => 0
		);
		$no_piutang = $this->model_keuangan->get_no_piutang_tbhutang();
		$kas_id = $this->model_keuangan->get_kas_id();

		$data_hutang = array(
			'tanggal_masuk' => $tanggal,
			'tanggal_hutang' => $tanggal,
			'no_piutang' => ++$no_piutang,
			'deskripsi' => $deskripsi,
			'keterangan' => 'KREDIT',
			'nominal' => $nominal,
			'jumlah_hutang' => $nominal,
			'sisa_bayar' => $nominal,
			'status' => 'BELUM BAYAR',
			'lunas' => 'BELUM',
			'kas_id' => $kas_id
		);

		$this->model_keuangan->tambah_kas($data_kas);
		$this->model_keuangan->tambah_kas_hutang($data_hutang);
		$this->session->set_flashdata('sukses', 'Berhasil Menambahkan Kas.');
		redirect('admin/Kelola_keuangan/buku_hutang','refresh');
	}

	public function ubah_kas($id) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		$data['edit_kas'] = $this->db->where('id', $id)->get('buku_kas')->row();
		$this->load->view('admin/layout/header', array('title' => 'Buku Kas', 'menu' => 'buku_kas', 'css' => $css));
		$this->load->view('admin/kelola_keuangan/edit_kas', $data);
		
	}

	public function simpan_edit() {
		$id = $this->input->post('id');
		$tanggal = $this->input->post('tanggal');
		$deskripsi = $this->input->post('deskripsi');
		$nominal = $this->input->post('nominal');
		$ket = $this->input->post('keterangan');

		$data = array(
			'id' => $id,
			'tanggal' => $tanggal,
			'deskripsi' => $deskripsi,
			'nominal' => $nominal,
			'jenis' => $ket
		);

		$this->model_keuangan->update_kas($id, $data);
		$this->session->set_flashdata('sukses', 'Berhasil Menambahkan Kas.');
		redirect('admin/Kelola_keuangan/buku_kas','refresh');
	}


	public function piutang() {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		$data['data_piutang'] = $this->total_saldo_piutang();	
		$data['profile'] = $this->model_pengaturan->get_profile();
		$this->load->view('admin/layout/header', array('title' => 'Piutang', 'menu' => 'piutang', 'css' => $css));
		$this->load->view('admin/kelola_keuangan/piutang', $data);
	}

	public function pembayaran() {
		$id = $this->input->post('id');
		$tanggal = $this->input->post('tanggal');
		$jenis = $this->input->post('jenis');
		$jumlah_piutang = $this->input->post('jumlah_piutang');
		$jumlah_bayar = $this->input->post('jumlah_bayar');
		$sisa_bayar = $this->input->post('sisa');
		$piutang = $this->model_keuangan->get_piutang_by_pelanggan($id);
		if ($sisa_bayar == 0) {
			$keterangan = 'LUNAS';
		} else {
			$keterangan = 'BAYAR SEBAGIAN';
		}
		$data_kas = array(
			'tanggal' => $tanggal,
			'deskripsi' => 'TAGIHAN PIUTANG '.$piutang->no_piutang.'  ( '.$piutang->nama.' ['.$piutang->produk.'] )',
			'jenis' => 'KREDIT',
			'nominal' => $jumlah_bayar
		);

		$data_pembayaran = array(
			'no_piutang' => $piutang->no_piutang,
			'tanggal' => $tanggal,
			'jenis' => $jenis,
			'jumlah_bayar' => $jumlah_bayar,
			'jumlah_piutang' => $jumlah_piutang,
			'sisa_bayar' => $sisa_bayar,
			'keterangan' => $keterangan,
			'no_invoice' => $piutang->no_invoice
		);
		$this->db->insert('piutang', $data_pembayaran);
		$this->db->insert('buku_kas', $data_kas);
		$this->session->set_flashdata('sukses', 'Piutang Berhasil Ditambahkan');
		redirect('admin/Kelola_keuangan/piutang');
	}

	public function get_data_piutang($no_piutang) {
		$data_piutang = $this->model_keuangan->get_data_piutang($no_piutang);
		echo json_encode($data_piutang);
	}

	public function get_data_hutang($no_piutang) {
		$data_hutang = $this->model_keuangan->get_data_hutang($no_piutang);
		echo json_encode($data_hutang);
	}
	public function get_detail_piutang($no_piutang) {
		$no_invoice = $this->model_keuangan->get_no_invoice($no_piutang);
		$detail_piutang = $this->model_keuangan->get_detail_piutang($no_invoice->no_invoice);
		echo json_encode($detail_piutang);
	}

	public function total_saldo_kas() {
		$data = $this->model_keuangan->tampil_kas();
		$kredit = 0; $debit = 0;
		foreach ($data as $row) {
			if ($row->jenis == 'KREDIT') {
				$kredit = $kredit + $row->nominal;
			} else {
				$debit = $debit + $row->nominal;
			}
			$row->total = $kredit - $debit;
		}
		return $data;
	}


	public function print_invoice_by_piutang($no_piutang) {
		$no_invoice = $this->model_keuangan->get_no_invoice($no_piutang);
	  $data['profile'] = $this->model_pengaturan->get_profile();
    $data['print'] = $this->model_keuangan->get_detail_piutang($no_invoice->no_invoice);
    // print_r($data);
    $this->load->view('admin/kelola_keuangan/print_invoice', $data);
	}
	
	public function total_saldo_piutang() {
		$data = $this->model_keuangan->tampil_piutang();
		$kredit = 0; $debit = 0;
		foreach ($data as $row) {
			if ($row->jenis == 'KREDIT') {
				$kredit = $kredit + $row->jumlah_bayar;
			} else {
				$debit = $debit + $row->jumlah_bayar;
			}
			$row->saldo = $kredit - $debit;
		}
		return $data;
	}

	public function total_saldo_hutang() {
		$data = $this->model_keuangan->tampil_hutang();
		$kredit = 0; $debit = 0;
		foreach ($data as $row) {
			if ($row->keterangan == 'KREDIT') {
				$kredit = $kredit + $row->nominal;
			} else {
				$debit = $debit + $row->nominal;
			}
			$row->saldo = $kredit - $debit;
		}

		

		return $data;
	}

	public function buku_hutang() {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js' 
			);
		$data['data_hutang'] = $this->total_saldo_hutang();	
		$data['profile'] = $this->model_pengaturan->get_profile();
		$this->load->view('admin/layout/header', array('title' => 'Buku Hutang', 'menu' => 'hutang', 'css' => $css));
		$this->load->view('admin/kelola_keuangan/hutang', $data);
	}

	public function get_totalSaldoKas() {
		$data = $this->total_saldo_kas();
		$temp = 0;
		foreach ($data as $totalKas) {
			$temp = $totalKas->total;	
		}
		return $temp;
	}

	public function pembayaran_hutang() {
		$id = $this->input->post('id');
		$kas_id = $this->input->post('kas_id');
		$tanggal = $this->input->post('tanggal');
		$tanggal_hutang = $this->input->post('tanggal_hutang');
		$jumlah_hutang = $this->input->post('jumlah_hutang');
		$jumlah_bayar = $this->input->post('jumlah_bayar');
		$sisa_bayar = $this->input->post('sisa');
		
		$data_hutang = $this->model_keuangan->get_kas_by_hutang($kas_id);
		if ($sisa_bayar == 0) {
			$status = 'LUNAS';
			$lunas = 'YA';
		} else {
			$status = 'BAYAR SEBAGIAN';
			$lunas = 'BELUM';
		}

		$data_kas = array(
			'tanggal' => $tanggal,
			'deskripsi' => 'PEMBAYARAN HUTANG '.$data_hutang->no_piutang.'  ('.$data_hutang->deskripsi.')',
			'jenis' => 'DEBIT',
			'nominal' => $jumlah_bayar
		);

		$data_pembayaran = array(
			'tanggal_masuk' => $tanggal,
			'tanggal_hutang' => $tanggal_hutang,
			'no_piutang' => $data_hutang->no_piutang,
			'deskripsi' => $this->input->post('deskripsi'),
			'nominal' => $jumlah_bayar,
			'jumlah_hutang' => $jumlah_hutang,
			'sisa_bayar' => $sisa_bayar,
			'keterangan' => 'DEBIT',
			'status' => $status,
			'lunas' => $lunas,
			'kas_id' => $kas_id
		);
		$this->db->insert('hutang', $data_pembayaran);
		$this->db->insert('buku_kas', $data_kas);
		$this->session->set_flashdata('sukses', 'Pembayaran Berhasil Ditambahkan');
		redirect('admin/Kelola_keuangan/buku_hutang');
	}


	

	public function test() {
		$asli = 'PE19010801';
		$data = 'PE'.date('ymd');


		if (substr($asli, 0, 8) == substr($data, 0, 8)) {
			echo 'sksk';
		}
		
		
	}

}

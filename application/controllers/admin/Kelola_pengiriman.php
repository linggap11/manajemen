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
		$this->load->model('model_keuangan');
	}

	public function index($offset = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js'
			);


		$data['link'] = 'pengiriman';
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'pengiriman', 'css' => $css));
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
		$data['pengiriman_berhasil'] = $this->model_pengiriman->get_pengiriman_berhasil();
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
		$data['data_pelanggan'] = $this->model_pelanggan->data_pelanggan_by_produk();
		$data['sales'] = $this->db->where('status', 'FREE')->get('sales')->result();
		$this->load->view('admin/kelola_pengiriman/catat_transaksi', $data);
	}

	public function get_data_produk($id) {
		$data = $this->model_pengiriman->data_produk($id);
		echo json_encode($data);
	}

	public function get_deskripsi_produk($id) {
		$data = $this->db->from('produk')->where('id', $id)->get()->row();
		echo json_encode($data);
	}

	public function simpan_pengiriman() {
		$tanggal_transaksi = $this->input->post('tanggal_transaksi');
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$telp_pelanggan = $this->input->post('telp_pelanggan');
		$alamat = $this->input->post('alamat');
		$kode_pos = $this->input->post('kode_pos');

		$list_nama_produk = $this->input->post('list_nama_produk'); // id
		$pelanggan_id = $this->input->post('pelanggan_id');
		$deskripsi_produk = $this->input->post('deskripsi_produk');
		$berat = $this->input->post('berat');
		$harga = $this->input->post('harga');
		$biaya_tambahan = $this->input->post('biaya_tambahan');
		$potongan = $this->input->post('potongan');
		$total = $this->input->post('total');

		$id_sales = $this->input->post('sales');

		$id_pengiriman = $this->model_produk->get_pengiriman_id();
		$id_pengiriman++;
		$no_pengiriman = $this->model_produk->get_no_pengiriman();
		$no_pengiriman++;
		$no_bukti = $this->model_produk->get_no_bukti();
		$no_bukti++;
		$transaksi_id = $this->model_produk->get_transaksi_id();
		$transaksi_id++;
		$no_piutang = $this->model_keuangan->get_no_piutang();
		$no_piutang++;


		foreach ($pelanggan_id as $idx => $kode) {
			$data_transaksi = array(
				'id' => $transaksi_id,
				'no_bukti' => $no_bukti,
				'status' => 'APPROVED',
				'tagihan' => 'BELUM LUNAS'
			);

			$data_pengiriman = array(
				'no_pengiriman' => $no_pengiriman,
				'tgl_transaksi' => $tanggal_transaksi,
				'berat' => $berat[$idx],
				'harga' => $harga[$idx],
				'total' => $total[$idx],
				'biaya_tambahan' => $biaya_tambahan[$idx],
				'status' => 'INORDER',
				'produk_id' => $list_nama_produk[$idx],
				'pelanggan_id' => $pelanggan_id[$idx],
				'sales_id' => $id_sales[$idx],
				'transaksi_id' => $transaksi_id
			);

			if ($biaya_tambahan[$idx] != '0') {
				$nama_produk = $this->model_produk->get_nama_produk($list_nama_produk[$idx]);
				$data_sales = $this->model_pengiriman->get_data_sales($id_sales[$idx]);
				$data_kas = array(
					'tanggal' => $tanggal_transaksi,
					'deskripsi' => 'KAS JALAN ( '.$nama_pelanggan[$idx].' - ['.$nama_produk->nama.'] - '.$data_sales->nama.'<strong>['.$data_sales->plat_nomor.']</strong>)',
					'jenis' => 'DEBIT',
					'nominal' => $biaya_tambahan[$idx] - $potongan[$idx],
					'no_pengiriman' => $no_pengiriman
				);
				$this->db->insert('buku_kas', $data_kas);
			}

			$this->model_pengiriman->simpan_pengiriman($data_transaksi, $data_pengiriman);
			$this->model_pengiriman->ubah_status_sales($id_sales[$idx], array('status' => 'MENGIRIM'));

			$id_pengiriman++;
			$no_pengiriman++;
			$no_bukti++;
			$transaksi_id++;

			//update deskripri
			$this->db->where('id',$list_nama_produk[$idx])->update('produk', array('deskripsi' => $deskripsi_produk[$idx]));
		}
		$this->session->set_flashdata('tambah_transaksi', '<div>Transaksi Berhasil Di Tambahkan!</div>');
		redirect('admin/Kelola_pengiriman');
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
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'pengiriman', 'css' => $css));
		$transaksi_id = $this->model_pengiriman->get_transaksi_id($no_pengiriman);
		if ($this->db->where('id', $transaksi_id->transaksi_id)->update('transaksi', array('status'=>'APPROVED'))) {
			$this->session->set_flashdata('sukses', 'Pesanan Berhasil Disetujui');
			$this->load->view('admin/kelola_pengiriman/pengiriman', $data);
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
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'pengiriman', 'css' => $css));

		if ($this->db->where('no_pengiriman', $no_pengiriman)->update('pengiriman', array('status'=>'BATAL'))) {
			$transaksi_id = $this->model_pengiriman->get_transaksi_id($no_pengiriman);
			$this->db->where('id', $transaksi_id->transaksi_id)->update('transaksi', array('status'=>'BATAL'));
			$this->db->where('id', $transaksi_id->sales_id)->update('sales', array('status'=>'FREE'));
			$this->session->set_flashdata('error', 'Pesanan Berhasil Dibatalkan');
			$this->load->view('admin/kelola_pengiriman/pengiriman', $data);
		}
	}

	public function pengiriman_selesai($no_pengiriman = 0) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js'
			);


		$data['link'] = "list_pesanan_approve";
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'pengiriman', 'css' => $css));
		$transaksi_id = $this->model_pengiriman->get_transaksi_id($no_pengiriman);
		if ($this->db->where('no_pengiriman', $no_pengiriman)->update('pengiriman', array('status'=>'BERHASIL'))) {
			$this->db->where('id', $transaksi_id->sales_id)->update('sales', array('status'=>'FREE'));
			$this->db->where('id', $transaksi_id->transaksi_id)->update('transaksi', array('tgl_terima'=> date("Y-m-d")));
			$this->session->set_flashdata('sukses', 'Pesanan Berhasil Disetujui');
			$this->load->view('admin/kelola_pengiriman/pengiriman', $data);
		}
	}

	public function print_surat_jalan($no_pengiriman = 0) {
		 $data['profile'] = $this->model_pengaturan->get_profile();

	     $data['print'] = $this->model_pengiriman->get_data($no_pengiriman);
	     $this->load->view('admin/kelola_pengiriman/print', $data);
	 }


	public function edit_pengiriman($no_pengiriman) {
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js'
			);


		$data['link'] = 'pengiriman';
		$data['data_pengiriman'] = $this->model_pengiriman->get_data_pengiriman($no_pengiriman);
		$data['data_pelanggan'] = $this->db->get('pelanggan')->result();
		$data['sales'] = $this->db->where('status', 'FREE')->get('sales')->result();
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'pengiriman', 'css' => $css));
		$this->load->view('admin/kelola_pengiriman/edit_pengiriman', $data);
	}

	public function update_pengiriman() {
		$no_pengiriman = $this->input->post('no_pengiriman');
		$tanggal_transaksi = $this->input->post('tanggal_transaksi');

		$id_produk = $this->input->post('list_nama_produk'); // id
		$nama_produk = $this->input->post('nama_produk');
		$deskripsi_produk = $this->input->post('deskripsi_produk');
		$pelanggan_id = $this->input->post('pelanggan_id');
		$nama_pelanggan = $this->input->post('nama_pelanggan');

		$berat = $this->input->post('berat');
		$harga = $this->input->post('harga');
		$biaya_tambahan = $this->input->post('biaya_tambahan');
		$potongan = $this->input->post('potongan');
		$total = $this->input->post('total');

		$id_sales = $this->input->post('sales');
		$nama_sales = $this->input->post('nama_sales');
		$plat = $this->input->post('no_kendaraan');

		$data_pengiriman = array(
			'tgl_transaksi' => $tanggal_transaksi,
			'berat' => $berat,
			'harga' => $harga,
			'biaya_tambahan' => $biaya_tambahan,
			'total' => $total,
			'pelanggan_id' => $pelanggan_id,
			'produk_id' => $id_produk,
			'sales_id' => $id_sales,
		);


		$data_kas = array(
			'tanggal' => $tanggal_transaksi,
			'deskripsi' => 'KAS JALAN ( '.$nama_pelanggan.' - ['.$nama_produk.'] - '.$nama_sales.'<strong>['.$plat.']</strong>)',
			'jenis' => 'DEBIT',
			'nominal' => $biaya_tambahan - $potongan,
			'no_pengiriman' => $no_pengiriman
		);

		$this->db->where('id', $id_produk)->update('produk', array('deskripsi' => $deskripsi_produk));
		if ($this->model_pengiriman->update_pengiriman($no_pengiriman, $data_pengiriman) == true) {
			$this->db->where('no_pengiriman', $no_pengiriman)->update('buku_kas', $data_kas);
			$this->session->set_flashdata('sukses', 'Pengiriman Berhasil Diperbaharui');
		}
		$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js'
			);


		$data['link'] = 'list_pesanan_approve';
		$this->load->view('admin/layout/header', array('title' => 'Kelola Pengiriman', 'menu' => 'pengiriman', 'css' => $css));
		$this->load->view('admin/kelola_pengiriman/pengiriman', $data);
	}

  	public function print_invoice() {
		 $list = $this->input->post('no_invoice_cek');
		 $id = $this->input->post('id'); // idpelanggan
		 $ppn = $this->input->post('ppn');
		 $list_invoice= [];
 		 $no_invoice = $this->model_pengiriman->get_no_invoice();
 		 $no_invoice++;
 		 $total_piutang = 0; // utk hitung total piutang
 		 $no_piutang = $this->model_keuangan->get_no_piutang();
		 $no_piutang++;
		 $this->db->insert('invoice', array('no_invoice' => $no_invoice));


 		 foreach ($list as $list_print) {
 		 		array_push($list_invoice, $this->model_pengiriman->data_tagihan_by_pelanggan($id, $list_print)) ;
 		 		$data_invoice = array('tagihan' => 'PENDING', 'no_invoice' => $no_invoice);
 		 		$this->model_pengiriman->update_status_tagihan($list_print, $data_invoice);
 		 		$temp = $this->model_pengiriman->get_total_piutang($list_print);
 		 		$total_piutang = ($total_piutang + $temp->total);
 		 }

		 if ($ppn == 'ppn') {
		 	 $pajak = $total_piutang * 0.10;
		 } else {
			 $pajak = 0;
		 }

 		 $data_piutang = array(
				'no_piutang' => $no_piutang,
				'tanggal' => date('Y-m-d'),
				'jumlah_bayar' => $total_piutang + $pajak,
				'sisa_bayar' => $total_piutang + $pajak,
				'jumlah_piutang' => $total_piutang + $pajak,
				'jenis' => 'KREDIT',
				'keterangan' => 'BELUM BAYAR',
				'no_invoice' => $no_invoice
			);
 		 $this->db->insert('piutang', $data_piutang);
		 $data['profile'] = $this->model_pengaturan->get_profile();
     $data['print'] = array_reduce($list_invoice, 'array_merge', array());
     $data['ppn'] = $pajak;
     $this->load->view('admin/kelola_pengiriman/print_invoice', $data);
  }


  public function penagihan() {
  	$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js'
			);

		$data['data_pelanggan'] = $this->model_pengiriman->data_tagihan();
		$this->load->view('admin/layout/header', array('title' => 'Penagihan', 'menu' => 'tagihan', 'css' => $css));
		$this->load->view('admin/kelola_pengiriman/penagihan', $data);

  }

  public function tagihan_pelanggan($id) {
  	$css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$data['js'] = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js'
			);

		$data['data_pelanggan'] = $this->db->where('id', $id)->get('pelanggan')->row();
		$data['data_tagihan'] = $this->model_pengiriman->data_tagihan_by_pelanggan_all($id);
		$this->load->view('admin/layout/header', array('title' => 'Penagihan', 'menu' => 'tagihan', 'css' => $css));
		$this->load->view('admin/kelola_pengiriman/tagihan_pelanggan', $data);
  }

  public function edit_tagihan() {
		$id = $this->input->post('pelanggan_id');
		$sj = $this->input->post('sj_edit');
		$berat = $this->input->post('berat_edit');
		$harga = $this->input->post('harga_edit');

		$data_tagihan = array(
			'berat' => $berat,
			'harga' => $harga,
			'total' => $berat * $harga
		);

		$this->db->where('no_pengiriman', $sj)->update('pengiriman', $data_tagihan);
		$this->session->set_flashdata('sukses', 'Berhasil Melakukan Pembaharuan');
		redirect('admin/Kelola_pengiriman/tagihan_pelanggan/'.$id.'');
	}

  public function pembayaran_lunas($no_pengiriman, $id) {
		$transaksi_id = $this->model_pengiriman->get_transaksi_id($no_pengiriman);
		if ($this->db->where('id', $transaksi_id->transaksi_id)->update('transaksi', array('tagihan'=>'LUNAS'))) {

			$css = array(
			    'assets/plugins/datatables/dataTables.bootstrap.css'
			    );
			$data['js'] = array(
			    'assets/plugins/datatables/jquery.dataTables.min.js',
			    'assets/plugins/datatables/dataTables.bootstrap.min.js'
				);

			$data['data_pelanggan'] = $this->db->where('id', $id)->get('pelanggan')->row();
			$data['data_tagihan'] = $this->model_pengiriman->data_tagihan_by_pelanggan_all($id);
			if (count($data['data_tagihan']) > 0) {
				$this->load->view('admin/layout/header', array('title' => 'Penagihan', 'menu' => 'tagihan', 'css' => $css));
				$this->session->set_flashdata('sukses', 'Pembayaran Berhasil Dilunasi');
				$this->load->view('admin/kelola_pengiriman/tagihan_pelanggan', $data);
			} else {
				$this->penagihan();
			}


		}

  }

	public function test() {
		$tahun = date('Y');
		$bulan = date('m');
		$tanggal = date('d');
		$no_invoice = $tahun.'/'.$bulan.'/'.$tanggal;;
		$data = $this->model_produk->get_no_bukti();
		$test = $this->model_pengiriman->get_no_invoice();
		print_r($no_invoice);
		echo "<br>";
		print_r($data);
		echo "<br>";
		echo substr($no_invoice, 0, 10);
		echo "<br>";
		print_r($test);
		echo "<br>";
	}
}

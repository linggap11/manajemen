<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model {

	public function show_laporan($bulan, $tahun, $status) {
		$this->db->select('no_pengiriman, no_bukti, tgl_transaksi, pengiriman.berat, sales.nama AS sales, plat_nomor ,pelanggan.nama, pelanggan.alamat, produk.kode, produk.nama AS nama_produk, produk.deskripsi ,pengiriman.harga AS total, pengiriman.status, transaksi.status AS status_transaksi, pengiriman.biaya_tambahan');
		$this->db->from('pengiriman');
		$this->db->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id');
		$this->db->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->join('sales', 'pengiriman.sales_id = sales.id');
		$this->db->join('transaksi', 'pengiriman.transaksi_id = transaksi.id');
		if ($bulan != 'all') {
			$this->db->where('MONTHNAME(tgl_transaksi)', $bulan);
		}
		if ($tahun != 'all') {
			$this->db->where('YEAR(tgl_transaksi)', $tahun);
		}
		if ($status != 'all') {
			$this->db->where('pengiriman.status', $status);
		}
		$this->db->order_by('no_pengiriman', "DESC");
		return $this->db->get()->result();
	}

	public function getNamaBulanPengiriman(){
    $this->db->select('MONTHNAME(tgl_transaksi) as bulan');
    $this->db->from('pengiriman');
    $this->db->join('transaksi', 'pengiriman.transaksi_id = transaksi.id');
    $this->db->where('transaksi.status != "BATAL"');
    $this->db->group_by('bulan')->order_by('bulan', "DESC");
    return $this->db->get()->result();
  }

  public function getTahunPengiriman(){
  	$this->db->select('YEAR(tgl_transaksi) as tahun');
    $this->db->from('pengiriman');
    $this->db->join('transaksi', 'pengiriman.transaksi_id = transaksi.id');
    $this->db->where('transaksi.status != "BATAL"');
    $this->db->group_by('tahun')->order_by('tahun', "desc");
    return $this->db->get()->result();
  }

  public function tampil_sales() {
  	return $this->db->select('sales.*, count(no_pengiriman) as total_pengiriman')->from('sales')->join('pengiriman', 'pengiriman.sales_id=sales.id')->group_by('pengiriman.sales_id')->order_by('total_pengiriman', 'desc')->get()->result();
  }

  public function get_detail_sales($id) {
  	return $this->db->select('sales.nama, sales.plat_nomor, pengiriman.*')->from('sales')->join('pengiriman', 'pengiriman.sales_id=sales.id')->where('pengiriman.sales_id', $id)->get()->result();
  }

  public function get_sj_by_sales($id) {
    $this->db->select('no_pengiriman, no_bukti, tgl_transaksi, pengiriman.berat, sales.nama AS sales, plat_nomor ,pelanggan.*, pelanggan.alamat, produk.kode, produk.nama AS nama_produk, produk.deskripsi ,pengiriman.harga AS total');
    $this->db->from('pengiriman');
    $this->db->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id');
    $this->db->join('produk', 'pengiriman.produk_id = produk.id');
    $this->db->join('sales', 'pengiriman.sales_id = sales.id');
    $this->db->join('transaksi', 'pengiriman.transaksi_id = transaksi.id');
    $this->db->where('pengiriman.sales_id', $id);
    $query = $this->db->get()->result();
    return $query;
  }

	public function data_tagihan($status, $tgl_awal, $tgl_akhir) {
		$this->db->select('transaksi.no_bukti, pengiriman.*, pelanggan.*, produk.nama AS nama_produk, produk.deskripsi AS produk_deskripsi, transaksi.tagihan, sales.plat_nomor');
		$this->db->from('pengiriman')->join('transaksi', 'pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')
		->join('produk', 'pengiriman.produk_id = produk.id')->join('sales', 'sales.id = pengiriman.sales_id');
		$this->db->where('transaksi.status = "APPROVED"');
		if ($status == null) {
			$this->db->where('transaksi.tagihan', 'BELUM LUNAS');
		} else {
			$this->db->where('transaksi.tagihan', $status);
		}
		if ($tgl_awal != null || $tgl_akhir != null) {
			$this->db->where('pengiriman.tgl_transaksi >= ', $tgl_awal);
			$this->db->where('pengiriman.tgl_transaksi <=', $tgl_akhir);
		}
		$this->db->where('transaksi.tagihan != "LUNAS"')->order_by('pelanggan.nama', 'ASC');
		return $this->db->get()->result();
	}

}

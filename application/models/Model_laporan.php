<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model {

	public function show_laporan($bulan, $tahun, $status) {
		$this->db->select('no_pengiriman, no_bukti, tgl_transaksi, pengiriman.berat, sales.nama AS sales, plat_nomor ,pelanggan.nama, pelanggan.alamat, produk.kode, produk.nama AS nama_produk, produk.deskripsi ,pengiriman.harga AS total, pengiriman.status, transaksi.status AS status_transaksi');
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

}

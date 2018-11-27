<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengiriman extends CI_Model {

	public function get_list_pesanan($status) {
		$this->db->select('no_pengiriman, no_bukti, tgl_transaksi, pengiriman.berat, sales.nama AS sales, plat_nomor ,pelanggan.nama, pelanggan.alamat, produk.kode, produk.nama AS nama_produk, produk.deskripsi ,pengiriman.harga AS total');
		$this->db->from('pengiriman');
		$this->db->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id');
		$this->db->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->join('sales', 'pengiriman.sales_id = sales.id');
		$this->db->join('transaksi', 'pengiriman.transaksi_id = transaksi.id');
		$this->db->where('transaksi.status', $status);
		$this->db->where('pengiriman.status != "BERHASIL" ');
		$query = $this->db->get();
		return $query->result();
	}

	public function simpan_pengiriman($data_produk, $data_transaksi, $data_pengiriman) {
		$this->db->insert('produk', $data_produk);
		$this->db->insert('transaksi', $data_transaksi);
		$this->db->insert('pengiriman', $data_pengiriman);
	}

	public function ubah_status_sales($sales_id, $status) {
		$this->db->where('id', $sales_id);
		$this->db->update('sales', $status);
	}


	public function get_data($no_pengiriman) {
		$this->db->select('no_pengiriman, no_bukti, tgl_transaksi, pengiriman.berat, sales.nama AS sales, plat_nomor ,pelanggan.*, pelanggan.alamat, produk.kode, produk.nama AS nama_produk, produk.deskripsi ,pengiriman.harga AS total');
		$this->db->from('pengiriman');
		$this->db->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id');
		$this->db->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->join('sales', 'pengiriman.sales_id = sales.id');
		$this->db->join('transaksi', 'pengiriman.transaksi_id = transaksi.id');
		$this->db->where('pengiriman.no_pengiriman', $no_pengiriman);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_pengiriman_berhasil() {
		$this->db->select('no_bukti, tgl_terima, sales.nama AS sales, plat_nomor ,pelanggan.nama AS pelanggan, pelanggan.alamat, pengiriman.harga AS total');
		$this->db->from('pengiriman');
		$this->db->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id');
		$this->db->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->join('sales', 'pengiriman.sales_id = sales.id');
		$this->db->join('transaksi', 'pengiriman.transaksi_id = transaksi.id');
		$this->db->where('pengiriman.status = "BERHASIL" ');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_transaksi_id($no_pengiriman) {
		$this->db->from('transaksi')->join('pengiriman','pengiriman.transaksi_id=transaksi.id');
		$this->db->where('pengiriman.no_pengiriman', $no_pengiriman);
		return $this->db->get()->row();
	}

	public function data_tagihan() {
		$this->db->select('transaksi.no_bukti, pengiriman.*, pelanggan.*, produk.nama AS nama_produk, produk.deskripsi AS produk_deskripsi, SUM(pengiriman.harga) AS total,  transaksi.tagihan');
		$this->db->from('pengiriman')->join('transaksi', 'pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->where('transaksi.status = "APPROVED"');
		$this->db->where('transaksi.tagihan != "LUNAS"')->group_by('pengiriman.pelanggan_id');
		return $this->db->get()->result();
	}

	public function data_tagihan_by_pelanggan($id) {
		$this->db->select('transaksi.no_bukti, pengiriman.*, pelanggan.*, produk.nama AS nama_produk, produk.deskripsi AS produk_deskripsi, transaksi.tagihan');
		$this->db->from('pengiriman')->join('transaksi', 'pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->where('transaksi.status = "APPROVED"');
		$this->db->where('transaksi.tagihan != "LUNAS"');
		$this->db->where('pengiriman.pelanggan_id', $id);
		return $this->db->get()->result();
	}
}
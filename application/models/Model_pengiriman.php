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

	public function simpan_pengiriman($data_transaksi, $data_pengiriman) {
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
		$this->db->select('transaksi.no_bukti, pengiriman.*, pelanggan.*, produk.nama AS nama_produk, produk.deskripsi AS produk_deskripsi, SUM(pengiriman.total) AS total,  COUNT(transaksi.tagihan) AS jum_tagihan');
		$this->db->from('pengiriman')->join('transaksi', 'pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->where('transaksi.status = "APPROVED"');
		$this->db->where('transaksi.tagihan != "LUNAS"')->group_by('pengiriman.pelanggan_id')->order_by('total', 'DESC');
		return $this->db->get()->result();
	}

	public function data_tagihan_by_pelanggan($id, $no_bukti) {
		$this->db->select('transaksi.no_bukti, pengiriman.*, pelanggan.*, produk.nama AS nama_produk, produk.deskripsi AS produk_deskripsi, transaksi.tagihan');
		$this->db->from('pengiriman')->join('transaksi', 'pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')->join('produk', 'pengiriman.produk_id = produk.id');
		$this->db->where('transaksi.status = "APPROVED"');
		$this->db->where('transaksi.tagihan != "LUNAS"');
		$this->db->where('transaksi.no_bukti', $no_bukti);
		$this->db->where('pengiriman.pelanggan_id', $id);
		return $this->db->get()->result();
	}

	public function data_tagihan_by_pelanggan_all($id) {
		$this->db->select('transaksi.no_bukti, pengiriman.*, pelanggan.*, produk.nama AS nama_produk, produk.deskripsi AS produk_deskripsi, transaksi.tagihan, sales.plat_nomor');
		$this->db->from('pengiriman')->join('transaksi', 'pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')
		->join('produk', 'pengiriman.produk_id = produk.id')->join('sales', 'sales.id = pengiriman.sales_id');
		$this->db->where('transaksi.status = "APPROVED"');
		$this->db->where('transaksi.tagihan != "LUNAS"');
		$this->db->where('pengiriman.pelanggan_id', $id)->order_by('pengiriman.tgl_transaksi', 'DESC');
		return $this->db->get()->result();
	}

	public function data_produk($pelanggan_id) {
		$this->db->select('pelanggan.*, produk.id AS produk_id, produk.nama AS nama_produk, produk.deskripsi');
		return $this->db->from('produk')->join('pelanggan', 'produk.pelanggan_id = pelanggan.id')->where('produk.pelanggan_id', $pelanggan_id)->get()->result();
	}


	public function update_status_tagihan($id, $status) {
		$this->db->where('no_bukti', $id);
		$this->db->update('transaksi', $status);
	}

	public function get_total_piutang($no_bukti) {
		$this->db->select('SUM(pengiriman.total) as total');
		$this->db->from('pengiriman')->join('transaksi', 'transaksi.id = pengiriman.transaksi_id');
		$this->db->where('transaksi.no_bukti', $no_bukti);
		return $this->db->get()->row();
	}
 	public function get_no_invoice() {
		$query = $this->db->query("SELECT no_invoice FROM invoice ORDER BY no_invoice DESC LIMIT 1");
		$tahun = date('y');
		$bulan = date('m');
		$no_invoice = $tahun.'/'.$bulan.'/';
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
          $data = $row;
      }
      return $data['no_invoice'];
    } else {
      return $no_invoice.'000';
    }
	}

	public function get_data_sales($id_sales) {
		$this->db->select('nama, plat_nomor')->from('sales')->where('id', $id_sales);
		$query = $this->db->get()->row();
		return $query;
	}

	public function get_data_pengiriman($no_pengiriman) {
		$this->db->select('transaksi.no_bukti, pengiriman.no_pengiriman, pengiriman.tgl_transaksi, pengiriman.biaya_tambahan,
		pengiriman.berat, pengiriman.total, sales.id as sales_id, sales.nama as sales, sales.plat_nomor, pelanggan.*,
		produk.id as produk_id, produk.nama as nama_produk, produk.deskripsi, produk.harga, pengiriman.biaya_tambahan as kas_jalan,
		buku_kas.nominal as potongan');
		$this->db->from('pengiriman')->join('transaksi', 'transaksi.id = pengiriman.transaksi_id')
			->join('sales','sales.id = pengiriman.sales_id')
			->join('pelanggan','pelanggan.id = pengiriman.pelanggan_id')
			->join('produk','produk.id = pengiriman.produk_id')
			->join('buku_kas','buku_kas.no_pengiriman = pengiriman.no_pengiriman')
			->where('pengiriman.no_pengiriman', $no_pengiriman);
		return $this->db->get()->row();
	}

	public function update_pengiriman($id, $data) {
		$this->db->where('no_pengiriman', $id);
		$this->db->update('pengiriman', $data);
		return true;
	}
}

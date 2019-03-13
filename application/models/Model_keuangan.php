<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_keuangan extends CI_Model {

	public function tambah_kas($data) {
		$this->db->insert('buku_kas', $data);
	}

	public function tambah_kas_hutang($data) {
		$this->db->insert('hutang', $data);
	}

	public function tampil_kas() {
		$this->db->select('buku_kas.*, nominal AS total');
		return $this->db->get('buku_kas')->result();
	}

	public function tampil_piutang() {
		$this->db->select('piutang.*, jumlah_piutang AS saldo, pelanggan.nama')->from('piutang')->join('invoice', 'invoice.no_invoice = piutang.no_invoice')->join('transaksi', 'transaksi.no_invoice = invoice.no_invoice')->join('pengiriman','pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')->group_by('piutang.id');
		return $this->db->get()->result();
	}

	public function tampil_hutang() {
		$this->db->from('hutang');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_data_piutang($no_piutang) {
		$this->db->select('piutang.*, jumlah_piutang AS saldo, pelanggan.nama')->from('piutang')->join('invoice', 'invoice.no_invoice = piutang.no_invoice')->join('transaksi', 'transaksi.no_invoice = invoice.no_invoice')->join('pengiriman','pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')->group_by('piutang.id');
		$this->db->where('piutang.no_piutang', $no_piutang)->order_by('piutang.id', 'DESC')->limit(1);
		return $this->db->get()->row();
	}

	public function get_data_hutang($no_piutang) {
		return $this->db->from('hutang')->where('no_piutang', $no_piutang)->order_by('id', 'DESC')->get()->row();
	}

	public function get_detail_piutang($no_invoice) {
		$this->db->select('pengiriman.no_pengiriman, pengiriman.tgl_transaksi, pengiriman.berat, pengiriman.harga, pengiriman.total, pelanggan.*, produk.nama as produk, produk.deskripsi, transaksi.no_invoice, sales.plat_nomor')->from('pengiriman')->join('transaksi', 'transaksi.id = pengiriman.transaksi_id')->join('pelanggan', 'pelanggan.id = pengiriman.pelanggan_id')->join('produk', 'produk.id = pengiriman.produk_id')->join('sales', 'sales.id = pengiriman.sales_id')->where('transaksi.no_invoice', $no_invoice);
		return $this->db->get()->result();
	}

	public function get_no_invoice($no_piutang) {
		$this->db->select('piutang.no_invoice')->from('piutang');
		$this->db->where('piutang.no_piutang', $no_piutang);
		return $this->db->get()->row();
	}

	public function update_kas($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('buku_kas', $data);
	}

	public function getNamaBulanPenjualan(){
    return $this->db->select('MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun')->group_by('bulan')->order_by('tahun')->get('buku_kas')->result();
  }

  public function getTahunPenjualan(){
  	return $this->db->select('YEAR(tanggal) as tahun')->group_by('tahun')->order_by('tahun', 'DESC')->get('buku_kas')->result();
  }

  public function get_no_piutang() {
  	$query = $this->db->query("SELECT no_piutang FROM piutang ORDER BY no_piutang DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      $no_piutang = 'PE'.date('ymd');
      if (substr($data['no_piutang'], 0, 8) == $no_piutang) {
      	return $data['no_piutang'];
      } else {
      	$kombinasi = date('ymd');
      	return 'PE'.$kombinasi.'00';
      }
    } else {
    	$kombinasi = date('ymd');
      return 'PE'.$kombinasi.'00';
    }
  }

  public function get_no_piutang_tbhutang() {
  	$query = $this->db->query("SELECT no_piutang FROM hutang ORDER BY no_piutang DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      $no_piutang = 'PH'.date('ym');
      if (substr($data['no_piutang'], 0, 8) == $no_piutang) {
      	return $data['no_piutang'];
      } else {
      	$kombinasi = date('ymd');
      	return 'PH'.$kombinasi.'00';
      }
    } else {
    	$kombinasi = date('ymd');
      return 'PH'.$kombinasi.'00';
    }
  }

  public function get_kas_id() {
  	$this->db->select('id')->from('buku_kas')->order_by('id','DESC')->limit(1);
  	$query = $this->db->get()->row();
  	return $query->id;
  }

  public function get_piutang_by_pelanggan($id) {
  	$this->db->select('piutang.no_piutang, piutang.no_invoice, pelanggan.nama, produk.nama as produk')->from('piutang')->join('invoice', 'invoice.no_invoice = piutang.no_invoice')->join('transaksi', 'transaksi.no_invoice = invoice.no_invoice')->join('pengiriman','pengiriman.transaksi_id = transaksi.id')->join('pelanggan', 'pengiriman.pelanggan_id = pelanggan.id')->join('produk', 'pengiriman.produk_id = produk.id');
  	return $this->db->where('piutang.id', $id)->get()->row();

  }

  public function get_kas_by_hutang($kas_id) {
  	return $this->db->from('buku_kas')->join('hutang', 'buku_kas.id = hutang.kas_id')->where('kas_id', $kas_id)->get()->row();
  }

  public function lunas($no_piutang) {
  	return $this->db->select('status')->from('hutang')->where('no_piutang', $no_piutang)->get()->result();
  }


}

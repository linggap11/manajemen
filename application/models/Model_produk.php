<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_produk extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	//get pengrimian by pelangggan
	public function get_pengiriman_by_pelanggan($id_pelanggan) {
		$this->db->select('no_pengiriman, produk.kode, sales.nama, pelanggan.alamat, pengiriman.berat, pengiriman.harga, pengiriman.pelanggan_id, pengiriman.status');
		$this->db->from('pelanggan');
		$this->db->join('pengiriman', 'pengiriman.pelanggan_id = pelanggan.id');
		$this->db->join('produk', 'produk.id = pengiriman.produk_id');
		$this->db->join('sales', 'sales.id = pengiriman.sales_id');
		$this->db->where('pengiriman.pelanggan_id', $id_pelanggan);
		$this->db->where('pengiriman.status != "BATAL" ');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_produk_bykode($kode) {
		$this->db->from('produk');
		$this->db->where('kode', $kode);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_sales_byid($id) {
		$this->db->from('sales');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();

	}

	public function search_produk($keyword) {
		$query = $this->db->query("SELECT * FROM produk WHERE kode LIKE '%$keyword%' OR nama LIKE '%$keyword%'");
    return $query->result();
	}

	public function search_sales($keyword) {
		$query = $this->db->query("SELECT * FROM sales WHERE nama LIKE '%$keyword%' AND status='FREE'");
    return $query->result();
	}

	public function count() {
		return $this->db->get('produk')->num_rows();
	}

	public function insert($data = array()) {

		return $this->db->insert('produk', $data);
	}

	public function insert_pelanggan($data = array()) {

		return $this->db->insert('pelanggan', $data);
	}

	public function insertPengiriman($data = array()) {

		return $this->db->insert('pengiriman', $data);
	}

	public function update($data = array(), $id) {
		$this->db->where('id', $id);
		return $this->db->update('produk', $data);
	}

	public function get($id) {
		return $this->db->where('id', $id)->get('produk')->row();
	}


	public function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete('produk');
	}

	public function insertHargaPengiriman($data = array()) {
		return $this->db->insert('pengiriman', $data);
	}
	public function deleteHargaPengiriman($id) {
		$this->db->where('id', $id);
		return $this->db->delete('pengiriman');
	}

	public function show($limit = 0, $offset = 0) {
		if($limit != 0) {
			$query = $this->db->limit($limit, $offset)->order_by('id', 'DESC')->get('produk');
		} else {
			$query = $this->db->from('produk')->order_by('id', 'DESC')->get();
		}
		return $query->result();
	}

	public function getNama($id) {
		return $this->db->where('id', $id)->get('produk')->row()->nama;
	}


	public function deletePengiriman($id) {
		$this->db->where('id', $id);
		return $this->db->delete('pengiriman');
	}


	public function countListHargaByPelangganID($pelanggan_id) {
		$this->db->where('pelanggan_id', $pelanggan_id);
		$this->db->where('status != "BATAL"');
		return $this->db->get('pengiriman')->num_rows();
	}

	public function getProdukByPelangganID($pelanggan_id){
		$this->db->select('pelanggan.*, produk.*, pengiriman.*');
		$this->db->join('produk', 'produk.id = pengiriman.produk_id');
		$this->db->join('pelanggan', 'pelanggan.id = pengiriman.pelanggan_id');
		$this->db->where('pengiriman.pelanggan_id', $pelanggan_id);
		return $this->db->get('pengiriman')->result();
	}


	public function getPengirimanByPelangganIDandProdukID($pelanggan_id, $produk_id){
		$this->db->select('produk.*, pengiriman.harga as harga_pelanggan, pengiriman.id as harga_id');
		$this->db->join('produk', 'produk.id = pengiriman.produk_id');
		$this->db->where('pengiriman.pelanggan_id', $pelanggan_id);
		$this->db->where('produk.id', $produk_id);
		return $this->db->get('pengiriman')->row();
	}

	public function getPengirimanPelangganByPelangganID($pelanggan_id){
		$this->db->select('pengiriman.*');
		return $this->db->get('pengiriman')->result();
	}

	public function get_nama_produk($id) {
		return $this->db->select('nama')->from('produk')->where('id', $id)->get()->row();
	}

	public function get_pelanggan_id() {
		$query = $this->db->query("SELECT id FROM pelanggan ORDER BY id DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      return $data['id'];
    } else {
      return '0';
    }
	}

	public function get_produk_id() {
		$query = $this->db->query("SELECT id FROM produk ORDER BY id DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      return $data['id'];
    } else {
      return '0';
    }
	}

	public function get_kode_produk() {
		$query = $this->db->query("SELECT kode FROM produk ORDER BY kode DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      return $data['kode'];
    } else {
      return 'PROD-111132341';
    }
	}

	public function get_pengiriman_id() {
		$query = $this->db->query("SELECT id FROM pengiriman ORDER BY id DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      return $data['id'];
    } else {
      return '0';
    }
	}

	public function get_no_pengiriman() {
		$query = $this->db->query("SELECT no_pengiriman FROM pengiriman ORDER BY no_pengiriman DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      return $data['no_pengiriman'];
    } else {
      return 'SHIPMNT000000';
    }
	}

	public function get_transaksi_id() {
		$query = $this->db->query("SELECT id FROM transaksi ORDER BY id DESC LIMIT 1");
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
            $data = $row;
      }
      return $data['id'];
    } else {
      return '0';
    }
	}

	public function get_no_bukti() {
		$query = $this->db->query("SELECT no_bukti FROM transaksi ORDER BY id DESC LIMIT 1");
		$tahun = date('Y');
		$bulan = date('m');
		$tanggal = date('d');
		$data = null;
		$no_invoice = $tahun.'/'.$bulan.'/'.$tanggal;;
    if ($query->num_rows() != 0) {
      foreach ($query->result_array() as $row) {
				if ($no_invoice == substr($row['no_bukti'], 0, 10)) {
        	$data['no_bukti'] = $row['no_bukti'];
        } else {
        	$data['no_bukti'] = $no_invoice.'00';
        }
      }
      return $data['no_bukti'];
    }
	}

}

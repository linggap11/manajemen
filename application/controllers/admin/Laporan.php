<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_laporan');
		$this->css = array(
		    'assets/plugins/datatables/dataTables.bootstrap.css'
		    );
		$this->js = array(
		    'assets/plugins/datatables/jquery.dataTables.min.js',
		    'assets/plugins/datatables/dataTables.bootstrap.min.js'
		    );

		$this->load->model('model_pengaturan');
	}

	public function laporan_pengiriman($bulan = 'all', $tahun = 'all', $status = 'all'){

		$data['title'] = 'Daftar Pengiriman Bulan : '.$bulan.' Tahun  : '.$tahun.' Status : "'.$status.'"';

		$data['data_bulan'] = $bulan ;
		$data['data_tahun'] = $tahun ;
		$data['data_status'] = $status ;

		$data['js'] = $this->js ;

		$data['result'] = $this->model_laporan->show_laporan($bulan, $tahun, $status);
		$data['data_sales'] = $this->model_laporan->tampil_sales();
		$data['bulan'] = $this->model_laporan->getNamaBulanPengiriman();
		$data['tahun'] = $this->model_laporan->getTahunPengiriman();
		$this->load->view('admin/layout/header', array('title' => 'Laporan Pengiriman', 'menu' => 'laporan_pengiriman', 'css' => $this->css));

		$this->load->view('admin/laporan/laporan_pengiriman', $data);
	}

	public function laporan_pemesanan($bulan = 'all', $tahun = 'all',  $status = 'all'){
		$data['title'] = 'Daftar Pengiriman Bulan : '.$bulan.' Tahun  : '.$tahun.' Status : "'.$status.'"';

		$data['data_bulan'] = $bulan ;
		$data['data_tahun'] = $tahun ;
		$data['data_status'] = $status ;

		$data['js'] = $this->js ;

		$data['result'] = $this->model_laporan->show_laporan($bulan, $tahun, $status);
		$data['bulan'] = $this->model_laporan->getNamaBulanPengiriman();
		$data['tahun'] = $this->model_laporan->getTahunPengiriman();

		$this->load->view('admin/layout/header', array('title' => 'Laporan Pemesanan', 'menu' => 'laporan_pemesanan', 'css' => $this->css));

		$this->load->view('admin/laporan/laporan_pemesanan', $data);
	}

	public function laporan_tagihan() {
		$data['js'] = $this->js ;
		$status = $this->input->post('status');
		$tgl_awal = $this->input->post('awal');
		$tgl_akhir = $this->input->post('akhir');
		$data['data_tagihan'] = $this->model_laporan->data_tagihan($status, $tgl_awal, $tgl_akhir);
		$data['status'] = $status;
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$this->load->view('admin/layout/header', array('title' => 'Laporan Penagihan', 'menu' => 'laporan_tagihan', 'css' => $this->css));
		$this->load->view('admin/laporan/laporan_tagihan', $data);
	}

	public function pengiriman_print($bulan = 'all', $tahun = 'all',  $status = 'all') {

		$data['title'] = 'Laporan Pengiriman <br> Bulan : '.$bulan.' Tahun  : '.$tahun.' Status : "'.$status.'"';
		$data['data_status'] = $status ;
		$data['data_bulan'] = $bulan ;
		$data['data_tahun'] = $tahun ;

		$data['data_tahun'] = "";
		$data['profile'] = $this->model_pengaturan->get_profile();
		$data['result'] = $this->model_laporan->show_laporan($bulan, $tahun, $status);
		$data['bulan'] = $this->model_laporan->getNamaBulanPengiriman();

		$this->load->view('admin/laporan/pengiriman_print', $data);

	}

	public function pemesanan_print($bulan = 'all', $tahun = 'all',  $status = 'all') {

		$data['title'] = 'Laporan Pengiriman <br> Bulan : '.$bulan.' Tahun  : '.$tahun.' Status : "'.$status.'"';
		$data['data_status'] = $status ;
		$data['data_tahun'] = $tahun ;
		$data['data_bulan'] = $status ;

		$data['profile'] = $this->model_pengaturan->get_profile();
		$data['result'] = $this->model_laporan->show_laporan($bulan, $tahun, $status);
		$data['bulan'] = $this->model_laporan->getNamaBulanPengiriman();

		$this->load->view('admin/laporan/pemesanan_print', $data);

	}

	public function print_laporan_tagihan() {
		$data['profile'] = $this->model_pengaturan->get_profile();
		$data['result'] = $this->model_laporan->data_tagihan();


		$this->load->view('admin/laporan/penagihan_print', $data);
	}

	public function get_detail_sales($id) {
		$data = $this->model_laporan->get_detail_sales($id);
		echo json_encode($data);
	}

	public function print_sj_by_sales($id) {
		 $data['profile'] = $this->model_pengaturan->get_profile();
     $data['print'] = $this->model_laporan->get_sj_by_sales($id);
     $this->load->view('admin/laporan/pengiriman_print_by_sales', $data);
	}




	public function test() {
		$status = 'all';
		$bulan = 'all';
		$tahun = 'all';

		$data['data_bulan'] = $bulan ;
		$data['data_tahun'] = $tahun ;
		$data['profile'] = $this->model_pengaturan->get_profile();
		$data['result'] = $this->model_laporan->show_laporan($bulan, $tahun, $status);
		$data['bulan'] = $this->model_laporan->getNamaBulanPengiriman();
		$data['data_sales'] = $this->model_laporan->get_detail_sales(1);
		print_r($data);
	}



}

/* End of file Laporan.php */
/* Location: ./application/controllers/admin/Laporan.php */

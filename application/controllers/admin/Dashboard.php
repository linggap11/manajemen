<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			redirect(site_url('admin/login'));
		}
		$this->load->model('model_keuangan');
		$this->load->model('model_laporan');
	}

	public function index() {
		$this->load->view('admin/layout/header', array('menu' => 'dashboard', 'title' => 'Dashboard Admin'));
		$data['kas'] = $this->total_saldo_kas();
		$data['piutang'] = $this->total_saldo_piutang();
		$data['hutang'] = $this->total_saldo_hutang();
		$data['total_penagihan'] = $this->model_laporan->data_tagihan();
		$this->load->view('admin/dashboard', $data); 
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
		return $row->total;
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
		return $row->saldo ;
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

		if (!empty($data)) {
			return $row->saldo ;
		} else {
			return '0';
		}
	}

}

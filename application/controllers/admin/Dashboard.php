<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->admin_login) {
			redirect(site_url('admin/login'));
		}   
	}

	public function index() {   
		$this->load->view('admin/layout/header', array('menu' => 'dashboard', 'title' => 'Dashboard Admin'));
		$this->load->view('admin/dashboard');
	}



}
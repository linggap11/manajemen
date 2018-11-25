<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengaturan extends CI_Model {

	public function get_profile() {
		return $this->db->get('cv')->row();
	}	

}

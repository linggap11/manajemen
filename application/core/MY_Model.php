<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function unpackData( &$queryObj, $idx_field = null) {
        $data = array();
		if($queryObj->num_rows()) {
			foreach($queryObj->result_array() as $row) {
                if(!is_null($idx_field)) {
                    $data[$row[$idx_field]] = $row;
                } else {
                    $data[] = $row;
                }
			}
		}
		$queryObj->free_result();
		return $data;
    }
}
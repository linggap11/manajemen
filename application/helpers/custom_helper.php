<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function encrypt_password($plain_text) {
	$options = array(
		'cost' => 12,
		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	);
	return password_hash($plain_text, PASSWORD_BCRYPT, $options);
}

function purify($text){
	$text = str_replace("<p>", "",  $text);
	$text = str_replace("</p>", "", $text);
	$text = str_replace("\n", " ", $text);
	return $text;
}


function alert_sukses($teks) {
	$teks = purify($teks);
	return '$.notify("'. $teks .'", {className: "success", autoHide: true});';
}

function alert_warning($teks) {
	$teks = purify($teks);
	return '$.notify("'. $teks .'", {className: "warn"});';
}

function alert_error($teks) {
	$teks = purify($teks);
	return '$.notify("'. $teks .'", {className: "error"});';
}

function alert_info($teks) {
	$teks = purify($teks);
	return '$.notify("'. $teks .'", {className: "info"});';
}

function format_rupiah($angka) {
	return 'Rp. ' . number_format($angka, 0, ',', '.');
}
function format_rp($angka) {
	return number_format($angka, 0, ',', '.');
}
function format_angka($angka) {
	if($angka > 0){
		return (int)preg_replace("/([^0-9\\,])/i", "", $angka);
	}else{
		return 0;
	}
}
function format_jam($jam) {
	return ($jam < 10) ? '0' . $jam . ':00' :  $jam . ':00' ;
}

function formatSizeUnits($bytes) {
	// Snippet from PHP Share: http://www.phpshare.org
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
    	$bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function tanggal_lokal($tanggal, $cetak_hari = false) {
	$tanggal = date('d-m-Y', strtotime($tanggal));
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);

	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = $split[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[2];

	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}

function format_tanggal($tanggal){
	return date('d-m-Y', strtotime($tanggal));
}
function get_hak_akses($hak){
	switch ($hak) {
		case 'admin':
			return 'Administrator';
			break;
		case 'staff':
			return 'Staff Karyawan';
			break;

		default:
			return '';
			break;
	}
}

function get_status_penjualan($status){
	switch ($status) {
		case '1':
			return '<span class="label label-default">Ngutang</span>';
			break;
		case '3':
			return '<span class="label label-success">Lunas</span>';
			break;
		case '9':
			return '<span class="label label-danger">Dibatalkan</span>';
			break;

		default:
			return $status;
			break;
	}
}

function format_tanggal_waktu($tanggal){
	return date('d-m-Y H:i', strtotime($tanggal));
}

function get_kode_penjualan($kode){
	$kode_olah = sprintf("%05d", $kode);
	return 'FAK' . $kode_olah;
}

function get_kode_consignment($kode){
	$kode_olah = sprintf("%05d", $kode);
	return 'CN' . $kode_olah;
}

function get_kode_faktur($kode){
	$kode_olah = sprintf("%04d", $kode);
	return 'FAK' . $kode_olah;
}

function get_url_cache(){
	return '?id=' . md5(date('Y-m-d H:i:s'));
}

function getBulanIndo($bulan){
	switch ($bulan) {
		case 'January':
			return 'Januari';
			break;
		case 'February':
			return 'Feruari';
			break;
		case 'March':
			return 'Maret';
			break;
		case 'April':
			return 'April';
			break;
		case 'May':
			return 'Mei';
			break;
		case 'June':
			return 'Juni';
			break;
		case 'July':
			return 'Juli';
			break;
		case 'August':
			return 'Augustus';
			break;
		case 'September':
			return 'September';
			break;
		case 'October':
			return 'Oktober';
			break;
		case 'November':
			return 'November';
			break;
		case 'December':
			return 'Desember';
			break;
		case 'all':
			return 'Tahun ';
			break;

		default:
			return '';
			break;
	}
}

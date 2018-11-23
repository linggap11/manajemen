<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] = '';
$config['smtp_port'] = 465;

$config['smtp_user'] = '';
$config['smtp_pass'] = '';

$config['smtp_crypto'] = 'ssl';

$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";
//$config['crlf'] = "\r\n";


$config['email_from'] = '';
$config['email_name'] = '';
<?php
$admin_id = $this->session->admin_id;
$menu = (isset($menu)) ? $menu : '' ; 

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets/images/icon.png"/>
  <title><?php echo (isset($title)) ? $title : 'Untitled' ;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/ionicons-2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pace2.min.css">
  <link rel="stylesheet" href="<?php echo(base_url('assets/css/font.css')) ?>">
   <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
<?php if(isset($css)) {foreach($css as $c) { ?>
  <link rel="stylesheet" href="<?php echo base_url($c);?>">
<?php }} ?>
<?php if(isset($js)) {foreach($js as $j) { ?>
  <script src="<?php echo base_url($j);?>" type="text/javascript"></script>
<?php }} ?>

 


  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins/skin-custom.css">

  <script>
    var BASE_URL = '<?php echo site_url();?>';
  </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-custom sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <span class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PT</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg text-left"><i class="fa fa-clone"></i> CV.INDOMINERALS</span>
    </span>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         

          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="<?php echo base_url('admin/login/destroy') ?>" class="sign-out"> 
              <span><i class="fa fa-sign-out"></i></span> 
              <span class="hidden-xs">Sign Out</span>
            </a> 
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <?php $this->load->view('admin/layout/sidebar', array('menu' => $menu));?>


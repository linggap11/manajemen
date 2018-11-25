 <style media="screen">
   th {
    text-align: center;
   }
   .hr-flex {
    border-top: 1px dashed #d8d8d8;
    color: #ffffff;
    background-color: #ffffff;
    height: 1px;
    margin: 10px 0;
    display: block;
    flex: 1;
  }

  .panel-menu {
    padding: 10px 15px;
    background-color: #f5f5f5;
    border-radius: 10px;
  }

  .text-info {
    color: #069d9f;
  }
 </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
     <ol class="breadcrumb left">
       <li class="active">Kelola Pengiriman</li>
     </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-red">
        <div class="box-header with-border">
          <h3 class="box-title">
            Kelola Pengiriman
          </h3>
          <?php if ($response = $this->session->flashdata('tambah_transaksi')) { ?>
            <div class="row">
              <div class="col-lg-12" align="center">
              <div class="alert alert-success" role="alert">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <span class="sr-only">success:</span>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $response; ?>
              </div>
              </div>
            </div>
        <?php } elseif ($response = $this->session->flashdata('batal_pesanan')) { ?>
            <div class="row">
              <div class="col-lg-12" align="center">
              <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <span class="sr-only">success:</span>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $response; ?>
              </div>
              </div>
            </div>
         <?php } ?>
          <div class="box-tools">          
          </div>
           
        </div><!-- /.box-header -->
    
        <section class="content" id="tambah">
          <!-- Default box -->
          <div class="box box-red" id="hidden_section">
            <div class="panel with-nav-tabs panel-default">
                 <div class="panel-heading">
                  <ul class="nav nav-pills">
                    <li class="active" id="menu-1"><a class="btn btn-default link" id="pengiriman">1. CATAT PENGIRIMAN <i class="glyphicon glyphicon-chevron-right"></i></a></li>
                    <li class="" id="menu-2"><a class="btn btn-default link" id="list_pesanan">2. LIST PESANAN <i class="glyphicon glyphicon-chevron-right"></i></a></li>
                    <li class="" id="menu-3"><a class="btn btn-default link" id="list_pesanan_approve">3. PESANAN DISETUJUI <i class="glyphicon glyphicon-ok"></i></a></li>
                
                  </ul>
               </div>
                <div class="panel-body">
               <div class="tab-content" id="content">
                 
              </div>
          </div>
        </div>
      </div>
        </section>
      </div>
    </section>
<a href="<?php  echo base_url('admin/kelola_pelanggan') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list pelanggan</a>
  </div>

  
<?php $footer_js = isset($js) ? $js : array() ; ?>
<?php $this->load->view('admin/layout/footer'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">  
 $(document).ready(function(){

  var menu = '<?php echo $link; ?>';
  $(".link").click(function() {
    $(this).parent().addClass('active').siblings().removeClass('active');
  });
  console.log(menu);
  switch (menu) {
      case "pengiriman":
          $('#content').load('<?= base_url('admin/Kelola_pengiriman/catat_transaksi') ?>');
        break;
      case "list_pesanan":
          $('#content').load('<?= base_url('admin/Kelola_pengiriman/list_pesanan') ?>');
          $('#menu-2').addClass('active')
          $('#menu-1').removeClass('active');
          $('#menu-3').removeClass('active');
        break;
      case "list_pesanan_approve":
          $('#content').load('<?= base_url('admin/Kelola_pengiriman/list_pesanan_approve') ?>');
          $('#menu-3').addClass('active')
          $('#menu-1').removeClass('active');
          $('#menu-2').removeClass('active');
        break;
    }
  
  $('.link').click(function() {
    menu = $(this).attr('id');
    switch (menu) {
      case "pengiriman":
          $('#content').load('<?= base_url('admin/Kelola_pengiriman/catat_transaksi') ?>');
        break;
      case "list_pesanan":
          $('#content').load('<?= base_url('admin/Kelola_pengiriman/list_pesanan') ?>');
          $('#first').removeClass('active');
        break;
      case "list_pesanan_approve":
          $('#content').load('<?= base_url('admin/Kelola_pengiriman/list_pesanan_approve') ?>');
          $('#first').removeClass('active');
        break;
      default:
          $('#content').load('<?= base_url('admin/Kelola_pengiriman') ?>');
        break;
    }

  });
 });

 </script>
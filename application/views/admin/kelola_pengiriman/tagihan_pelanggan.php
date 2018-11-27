<style type="text/css" media="screen">
  th {
    text-align: center
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
     <ol class="breadcrumb left">
       <li><a href="<?php  echo base_url('admin/Kelola_pengiriman/penagihan') ?>"><i class="fa fa-users"></i> Daftar Tagihan</a></li> 
       <li class="active">Tagihan Pelanggan</li>
     </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-red">
        <div class="box-header with-border">
          <h3 class="box-title">
            Tagihan Pelanggan : <?= $data_pelanggan->nama ?>
          </h3>

          <div class="box-tools">          
          </div>
           
        </div><!-- /.box-header -->
        <div class="box-body">
          <a href="<?= base_url('admin/Kelola_pengiriman/print_invoice/'.$data_pelanggan->id.' ')?>" target="_blank" class="btn btn-primary"><span class="fa fa-print"></span> Print Invoice</a>
          <form id="list_invoice">
            
            
          
          <table id="tabel_pengiriman_by_pelanggan" class="table table-bordered table-striped">
          <thead>
          <tr>
             <th>No</th>
             <th >No Invoice</th>
             <th >Tgl Transaksi</th>
             <th >Produk</th> 
             <th >Biaya Tambahan</th> 
             <th >Total</th>
             <th>Status</th>  
             <th width="10%">Action</th>  
          </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php foreach ($data_tagihan as $row): ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row->no_bukti ?></td>
                <td><?php echo $row->tgl_transaksi ?></td>
                <td><?php echo $row->nama_produk ?></td>
                <td><?php echo format_rupiah($row->biaya_tambahan) ?></td>
                <td><?php echo format_rupiah($row->harga) ?></td>
                <td align="center"><span class="btn btn-danger btn-xs"><?php echo $row->tagihan ?></span></td>
                <td align="center">
                  <button 
                     data-no_surat="<?= $row->no_pengiriman ?>" 
                     data-no_bukti="<?= $row->no_bukti ?>" 
                     data-nama_pelanggan="<?= $row->nama ?>" 
                     data-alamat="<?= $row->alamat ?>" 
                     data-tgl="<?= $row->tgl_transaksi ?>" 
                     data-nama_produk="<?= $row->nama_produk ?>" 
                     data-deskrips_produk="<?= $row->produk_deskripsi ?>" 
                     data-berat="<?= $row->berat ?>" 
                     data-biaya_tambahan="<?= $row->biaya_tambahan ?>" 
                     data-total="<?= $row->harga ?>" 
                  type="button" class="btn btn-info btn-xs btn-detail"> <span class="fa fa-info-circle"></span> Detail</button>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
      </table>
      </form>
       </div>
       
      </div>

        
      <a href="<?php  echo base_url('admin/kelola_pelanggan') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list pelanggan</a>
 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_detail">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <span aria-hidden="true">×</span></button>
          <h1 class="modal-title"><center><strong>DETAIL TAGIHAN #<span id="no_invoice"></span></strong></center></h1>
        </div>
        <div class="modal-body">
          <div class="data-user-cont border-right"> 
            <div class="col-md-8 col-md-12">
              <p><strong>Kepada : </strong></p>
              <p id="nama_pelanggan"></p>
              <p><strong>Alamat : </strong></p>
              <p id="alamat"></p>
              <p><strong>Tgl Transaksi : </strong></p>
              <p id="tgl_transaksi"></p>
            </div>
          </div>
          
          <div class="data-user-cont border-right"> 
            <div class="col-md-12">
            <hr class="hr-flex">
            <table class="table table-bordered" id="tableModal">
                <thead>
                    <tr>
                        <th width="5%" class="text-uppercase small font-weight-bold">No.</th>
                        <th width="30%" class="text-uppercase small font-weight-bold">Barang/Jasa</th>
                        <th width="50%" class="text-uppercase small font-weight-bold">Deskripsi</th>
                        <th width="5%" class="text-uppercase small font-weight-bold">Qty</th>
                        <th width="10%" class="text-uppercase small font-weight-bold">Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                
                    </tr> 
                </tbody>
            </table>
            </div>
            <span class="font-weight-bold">Catatan :</span><br><br>
            <p> Semua Barang yang diterima dalam urutan dan kondisi baik</p>
          </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<?php $footer_js = isset($js) ? $js : array() ; ?>
<?php $this->load->view('admin/layout/footer'); ?>

<script>
  $(document).ready(function() {
    $('#tabel_pengiriman_by_pelanggan').DataTable({

    });


    $('.btn-detail').click(function(){
      
      
      var no_pengiriman = $(this).data('no_pengiriman');
      var no_invoice = $(this).data('no_bukti');
      var nama_pelanggan = $(this).data('nama_pelanggan');
      var alamat = $(this).data('alamat');
      var tgl = $(this).data('tgl');
      var nama_produk = $(this).data('nama_produk');
      var deskripsi_produk = $(this).data('deskrips_produk');
      var berat = $(this).data('berat');
      var biaya_tambahan = $(this).data('biaya_tambahan');     
      var total = $(this).data('total');

      $('#no_invoice').html(no_invoice);
      $('#nama_pelanggan').html(nama_pelanggan);
      $('#alamat').html(alamat);
      $('#no_pesanan').html(no_invoice);
      $('#no_nota').html(no_pengiriman);
      $('#tgl_transaksi').html(tgl);

      $('#tableModal').find('tbody').append("<tr><td align='center'>1</td><td align='center'>"+nama_produk+"</td><td>"+deskripsi_produk+"</td><td>"+berat+"</td><td align='center'>KG</td></tr>" );
      $('#modal_detail').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
      $('#close').click(function(event) {
        location.reload();
      });
    });
  })
</script>
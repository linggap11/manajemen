<div class="" id="list_pesanan">
    <h6>Daftar Pesanan Dengan Status "PENDING"</h6>
      <div class="table-responsive">
          <table id="table-list_pesanan" class="table table-bordered">
              <thead>
              <tr>
                  <th>No Bukti </th>
                  <th>Tanggal</th>
                  <th>Sales </th>
                  <th>Pelanggan</th>
                  <th>Alamat</th>  
                  <th>Total</th>  
                  <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($list_pesanan as $pesananan): ?>
                  <tr>
                      <td align="center"><?php echo $pesananan->no_bukti; ?></td>
                      <td align="center"><?php echo $pesananan->tgl_transaksi; ?></td>
                      <td><?php echo $pesananan->sales.' <b>['.$pesananan->plat_nomor.']</b>' ?></td>
                      <td><?php echo $pesananan->nama; ?></td>
                      <td><?php echo $pesananan->alamat; ?></td>
                      <td><?php echo format_rupiah($pesananan->total); ?></td>
                      <td align="center"><button
                         data-no_surat="<?= $pesananan->no_pengiriman ?>" 
                         data-no_bukti="<?= $pesananan->no_bukti ?>" 
                         data-nama_pelanggan="<?= $pesananan->nama ?>" 
                         data-alamat="<?= $pesananan->alamat ?>" 
                         data-tgl="<?= $pesananan->tgl_transaksi ?>" 
                         data-kode_produk="<?= $pesananan->kode ?>" 
                         data-nama_produk="<?= $pesananan->nama_produk ?>" 
                         data-deskrips_produk="<?= $pesananan->deskripsi ?>" 
                         data-berat="<?= $pesananan->berat ?>" 
                         data-sales="<?= $pesananan->sales ?>" 
                         data-plat_nomor="<?= $pesananan->plat_nomor ?>" 
                         data-total="<?= $pesananan->total ?>" 
                      class="btn btn-xs btn-primary btn-detail"><i class="fa fa-check"> Setujui</i> </button>&nbsp;<a href="<?= base_url('admin/Kelola_pengiriman/print_surat_jalan/'.$pesananan->no_pengiriman.'')?>" target="_blank" class="btn btn-warning btn-xs" title=""><i class="fa fa-print"> Print Nota</i></a><br><a href="<?= base_url('admin/Kelola_pengiriman/batal_pesanan/'.$pesananan->no_pengiriman.'')?>" class="btn btn-danger btn-xs" title=""><i class="fa fa-trash"> Batalkan Pesanan</i></a>
                    </td>
                  </tr>
              <?php endforeach ?>
              </tbody>
          </table>
        </div><!-- end table responsive -->
   </div>
   </div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_detail">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h1 class="modal-title"><center><strong>NOTA PENGIRIMAN</strong></center></h1>
        </div>
        <div class="modal-body">
          <div class="data-user-cont border-right"> 
            <div class="col-md-8 col-md-12">
              <p><strong>Kepada : </strong></p>
              <p id="nama_pelanggan"></p>
              <br><br>
              <p><strong>Alamat : </strong></p>
              <p id="alamat"></p>
            </div>
            <div class="col-md-4 col-md-12">
              <div class="row data-user">
                <div class="col-md-5"><strong>No Pesanan</strong></div>
                <div class="col-md-7"><strong><span id="no_pesanan"></span></strong></div>
              </div>
               <div class="row data-user">
                <div class="col-md-5"><strong>Penjualan:</strong></div>
                <div class="col-md-7"> : <span id="penjualan"></span></div>
              </div>
               <div class="row data-user">
                <div class="col-md-5"><strong>No Nota</strong></div>
                <div class="col-md-7"><strong><span id="no_nota"></span></strong></div>
               </div>
               <div class="row data-user">
                <div class="col-md-5"><strong>Pengiriman</strong></div>
                <div class="col-md-7"> :</div>
                <div class="col-md-8"> <span id="pengiriman"></span></div>
              </div>
              <br>
              <div class="row data-user">
                <div class="col-md-5"><strong>Tgl Pengiriman</strong></div>
                <div class="col-md-7"><strong>: <span id="tgl_pengiriman"></span></strong></div>
               </div>
               <div class="row data-user">
                <div class="col-md-5">Sales</div>
                <div class="col-md-7">: <span id="sales"></span></div>
               </div>
               <div class="row data-user">
                <div class="col-md-5">No Kendaraan</div>
                <div class="col-md-7">: <span id="plat_nomor"></span></div>
               </div>
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
          <a target="_blank" class="btn btn-warning print"><span class="fa fa-print"> Cetak</span></button> 
          <a  class="btn btn-primary  approve"><span class="fa fa-check"> Setujui</span></a> 
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<script type="text/javascript">  
  $(document).ready(function() {
    $('#table-list_pesanan').dataTable({
    "columns": [
        { "width": "10%" },
        null,
        null,
        null,
        { "width": "25%" },
        { "width": "10%" },
        { "width": "17%" }
      ]
  });

  $('.btn-detail').click(function(){
      var no_pengiriman = $(this).data('no_surat');
      var no_bukti = $(this).data('no_bukti');
      var nama_pelanggan = $(this).data('nama_pelanggan');
      var alamat = $(this).data('alamat');
      var tgl = $(this).data('tgl');
      var kode_produk = $(this).data('kode_produk');
      var nama_produk = $(this).data('nama_produk');
      var deskripsi_produk = $(this).data('deskrips_produk');
      var berat = $(this).data('berat');
      var sales = $(this).data('sales');
      var plat_nomor = $(this).data('plat_nomor');      
      var total = $(this).data('total');

      $('#nama_pelanggan').html(nama_pelanggan);
      $('#alamat').html(alamat);
      $('#no_pesanan').html(no_pengiriman);
      $('#no_nota').html(no_bukti);
      $('#tgl_pengiriman').html(tgl);
      $('#sales').html(sales);
      $('#plat_nomor').html(plat_nomor);

      $('#tableModal').find('tbody').append("<tr><td align='center'>1</td><td align='center'>"+nama_produk+"</td><td>"+deskripsi_produk+"</td><td>"+berat+"</td><td align='center'>KG</td></tr>" );
      $('.print').attr({
        'href': '<?= base_url('admin/Kelola_pengiriman/print_surat_jalan/')?>'+no_pengiriman,
        'target': '_blank'
      });
      $('.approve').attr({
        'href': '<?= base_url('admin/Kelola_pengiriman/approve_pesanan/')?>'+no_pengiriman
      });
      $('.close').click(function(event) {
        $('#modal_detail').modal('hide');
        $('.modal-backdrop').remove();
        $('#content').load('<?= base_url('admin/Kelola_pengiriman/list_pesanan') ?>');   
      });
      $('#modal_detail').modal({
         backdrop: 'static',
         keyboard: false,
         show: true
      });
    });
  });
</script>
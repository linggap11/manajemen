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
       <li><a href="<?php  echo base_url('admin/Kelola_pengiriman/penagihan') ?>"><i class="fa fa-users"></i> Kelola Laporan</a></li>
       <li class="active">Laporan Penagihan</li>
     </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-red">
        <div class="box-header with-border">
          <h3 class="box-title">
            Laporan Tagihan
          </h3>
          <div class="box-tools row" style="width: 600px;">
            <form class="" action="<?php echo base_url('admin/Laporan/laporan_tagihan') ?>" method="post">
              <div class="col-md-3">
                <select name="status" id="status" class="form-control input-sm" style="border-radius: 3px;">
                    <?php if ($status == 'BELUM LUNAS'): ?>
                        <option value="BELUM LUNAS" selected>BELUM LUNAS</option>
                        <option value="PENDING">INVOICE</option>
                      <?php elseif ($status == 'PENDING'): ?>
                        <option value="BELUM LUNAS">BELUM LUNAS</option>
                        <option value="PENDING" selected>INVOICE</option>
                      <?php else: ?>
                        <option value="BELUM LUNAS" selected>BELUM LUNAS</option>
                        <option value="PENDING" >INVOICE</option>
                    <?php endif; ?>

                </select>
              </div>
              <div class="col-md-3">
                <input type="text" name="awal"  class="datepicker form-control input-sm" value="<?php echo $tgl_awal ?>" size="2" id="awal" placeholder="Tanggal Awal">
              </div>
              <div class="col-md-3">
                <input type="text" name="akhir"  class="datepicker form-control input-sm" value="<?php echo $tgl_akhir ?>" size="2" id="akhir" placeholder="Tanggal Akhir">
              </div>
                <button type="submit" class="btn btn-success" id="sorting"><strong>Apply</strong></button>
              <div>
              </div>
            </form>
          </div>
          <div class="box-tools">
          </div>

        </div><!-- /.box-header -->
        <div class="box-body">

          <br><br>
          <table id="tabel_pengiriman_by_pelanggan" class="table table-bordered table-striped">
          <thead>
          <tr>
             <th>No</th>
             <th>Pelanggan</th>
             <th width="10%">No. Mobil</th>
             <th width="10%">Tgl Transaksi</th>
             <th >Produk</th>
             <th width="10%">Harga</th>
             <th width="10%">Total</th>
             <th >Muatan (Kg)</th>
             <th width="5%">Status</th>
             <th width="12%">Action</th>
          </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php foreach ($data_tagihan as $row): ?>
              <tr>
                <td align="center"><?php echo $no++ ?></td>
                <th align="center">
                  <?php echo $row->nama ?>
                </th>
                <td align="center"><strong><?php echo $row->plat_nomor ?></strong></td>
                <td align="center"><?php echo $row->tgl_transaksi ?></td>
                <td><?php echo $row->nama_produk ?></td>
                <td><?php echo format_rupiah($row->harga) ?></td>
                <td><?php echo format_rupiah($row->total) ?></td>
                <td align="center"><?php echo $row->berat ?></td>
                <td align="center">
                  <?php if ($row->tagihan == 'BELUM LUNAS'): ?>
                    <span class="btn btn-danger btn-xs"><?php echo $row->tagihan ?></span>
                  <?php else: ?>
                    <span class=""><a class="btn btn-warning btn-xs" href="<?= base_url('admin/Kelola_keuangan/piutang/') ?>" target="_blank" title="Faktur <?= $row->no_pengiriman ?>">INVOICE</a></span>
                  <?php endif ?>

                </td>
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
                  <?php if ($row->tagihan == 'BELUM LUNAS'): ?>
                    <a href="<?php echo base_url('admin/Kelola_pengiriman/tagihan_pelanggan/'.$row->id.'') ?>" class="btn btn-secondary btn-xs"><span class="fa fa-edit"></span> Link</button>
                  <?php else: ?>

                    <!-- <button type="button" class="btn btn-secondary btn-xs btn-edit" disabled><span class="fa fa-edit"></span> Link</button> -->
                  <?php endif ?>

                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
      </table>
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
            <p>Semua Barang yang diterima dalam urutan dan kondisi baik</p>
          </div>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_detail" >Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title"><center><strong>TAGIHAN #<span id="no_invoice_edit"></span></strong></center></h1>
        </div>
        <div class="modal-body">
          <div class="row">
            <form action="<?= base_url('admin/Kelola_pengiriman/edit_tagihan') ?>" method="post">
              <div class="col-md-12">
                <div class="col-md-6">
                  <h5><strong>Surat Jalan : <span id="sj"></span></strong></h5>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Produk</label>
                    <input type="text" class="form-control" id="produk_edit" readonly="" name="produk_edit">
                    <input type="hidden" name="sj_edit" id="sj_edit">
                    <input type="hidden" name="pelanggan_id" id="pelanggan_id">
                    <input type="hidden" name="asal" value="laporan">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi_edit" id="deskripsi_edit" class="form-control" readonly=""></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Berat (Kg)</label>
                    <input type="number" class="form-control" id="berat_edit" required="" name="berat_edit">
                    <span><i id="berat_awal"></i></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Harga Jual (Rp)</label>
                    <input type="number" class="form-control" id="harga_edit" required="" name="harga_edit">
                    <span><i id="harga_awal"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

              </div>

            </form>
          </div>

        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_detail" >Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="riwayat_tagihan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Daftar Pengiriman Berhasil</h4>
      </div>
      <div class="modal-body">
        <table id="table-list_pesanan" class="table table-bordered">
          <thead>
          <tr>
              <th>No Bukti </th>
              <th>Tgl Diterima</th>
              <th>Sales </th>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
              <th>Total Harga</th>
          </tr>
          </thead>
          <tbody>
            <?php print_r($riwayat_tagihan) ?>
            <?php if (count($riwayat_tagihan) > 0): ?>
              <?php foreach ($riwayat_tagihan as $tagihan): ?>

              <?php endforeach ?>
            <?php endif ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php $footer_js = isset($js) ? $js : array() ; ?>
<?php $this->load->view('admin/layout/footer'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>">
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script>
  $(document).ready(function() {
    $('#tabel_pengiriman_by_pelanggan').DataTable({
      "iDisplayLength": 25,
      "ordering": false
    });
  })


  function toggle(source) {
    checkboxes = document.getElementsByName('no_invoice_cek[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }

  function cek_surat_jalan() {
    checkboxes = document.getElementsByName('no_invoice_cek[]');
    var checked = 0;
    for(var i=0, n=checkboxes.length;i<n;i++) {
      if (checkboxes[i].checked) {
        checked++;
      }
    }
    if (checked == 0){
      alert('Tidak Ada Surat Jalan Yang Dicetak');
      return false;
    } else {
      setTimeout(function () { window.location.reload(); }, 10);
    }
  }

  $('.btn-detail').click(function(){
      var no_pengiriman = $(this).data('no_surat');
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
  });

  $('.btn-edit').click(function(){
      var no_surat = $(this).data('no_surat');
      var no_invoice = $(this).data('no_bukti');
      var pelanggan_id = $(this).data('pelanggan_id');
      var nama_produk = $(this).data('nama_produk');
      var deskripsi_produk = $(this).data('deskrips_produk');
      var berat = $(this).data('berat');
      var harga = $(this).data('harga');

      $('#sj').html(no_surat);
      $('#sj_edit').val(no_surat);
      $('#pelanggan_id').val(pelanggan_id);
      $('#no_invoice_edit').html(no_invoice);
      $('#produk_edit').val(nama_produk);
      $('#deskripsi_edit').val(deskripsi_produk);
      $('#berat_edit').val(berat);
      $('#berat_awal').html('Berat Asal '+berat+' KG');

      $('#harga_edit').val(harga);
      $('#harga_awal').html('Harga Asal '+convertToRupiah(harga));

      $('#modal_edit').show();

      $('#modal_edit').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });





  $('#close_detail').click(function() {
      $('#tableModal').find('tbody').empty();
  });

  $('#close_edit').click(function() {
      $('#tableModal').find('tbody').empty();
  });

   function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
    }

    function convertToAngka(rupiah) {
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    }

    $('.datepicker').datepicker({
          autoclose: true,
          format: "yyyy-mm-dd",
          todayHighlight: true,
          orientation: "top auto",
          todayBtn: true,
          todayHighlight: true,
    });

</script>

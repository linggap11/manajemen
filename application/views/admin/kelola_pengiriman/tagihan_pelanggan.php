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
          <button type="button" id="btpengiriman_berhasil" data-toggle="modal" data-target="#riwayat_tagihan" class="btn btn-default pull-right"><i class="fa fa-history"></i> Riwayat Tagihan</button>
          <div class="box-tools">
          </div>

        </div><!-- /.box-header -->
        <div class="box-body">
          <form target="_blank" onsubmit="return cek_surat_jalan()" action="<?= base_url('admin/Kelola_pengiriman/print_invoice') ?>" method="post"  accept-charset="utf-8">
          <input type="hidden" name="id" value="<?= $data_tagihan[0]->pelanggan_id ?>">
          <button type="submit" class="btn btn-primary" id="print_invoice"><span class="fa fa-print"></span> Buat Invoice</button >
          <br><br>
          <p><input type="checkbox" checked id="check_all" onclick="toggle(this)">Check All </p>
          <p><input type="checkbox" name="ppn" value="ppn">PPN 10%</p>
          <p class="pull-right"><i>**Jika status surat jalan = 'INVOICE' maka penagihan telah dibuat.</i></p>

          <table id="tabel_pengiriman_by_pelanggan" class="table table-bordered table-striped">
          <thead>
          <tr>
             <th>No</th>
             <th></th>
             <th >No. Mobil</th>
             <th >Tgl Transaksi</th>
             <th >Produk</th>
             <th >Harga</th>
             <th >Total</th>
             <th >Muatan (Kg)</th>
             <th>Status</th>
             <th width="15%">Action</th>
          </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php foreach ($data_tagihan as $row): ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <th align="center" id="test">
                  <?php if ($row->tagihan == 'BELUM LUNAS'): ?>
                    <input type="checkbox" checked class="cek" name="no_invoice_cek[]" id="cek_no_invoice" value="<?php echo $row->no_bukti ?>">
                  <?php else: ?>
                    <input type="checkbox" disabled class="cek">
                  <?php endif ?>
                </th>
                <td align="center"><strong><?php echo $row->plat_nomor ?></strong></td>
                <td align="center"><?php echo $row->tgl_transaksi ?></td>
                <td><?php echo $row->nama_produk ?></td>
                <td><?php echo format_rupiah($row->harga) ?></td>
                <td><?php echo format_rupiah($row->total) ?></td>
                <td><?php echo $row->berat ?></td>
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
                    <button
                     data-tanggal="<?= $row->tgl_transaksi ?>"
                     data-no_surat="<?= $row->no_pengiriman ?>"
                     data-no_bukti="<?= $row->no_bukti ?>"
                     data-pelanggan_id="<?= $row->pelanggan_id ?>"
                     data-nama_produk="<?= $row->nama_produk ?>"
                     data-deskrips_produk="<?= $row->produk_deskripsi ?>"
                     data-berat="<?= $row->berat ?>"
                     data-harga="<?= $row->harga ?>"
                  type="button" class="btn btn-secondary btn-xs btn-edit"><span class="fa fa-edit"></span> Edit</button>
                  <?php else: ?>
                    <button type="button" class="btn btn-secondary btn-xs btn-edit" disabled><span class="fa fa-edit"></span> Edit</button>
                  <?php endif ?>

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
                <div class="col-md-6">
                  <label class="control-label"><strong>Tanggal Transaksi</strong></label>
                  <div class="datepicker input-group date">
                    <input style="text-align : center" type="text" readonly required class="form-control" name="tanggal_edit" id="tanggal_edit">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>

                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Produk</label>
                    <select class="form-control" name="produk_baru" id="produk_baru">

                    </select>
                    <input type="hidden" name="sj_edit" id="sj_edit">
                    <input type="hidden" name="pelanggan_id" id="pelanggan_id">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi_edit" id="deskripsi_edit" class="form-control" ></textarea>
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
<
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
      var tanggal = $(this).data('tanggal');
      var no_invoice = $(this).data('no_bukti');
      var pelanggan_id = $(this).data('pelanggan_id');
      var nama_produk = $(this).data('nama_produk');
      var deskripsi_produk = $(this).data('deskrips_produk');
      var berat = $(this).data('berat');
      var harga = $(this).data('harga');

      $('#sj').html(no_surat);
      $('#sj_edit').val(no_surat);
      $('#tanggal_edit').val(tanggal);
      $('#pelanggan_id').val(pelanggan_id);
      $('#no_invoice_edit').html(no_invoice);
      $('#produk_edit').val(nama_produk);
      $('#deskripsi_edit').val(deskripsi_produk);
      $('#berat_edit').val(berat);
      $('#berat_awal').html('Berat Asal '+berat+' KG');

      $('#harga_edit').val(harga);
      $('#harga_awal').html('Harga Asal '+convertToRupiah(harga));


      $.get("<?php echo site_url('admin/Kelola_pengiriman/get_data_produk/'); ?>"+pelanggan_id, function(respon) {
        var data = JSON.parse(respon);
        if (data != null) {
          $('#produk_baru').empty();

          $.each(data, function(idx, obj){
            if (nama_produk == obj.nama_produk) {
              $('#produk_baru').append($('<option>').text(obj.nama_produk).attr('value', obj.produk_id).attr('selected', 'selected'));
            } else {
              $('#produk_baru').append($('<option>').text(obj.nama_produk).attr('value', obj.produk_id));
            }
          });


        } else {
          $('#produk_baru').append($('<option>').text('Tidak Ada Produk Untuk Pelanggan ini').attr('value', ''));
        }
      });

      $('#produk_baru').change(function() {
        var produk_id = $('#produk_baru').val();
        $.get('<?php echo base_url('admin/Kelola_pengiriman/get_deskripsi_produk/') ?>'+produk_id, function(respon) {
          var data = JSON.parse(respon);
          console.log(data);
          $('#deskripsi_edit').val(data.deskripsi);
          $('#harga_edit').val(data.harga);
        });
      });
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

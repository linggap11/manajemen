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
                    <li class="" id="menu-1"><a class="btn btn-default link" id="pengiriman">CATAT PENGIRIMAN <i class="glyphicon glyphicon-chevron-right"></i></a></li>
                    <li class="" id="menu-2" style="display: none"><a class="btn btn-default link" id="list_pesanan">2. LIST PESANAN <i class="glyphicon glyphicon-chevron-right"></i></a></li>
                    <li class="active" id="menu-3"><a class="btn btn-default link" id="list_pesanan_approve">PESANAN DISETUJUI <i class="glyphicon glyphicon-ok"></i></a></li>

                  </ul>
               </div>
                <div class="panel-body">
               <div class="tab-content" id="content">
               	<div class="col-lg-12 panel-menu">
				    <button type="button" id="btpengiriman_berhasil" data-toggle="modal" data-target="#riwayat_pengiriman_berhasil" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
				</div>

                 <form action="<?= base_url('admin/Kelola_pengiriman/update_pengiriman') ?>" method="post" accept-charset="utf-8">
		        <input type="hidden" id="id" name="id" value="">
		      <div class="clearfix">&nbsp;</div>
		      <div class="col-sm-12 headings"><span class="badge progress-bar-warning">E D I T &nbsp&nbsp P E N G I R I M A N </span><hr class="hr-flex"></div>
		        <div class="col-md-12" id="div-transaksi">
		          <div class="form-group">
		            <div class="col-sm-4">
		              <label class="control-label" ><strong>No Bukti</strong></label>
		              <input style="text-align : center" type="text" class="form-control" readonly="" id="no_bukti" name="no_bukti" value="<?php echo $data_pengiriman->no_bukti ?>">
		            </div>
		            <div class="col-sm-4">
		              <label class="control-label" ><strong>No Pengiriman</strong></label>
		              <input style="text-align : center" type="text" class="form-control" readonly="" id="no_pengiriman" name="no_pengiriman" value="<?php echo $data_pengiriman->no_pengiriman ?>">
		            </div>
		            <div class="col-sm-4">
		            <label class="control-label"><strong>Tanggal Transaksi</strong></label>
		            <div class="datepicker_edit input-group date">
		              <input style="text-align : center" type="text" class="form-control" id="tanggal" name="tanggal_transaksi" value="<?php echo $data_pengiriman->tgl_transaksi ?>">
		              <span class="input-group-addon">
		                  <span class="glyphicon glyphicon-calendar"></span>
		              </span>
		            </div>
		          </div>
		        </div>
		        <br> <br>
		      </div>
		      <!-- Data Pelanggan -->
		    <div class="col-sm-12 headings" id="transaksi"> <br><br><span class="badge progress-bar-warning">D A T A &nbsp; P E L A N G G A N & P R O D U K</span><hr class="hr-flex"></div>
		      <div class="row">
		        <div class="col-md-6">
		        <div class="panel panel-default">
		          <div class="panel-body">
		            <div class="form-group">
		                <label class="col-md-3 control-label" for=""><b>Pelanggan</b></label>
		                <div class="col-md-8">
		                    <div class="input-group" id="cari_pelanggan1">
		                      <span class="input-group-addon"><i class="fa fa-search"></i></span>
		                      <select id="search_pelanggan1" required="" onchange="cari_pelanggan(1)" class="form-control" style="">
		                        <option value="<?php echo $data_pengiriman->id ?>"><?php echo $data_pengiriman->nama ?></option>
		                        <?php foreach ($data_pelanggan as $row): ?>
		                          <?php if ($row->id == $data_pengiriman->id): ?>
		                          		<?php continue; ?>
		                          	<?php else: ?>
		                          		<option value="<?= $row->id ?>"><?= $row->nama ?></option>
		                          <?php endif ?>
		                        <?php endforeach ?>

		                      </select>
		                    </div>
		                </div>
		              </div>
		              <div class="form-group">
		                <label class="col-md-6 control-label" for=""><b>Nama Pelanggan</b></label>
		                <div class="col-md-6">
		                  <input type="text" placeholder="" id="nama_pelanggan1" readonly class="form-control" name="nama_pelanggan" value="<?php echo $data_pengiriman->nama ?>">
		                  <input type="hidden" name="pelanggan_id" id="pelanggan_id1" value="<?php echo $data_pengiriman->id ?>">
		                </div>
		              </div>
		              <div class="form-group">
		                <label class="col-sm-6 control-label" for="">No Telp</label>
		                <div class="col-sm-6">
		                  <input type="text" placeholder="" readonly id="telp_pelanggan1" class="form-control" name="telp_pelanggan" value="<?php echo $data_pengiriman->no_telp ?>">
		                </div>
		              </div>
		              <div class="form-group">
		                <label class="col-sm-6 control-label" for="">Alamat</label>
		                <div class="col-sm-12">
		                  <textarea placeholder="" id="alamat1" name="alamat" class="form-control" readonly rows="5"><?php echo $data_pengiriman->alamat ?></textarea>
		                  <span id="charNum"></span>
		                </div>
		              </div>
		              <div class="form-group">
		                  <label class="col-sm-8 control-label" for="kodepos">Kode Pos</label>
		                  <div class="col-sm-6">
		                    <input type="text" id="kode_pos1" readonly class="form-control" name="kode_pos" value="<?php echo $data_pengiriman->kode_pos ?>">
		                  </div>
		               </div>
		            </div>
		          </div>

		        </div>
		        <div class="col-md-5">
		          <div class="panel panel-default">
		          <div class="panel-body">
		              <div class="form-group" id="pelanggan_lama1">
		                  <label class="col-sm-4 control-label" for="">Nama Produk</label>
		                  <div class="col-sm-7">
		                    <select class="form-control" id="list_produk1" required="" onchange="get_deskripsi(1)" name="list_nama_produk" >
		                      <option value="<?php echo $data_pengiriman->produk_id ?>"><?php echo $data_pengiriman->nama_produk ?></option>
		                    </select>
		                  </div>
                      <input type="hidden" name="nama_produk" id="nama_produk1" value="<?php echo $data_pengiriman->nama_produk; ?>">
		              </div>
		              <div class="form-group">
		                <label class="col-sm-4 control-label" for="">Deskripsi</label>
		                <div class="col-sm-7">
		                  <textarea placeholder="" id="deskripsi_produk1" name="deskripsi_produk" class="form-control" rows="2"><?php echo $data_pengiriman->deskripsi ?></textarea>
		                </div>
		              </div>
		               <div class="form-group">
		                  <label class="col-sm-4 control-label" for="">Harga (Rp)</label>
		                  <div class="col-sm-7">
		                    <input type="text" id="harga1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" required onkeyup="hitungTotal(1)" name="harga" value="<?php echo $data_pengiriman->harga ?>">
		                  </div>
		               </div>
		               <div class="form-group">
		                  <label class="col-sm-4 control-label" for="">Berat (Kg)</label>
		                  <div class="col-sm-7">
		                    <input type="number" id="berat1" class="form-control" required onkeyup="hitungTotal(1)" onchange="hitungTotal(1)" name="berat" value="<?php echo $data_pengiriman->berat ?>">
		                  </div>
		               </div>
		               <div class="form-group">
		                  <label class="col-sm-4 control-label" for="">Total </label>
		                  <div class="col-sm-7">
		                    <input type="text" id="totalShow1" class="form-control" readonly value="<?php echo format_rupiah($data_pengiriman->harga * $data_pengiriman->berat ) ?>">
		                    <input type="hidden" id="total1" class="form-control" readonly name="total" value="<?php echo ($data_pengiriman->harga * $data_pengiriman->berat ) ?>">
		                  </div>
		               </div>
		             </div>
		          </div>
		          <div class="panel panel-default">
		            <div class="panel-body">
		              <div class="form-group">
		                  <label class="col-sm-4 control-label" for="">Sales</label>
		                  <div class="col-sm-7">
		                    <div class="input-group">
		                      <select name="sales" id="sales1"  class="sales form-control" onchange="get_no_kendaraan(1)">
		                        <option value="<?php echo $data_pengiriman->sales_id ?>"><?php echo $data_pengiriman->sales ?></option>
                            <?php foreach ($sales as $pengirim): ?>
                              <option value="<?php echo $pengirim->id ?>"><?php echo $pengirim->nama ?></option>
                            <?php endforeach; ?>
		                      </select>
		                    </div>
		                  </div>
		              </div>

		               <div class="form-group">
		                  <label class="col-sm-4 control-label" for="">No Kendaraan</label>
		                  <div class="col-sm-7">
                        <input type="hidden" name="nama_sales" id="nama_sales1" value="<?php echo $data_pengiriman->sales ?>">
		                    <input type="text" id="no_kendaraan1" class="form-control" name="no_kendaraan" value="<?php echo $data_pengiriman->plat_nomor ?>">
		                  </div>
		               </div>
		               <div class="form-group">
		                  <label class="col-sm-4 control-label" for="">Kas Jalan (Rp)</label>
		                  <div class="col-sm-7">
		                    <input type="text" id="biaya_tambahan1" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required onkeyup="hitungTotal(1)" name="biaya_tambahan" value="<?php echo $data_pengiriman->biaya_tambahan ?>">
		                  </div>
		               </div>
		               <div class="form-group">
		                  <label class="col-sm-4 control-label" for="">Potongan (Rp)</label>
		                  <div class="col-sm-7">
		                    <input type="text" id="potongan1" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required value="<?php echo ($data_pengiriman->biaya_tambahan - $data_pengiriman->potongan) ?>" onkeyup="hitungTotal(1)" name="potongan">
		                  </div>
		               </div>
		            </div>
		          </div>
		        </div>
		        <div class="col-md-1">

		        </div>
		        </div>
		          <div id="transaksi_lain">
		            <div id="add1">

		            </div>
		          </div>
		          <div class="col-sm-12">
		            <button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-save"></i> Simpan</button>
		          </div>
		        </form>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>">
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
 $(document).ready(function(){


  var menu = '<?php echo $link; ?>';
  $(".link").click(function() {
    $(this).parent().addClass('active').siblings().removeClass('active');
  });
  switch (menu) {
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

  	$('.datepicker_edit').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd",
      todayHighlight: true,
      orientation: "top auto",
      todayBtn: true,
      todayHighlight: true,
 	 });
 });


 function cari_pelanggan(i) {
    var id = $('#search_pelanggan'+i).val()
    $.get("<?php echo site_url('admin/Kelola_pelanggan/get_data_pelanggan_by_id/'); ?>"+id, function(respon) {
      var data = JSON.parse(respon);
      $('#id_pelanggan'+i).val(data.id);
      $('#nama_pelanggan'+i).val(data.nama);
      $('#telp_pelanggan'+i).val(data.no_telp);
      $('#alamat'+i).val(data.alamat);
      $('#kode_pos'+i).val(data.kode_pos);
      $('#pelanggan_id'+i).val(data.id);
      //produk
      $('#nama_pelanggan'+i).prop('readonly',true);
      $('#telp_pelanggan'+i).prop('readonly',true);
      $('#alamat'+i).prop('readonly',true);
      $('#kode_pos'+i).prop('readonly',true);
      $('#deskripsi_produk'+i).val('');
      $('#harga'+i).val('');
      $('#berat'+i).val('');
      $('#totalShow'+i).val('');
      $('#total'+i).val('');
    });

    $.get("<?php echo site_url('admin/Kelola_pengiriman/get_data_produk/'); ?>"+id, function(respon) {
      var data = JSON.parse(respon);
      if (data != null) {
        $('#list_produk'+i).empty();
        $('#list_produk'+i).append($('<option>').text('Pilih Produk').attr('value', ''));
        $.each(data, function(idx, obj){
          $('#list_produk'+i).append($('<option>').text(obj.nama_produk).attr('value', obj.produk_id));
        });
      } else {
        $('#list_produk'+i).append($('<option>').text('Tidak Ada Produk Untuk Pelanggan ini').attr('value', ''));
      }
    });
  }

  function get_deskripsi(i) {
    var produk_id = $('#list_produk'+i).val();
    $.get('<?php echo base_url('admin/Kelola_pengiriman/get_deskripsi_produk/') ?>'+produk_id, function(respon) {
      var data = JSON.parse(respon);
      $('#nama_produk'+i).val(data.nama);
      $('#deskripsi_produk'+i).val(data.deskripsi);
      $('#harga'+i).val(data.harga);
      var sub_total = parseInt(data.harga) * parseInt($('#berat'+i).val());
      $('#totalShow'+i).val(formatRupiah(String(sub_total), 'Rp. ' ));
      $('#total'+i).val(sub_total); //hidden
      $('#biaya_tambahan'+i).val(data.kas_jalan);
      $('#deskripsi_produk'+i).prop('readonly', true);
    });
  }
  function get_no_kendaraan(i) {
   var id_sales = $('#sales'+i).val();

   $.get("<?php echo site_url('admin/Kelola_produk/get_data_sales_byid/'); ?>"+id_sales, function(respon) {
      var data = JSON.parse(respon);
      $('#nama_sales'+i).val(data.nama);
      $('#no_kendaraan'+i).val(data.plat_nomor);
   });
 }

  function hitungTotal(i) {
    var harga = parseInt($('#harga'+i).val());
    var berat = parseInt($('#berat'+i).val());
    var biaya_tambahan = parseInt($('#biaya_tambahan'+i).val());

    var sub_total = harga * berat;
    $('#totalShow'+i).val(formatRupiah(String(sub_total), 'Rp. '));
    $('#total'+i).val(sub_total); //hidden
   }

   function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

 </script>

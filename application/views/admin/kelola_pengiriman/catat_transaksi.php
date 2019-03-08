<div class="" id="default">
    <div class="row">
      <form action="<?= base_url('admin/Kelola_pengiriman/simpan_pengiriman') ?>" method="post" onsubmit="return checkSales()" accept-charset="utf-8">
        <input type="hidden" id="id" name="id" value="">
      <div class="clearfix">&nbsp;</div>
      <div class="col-sm-12 headings"><span class="badge progress-bar-warning">T R A N S A K S I </span><hr class="hr-flex"></div>
        <div class="col-md-12" id="div-transaksi">
          <div class="form-group">
            <div class="col-sm-4">
              <label class="control-label" ><strong>No Bukti</strong></label>
              <input style="text-align : center" type="text" class="form-control" readonly="" id="no_bukti" name="no_bukti[]" placeholder="Auto generate">
            </div>
            <div class="col-sm-4">
              <label class="control-label" ><strong>No Pengiriman</strong></label>
              <input style="text-align : center" type="text" class="form-control" readonly="" id="no_pengiriman" name="no_pengiriman[]" placeholder="Auto generate">
            </div>
            <div class="col-sm-4">
            <label class="control-label"><strong>Tanggal Transaksi</strong></label>
            <div class="datepicker input-group date">
              <input style="text-align : center" type="text" class="form-control" id="tanggal" name="tanggal_transaksi" value="<?php echo(date("Y-m-d")); ?>">
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
                        <option value="">Pilih Pelanggan</option>
                        <?php foreach ($data_pelanggan as $row): ?>
                          <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                        <?php endforeach ?>

                      </select>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="id_pelanggan[]" id="id_pelanggan1">
                <label class="col-md-6 control-label" for=""><b>Nama Pelanggan</b></label>
                <div class="col-md-6">
                  <input type="text" placeholder="" id="nama_pelanggan1" readonly class="form-control" name="nama_pelanggan[]">
                  <input type="hidden" name="pelanggan_id[]" id="pelanggan_id1">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label" for="">No Telp</label>
                <div class="col-sm-6">
                  <input type="text" placeholder="" readonly id="telp_pelanggan1" class="form-control" name="telp_pelanggan[]">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label" for="nohape">Alamat</label>
                <div class="col-sm-12">
                  <textarea placeholder="" id="alamat1" name="alamat[]" class="form-control" readonly rows="5"></textarea>
                  <span id="charNum"></span>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-8 control-label" for="kodepos">Kode Pos</label>
                  <div class="col-sm-6">
                    <input type="text" id="kode_pos1" readonly class="form-control" name="kode_pos[]">
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
                    <select class="form-control" id="list_produk1" required="" onchange="get_deskripsi(1)" name="list_nama_produk[]" >
                      <option value="">Pilih Produk</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="">Deskripsi</label>
                <div class="col-sm-7">
                  <textarea placeholder="" id="deskripsi_produk1" name="deskripsi_produk[]" class="form-control" rows="2"></textarea>
                </div>
              </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Harga (Rp)</label>
                  <div class="col-sm-7">
                    <input type="text" id="harga1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" value="0" required onkeyup="hitungTotal(1)" name="harga[]">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Berat (Kg)</label>
                  <div class="col-sm-7">
                    <input type="number" id="berat1" class="form-control" value="1" required onkeyup="hitungTotal(1)" onchange="hitungTotal(1)" name="berat[]">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Total </label>
                  <div class="col-sm-7">
                    <input type="text" id="totalShow1" class="form-control" readonly>
                    <input type="hidden" id="total1" class="form-control" readonly name="total[]">
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
                      <select name="sales[]" id="sales1" required="" class="sales form-control" onchange="get_no_kendaraan(1)">
                        <option value="">Pilih Sales</option>
                        <?php if (count($sales) > 0): ?>
                          <?php foreach ($sales as $list_sales): ?>
                            <option value="<?= $list_sales->id ?>"><?= $list_sales->nama ?></option>
                          <?php endforeach ?>
                          <?php else: ?>
                            <option value="">Sales Sibuk</option>
                        <?php endif ?>
                      </select>
                    </div>
                  </div>
              </div>

               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">No Kendaraan</label>
                  <div class="col-sm-7">
                    <input type="text" id="no_kendaraan1" class="form-control" name="no_kendaraan[]">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Kas Jalan (Rp)</label>
                  <div class="col-sm-7">
                    <input type="text" id="biaya_tambahan1" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required value="0" onkeyup="hitungTotal(1)" name="biaya_tambahan[]">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Potongan (Rp)</label>
                  <div class="col-sm-7">
                    <input type="text" id="potongan1" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required value="0" onkeyup="hitungTotal(1)" name="potongan[]">
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
      <hr class="hr-flex">
        <div class="form-group col-md-12"><button type="button" class="btn btn-warning" onclick="addPengiriman();" id="add_rowProduk"><i class="glyphicon glyphicon-plus"></i>Tambah Pengiriman Lain</button></div>
    </div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>">
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script>
  function checkSales() {
    var val = [];
    $('.sales').each(function(i, el){
        val.push($(el).val());
    });
    for (var i = 0; i < val.length; i++) {
      if (val[i] == val[i+1] || val[i] == val[i+2]) {
        var status = true;
      }
    }
    if (status == true) {
      alert('Maaf Sales Sudah Digunakan!, Silahkan Cek Kembali');
      return false;
    } else {
      return true;
    }
 }

 function get_no_kendaraan(i) {
   var id_sales = $('#sales'+i).val();

   $.get("<?php echo site_url('admin/Kelola_produk/get_data_sales_byid/'); ?>"+id_sales, function(respon) {
      var data = JSON.parse(respon);
      $('#no_kendaraan'+i).val(data.plat_nomor);
   });
 }

  function showTable(){
    $('#hidden_section').show();
  }

 var count_id = 1;
  function T_removeElement(i) {
    $('#add'+i).remove();
    count_id--;
  }

  function hitungTotal(i) {
    var harga = parseInt($('#harga'+i).val());
    var berat = parseInt($('#berat'+i).val());
    var biaya_tambahan = parseInt($('#biaya_tambahan'+i).val());

    var sub_total = harga * berat;
    $('#totalShow'+i).val(formatRupiah(String(sub_total), 'Rp. '));
    $('#total'+i).val(sub_total); //hidden
 }

  function addPengiriman() {
    count_id++;

    $('#transaksi_lain').append('<div id="add'+count_id+'"><hr class="hr-flex"><div class="row"> <div class="col-md-6"> <div class="panel panel-default"> <div class="panel-body"> <div class="form-group"> <label class="col-md-3 control-label" for=""><b>Pelanggan</b></label> <div class="col-md-8"> <div class="input-group" id="cari_pelanggan'+count_id+'"> <span class="input-group-addon"><i class="fa fa-search"></i></span> <select required id="search_pelanggan'+count_id+'" onchange="cari_pelanggan('+count_id+')" class="form-control" style=""> <option value="">Pilih Pelanggan</option> <?php foreach ($data_pelanggan as $row): ?> <option value="<?=$row->id ?>"><?=$row->nama ?></option> <?php endforeach ?> </select> </div></div></div><div class="form-group"> <input type="hidden" name="id_pelanggan[]" id="id_pelanggan'+count_id+'"> <label class="col-md-6 control-label" for=""><b>Nama Pelanggan</b></label> <div class="col-md-6"> <input type="text" placeholder="" id="nama_pelanggan'+count_id+'" class="form-control" name="nama_pelanggan[]"> <input type="hidden" name="pelanggan_id[]" id="pelanggan_id'+count_id+'"> </div></div><div class="form-group"> <label class="col-sm-6 control-label" for="">No Telp</label> <div class="col-sm-6"> <input type="text" placeholder="" id="telp_pelanggan'+count_id+'" class="form-control" name="telp_pelanggan[]"> </div></div><div class="form-group"> <label class="col-sm-6 control-label" for="nohape">Alamat</label> <div class="col-sm-12"> <textarea placeholder="Wajib Isi. Max 500 karakter" id="alamat'+count_id+'" name="alamat[]" class="form-control" rows="5"></textarea> <span id="charNum"></span> </div></div><div class="form-group"> <label class="col-sm-8 control-label" for="kodepos">Kode Pos</label> <div class="col-sm-6"> <input type="text" id="kode_pos'+count_id+'" class="form-control" name="kode_pos[]"> </div></div></div></div></div><div class="col-md-5"> <div class="panel panel-default"> <div class="panel-body"> <div class="form-group" id="pelanggan_lama'+count_id+'" > <label class="col-sm-4 control-label" for="">Nama Produk</label> <div class="col-sm-7"> <select required class="form-control" id="list_produk'+count_id+'" onchange="get_deskripsi('+count_id+')" name="list_nama_produk[]" > <option value="">Pilih Produk</option> </select> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Deskripsi</label> <div class="col-sm-7"> <textarea placeholder="" id="deskripsi_produk'+count_id+'" name="deskripsi_produk[]" class="form-control" rows="2"></textarea> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Harga (Rp)</label> <div class="col-sm-7"> <input type="number"  id="harga'+count_id+'" class="form-control" value="0" required onkeyup="hitungTotal('+count_id+')" name="harga[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Berat (Kg)</label> <div class="col-sm-7"> <input type="number" id="berat'+count_id+'" class="form-control" value="1" required onkeyup="hitungTotal('+count_id+')" onchange="hitungTotal('+count_id+')" name="berat[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Total (Rp)</label> <div class="col-sm-7"><input type="text" id="totalShow'+count_id+'" class="form-control" readonly> <input type="hidden" id="total'+count_id+'" class="form-control" readonly name="total[]"> </div></div></div></div><div class="panel panel-default"> <div class="panel-body"> <div class="form-group"> <label class="col-sm-4 control-label" for="">Sales</label> <div class="col-sm-7"> <div class="input-group"> <select name="sales[]" required id="sales'+count_id+'" class="sales form-control" onchange="get_no_kendaraan('+count_id+')"> <option value="">Pilih Sales</option> <?php if (count($sales) > 0): ?> <?php foreach ($sales as $list_sales): ?> <option value="<?=$list_sales->id ?>"><?=$list_sales->nama ?></option> <?php endforeach ?> <?php else: ?> <option value="">Sales Sibuk</option> <?php endif ?> </select> </div></div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">No Kendaraan</label> <div class="col-sm-7"> <input type="text" id="no_kendaraan'+count_id+'" class="form-control" name="no_kendaraan[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Kas Jalan (Rp)</label> <div class="col-sm-7"> <input type="number" id="biaya_tambahan'+count_id+'" class="form-control" required value="0" onkeyup="hitungTotal('+count_id+')" name="biaya_tambahan[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Potongan (Rp)</label> <div class="col-sm-7"> <input type="number" id="potongan'+count_id+'" class="form-control" required value="0" onkeyup="hitungTotal('+count_id+')" name="potongan[]"> </div></div></div></div></div><div class="col-md-1"> <div class="col-md-1"> <a href="javascript:void(0);" onclick="T_removeElement('+count_id+');" class="btn btn-danger pull-right btn-xs" id="del_row'+count_id+'"><i class="glyphicon glyphicon-remove"></i></a> </div></div></div></div>');
  }

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
      $('#deskripsi_produk'+i).val(data.deskripsi);
      $('#harga'+i).val(data.harga);
      var sub_total = parseInt(data.harga) * parseInt($('#berat'+i).val());
      $('#totalShow'+i).val(formatRupiah(String(sub_total), 'Rp. ' ));
      $('#total'+i).val(sub_total); //hidden
      $('#biaya_tambahan'+i).val(data.kas_jalan);
    });
  }


  $('#table-list_pesanan').dataTable({
    "columns": [
        { "width": "20%" },
        null,
        null,
        null,
        null,
        null,
        null,
        null
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
      var deskripsi_produk = $(this).data('deskripsi');
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

      $('#modal_detail').modal('show');
      $('.approve').click(function(){

      });
    });

  function showPelanggan(i) {
    if ($('#pilih_pelanggan'+i).val() == 'lama') {
      $('#search_pelanggan'+i).prop('disabled', false);
      $("#pelanggan_lama"+i).css("display", "block");
      $("#pelanggan_baru"+i).css("display", "none");
    } else {
      $("#pelanggan_lama"+i).css("display", "none");
      $("#pelanggan_baru"+i).css("display", "block");

      $('#nama_pelanggan'+i).prop('readonly',false);
      $('#telp_pelanggan'+i).prop('readonly',false);
      $('#alamat'+i).prop('readonly',false);
      $('#kode_pos'+i).prop('readonly',false);
      $('#nama_produk'+i).prop('readonly',false);
      $('#deskripsi_produk'+i).prop('readonly',false);
      $('#search_pelanggan'+i).prop('disabled', true);
    }
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
    $('.datepicker').datepicker({
          autoclose: true,
          format: "yyyy-mm-dd",
          todayHighlight: true,
          orientation: "top auto",
          todayBtn: true,
          todayHighlight: true,
      });
</script>

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
              <input style="text-align : center" type="text" class="form-control" id="tanggal" name="tanggal_transaksi" readonly value="<?php echo(date("Y-m-d")); ?>">
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
                <label class="col-md-3 control-label" for="nohape"><b>Pelanggan</b></label>
                <div class="col-md-3">
                  <select id="pilih_pelanggan1" name="pilih_pelanggan[]" class="form-control" onchange="showPelanggan(1)">
                    <option value="baru">Baru</option>
                    <option value="lama">Lama</option>
                  </select><br>
                </div>
                <div class="col-md-5">
                    <div class="input-group" id="cari_pelanggan1">
                      <span class="input-group-addon"><i class="fa fa-search"></i></span>
                      <input type="text" placeholder="Cari Pelanggan" oninput="cari_pelanggan(1)" disabled id="search_pelanggan1" class="form-control" autocomplete="off">
                    </div>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="id_pelanggan1" id="id_pelanggan1">
                <label class="col-md-6 control-label" for=""><b>Nama Pelanggan</b></label>
                <div class="col-md-6">
                  <input type="text" placeholder="" id="nama_pelanggan1" class="form-control" name="nama_pelanggan[]">
                  <input type="hidden" name="pelanggan_id[]" id="pelanggan_id1">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label" for="">No Telp</label>
                <div class="col-sm-6">
                  <input type="text" placeholder="" id="telp_pelanggan1" class="form-control" name="telp_pelanggan[]">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label" for="nohape">Alamat</label>
                <div class="col-sm-12">
                  <textarea placeholder="Wajib Isi. Max 500 karakter" id="alamat1" name="alamat[]" class="form-control" rows="5"></textarea>
                  <span id="charNum"></span>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-8 control-label" for="kodepos">Kode Pos</label>
                  <div class="col-sm-6">
                    <input type="text" id="kode_pos1" class="form-control" name="kode_pos[]">
                  </div>
               </div>
            </div>
          </div>
          
        </div>
        <div class="col-md-5">
          <div class="panel panel-default">
          <div class="panel-body">
              <div class="form-group">
                  <label class="col-sm-4 control-label" for="nohape">Nama Produk</label>
                  <div class="col-sm-7">
                    <input type="text" placeholder="Wajib Isi" id="nama_produk1" class="form-control" name="nama_produk[]">
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
                    <input type="text" id="harga1" class="form-control" value="0" required onkeyup="hitungTotal(1)" name="harga[]">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Berat (Kg)</label>
                  <div class="col-sm-7">
                    <input type="text" id="berat1" class="form-control" value="1" required onkeyup="hitungTotal(1)" name="berat[]">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Tambahan (Rp)</label>
                  <div class="col-sm-7">
                    <input type="text" id="biaya_tambahan1" class="form-control" required value="0" onkeyup="hitungTotal(1)" name="biaya_tambahan[]">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label" for="">Total (Rp)</label>
                  <div class="col-sm-7">
                    <input type="text" id="total1" class="form-control" readonly name="total[]">
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
                      <select name="sales[]" id="sales1" class="sales form-control" onchange="get_no_kendaraan(1)">
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
    var harga = parseInt($('#harga'+i+'').val());
    var berat = parseInt($('#berat'+i+'').val());
    var biaya_tambahan = parseInt($('#biaya_tambahan'+i+'').val());

    var sub_total = (harga * berat) + biaya_tambahan;
    $('#total'+i+'').val(parseInt(sub_total));
 }

  function addPengiriman() {
    count_id++;

    $('#transaksi_lain').append('<div id="add'+count_id+'"><hr class="hr-flex"><div class="row"> <div class="col-md-6"> <div class="panel panel-default"> <div class="panel-body"> <div class="form-group"> <label class="col-md-3 control-label" for=""><b>Pelanggan</b></label> <div class="col-md-3"> <select id="pilih_pelanggan'+count_id+'" name="pilih_pelanggan[]" class="form-control" onchange="showPelanggan('+count_id+')"> <option value="baru">Baru</option> <option value="lama">Lama</option> </select><br></div><div class="col-md-5"> <div class="input-group" id="cari_pelanggan'+count_id+'"> <span class="input-group-addon"><i class="fa fa-search"></i></span> <input type="text" placeholder="Cari Pelanggan" oninput="cari_pelanggan('+count_id+')" disabled id="search_pelanggan'+count_id+'" class="form-control" autocomplete="off"> </div></div></div><div class="form-group"> <input type="hidden" name="id_pelanggan[]" id="id_pelanggan'+count_id+'"> <label class="col-md-6 control-label" for=""><b>Nama Pelanggan</b></label> <div class="col-md-6"> <input type="text" placeholder="" id="nama_pelanggan'+count_id+'" class="form-control" name="nama_pelanggan[]"> <input type="hidden" name="pelanggan_id[]" id="pelanggan_id'+count_id+'"> </div></div><div class="form-group"> <label class="col-sm-6 control-label" for="">No Telp</label> <div class="col-sm-6"> <input type="text" placeholder="" id="telp_pelanggan'+count_id+'" class="form-control" name="telp_pelanggan[]"> </div></div><div class="form-group"> <label class="col-sm-6 control-label" for="nohape">Alamat</label> <div class="col-sm-12"> <textarea placeholder="Wajib Isi. Max 500 karakter" id="alamat'+count_id+'" name="alamat[]" class="form-control" rows="5"></textarea> <span id="charNum"></span> </div></div><div class="form-group"> <label class="col-sm-8 control-label" for="kodepos">Kode Pos</label> <div class="col-sm-6"> <input type="text" id="kode_pos'+count_id+'" class="form-control" name="kode_pos[]"> </div></div></div></div></div><div class="col-md-5"> <div class="panel panel-default"> <div class="panel-body"> <div class="form-group"> <label class="col-sm-4 control-label" for="nohape">Nama Produk</label> <div class="col-sm-7"> <input type="text" placeholder="Wajib Isi" id="nama_produk'+count_id+'" class="form-control" name="nama_produk[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Deskripsi</label> <div class="col-sm-7"> <textarea placeholder="" id="deskripsi_produk'+count_id+'" name="deskripsi_produk[]" class="form-control" rows="2"></textarea> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Harga (Rp)</label> <div class="col-sm-7"> <input type="text" id="harga'+count_id+'" class="form-control" value="0" required onkeyup="hitungTotal('+count_id+')" name="harga[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Berat (Kg)</label> <div class="col-sm-7"> <input type="text" id="berat'+count_id+'" class="form-control" value="1" required onkeyup="hitungTotal('+count_id+')" name="berat[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Tambahan (Rp)</label> <div class="col-sm-7"> <input type="text" id="biaya_tambahan'+count_id+'" class="form-control" required value="0" onkeyup="hitungTotal('+count_id+')" name="biaya_tambahan[]"> </div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">Total (Rp)</label> <div class="col-sm-7"> <input type="text" id="total'+count_id+'" class="form-control" readonly name="total[]"> </div></div></div></div><div class="panel panel-default"> <div class="panel-body"> <div class="form-group"> <label class="col-sm-4 control-label" for="">Sales</label> <div class="col-sm-7"> <div class="input-group"> <select name="sales[]" id="sales'+count_id+'" class="sales form-control" onchange="get_no_kendaraan('+count_id+')"> <option value="">Pilih Sales</option> <?php if (count($sales) > 0): ?> <?php foreach ($sales as $list_sales): ?> <option value="<?=$list_sales->id ?>"><?=$list_sales->nama ?></option> <?php endforeach ?> <?php else: ?> <option value="">Sales Sibuk</option> <?php endif ?> </select> </div></div></div><div class="form-group"> <label class="col-sm-4 control-label" for="">No Kendaraan</label> <div class="col-sm-7"> <input type="text" id="no_kendaraan'+count_id+'" class="form-control" name="no_kendaraan[]"> </div></div></div></div></div><div class="col-md-1"> <div class="col-md-1"> <a href="javascript:void(0);" onclick="T_removeElement('+count_id+');" class="btn btn-danger pull-right btn-xs" id="del_row'+count_id+'"><i class="glyphicon glyphicon-remove"></i></a> </div></div></div></div>');

    
  }

  function cari_pelanggan(i) {
    $('#search_pelanggan'+i).autocomplete({
      autoFocus: true,
      source: "<?php echo site_url('admin/Kelola_pelanggan/get_pelanggan/?');?>",
      select: function (e, ui) {
        var pelanggan = ui.item.value;
        $.get("<?php echo site_url('admin/Kelola_pelanggan/get_data_pelanggan_by_nama/'); ?>"+pelanggan, function(respon) {
          var data = JSON.parse(respon);  
          $('#nama_pelanggan'+i).val(data.nama);
          $('#telp_pelanggan'+i).val(data.no_telp);
          $('#alamat'+i).val(data.alamat);
          $('#kode_pos'+i).val(data.kode_pos);
          $('#pelanggan_id'+i).val(data.id);
          $('#nama_pelanggan'+i).prop('readonly',true);
          $('#telp_pelanggan'+i).prop('readonly',true);
          $('#alamat'+i).prop('readonly',true);
          $('#kode_pos'+i).prop('readonly',true);
        });
      },
      messages: {
        noResults: '',
        results: function() {}
      }
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
    } else {
      $('#nama_pelanggan_baru'+i).prop('readonly',false);
      $('#telp'+i).prop('readonly',false);
      $('#alamat'+i).prop('readonly',false);
      $('#kodepos'+i).prop('readonly',false);
      $('#search_pelanggan'+i).prop('disabled', true);
    }
  }
</script>
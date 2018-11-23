 <style media="screen">
   th {
    text-align: center;
   }
 </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
     <ol class="breadcrumb left">
       <li><a href="<?php  echo base_url('admin/kelola_pelanggan') ?>"><i class="fa fa-users"></i> List Pelanggan</a></li> 
       <li class="active">Pengiriman Pelanggan</li>
     </ol>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-red">
        <div class="box-header with-border">
          <h3 class="box-title">
            Kelola Produk Pelanggan
          </h3>

          <div class="box-tools">          
          <a href="#tambah" onclick="showTable()" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Pengiriman</a> 
          </div>
           
        </div><!-- /.box-header -->
        <div class="box-body">
          <select class="list-pelanggan form-control" id="list_pelanggan">
            <option value="">Pilih Pelanggan</option>  
            <?php foreach ($list_pelanggan as $list) { ?>
              <option <?php echo ($pelanggan->id == $list->id) ? 'selected' : '' ; ?> value="<?php echo $list->id; ?>"><?php echo $list->nama; ?></option>  
            <?php } ?>
          </select>
 
            <div class="data-user-cont">
            <div class="row data-user">
              <div class="col-md-2"><strong>Nama</strong></div>
              <div class="col-md-4"> : <?php echo $pelanggan->nama; ?></div>
            </div> 
            <div class="row data-user">
              <div class="col-md-2"><strong>No Telp</strong></div>
              <div class="col-md-4"> : <?php echo $pelanggan->no_telp; ?></div>
            </div> 
            <div class="row data-user">
              <div class="col-md-2"><strong>Kode Pos</strong></div>
              <div class="col-md-4"> : <?php echo $pelanggan->kode_pos; ?></div>
            </div>
            <div class="row data-user">
              <div class="col-md-2"><strong>Kelurahan</strong></div>
              <div class="col-md-4"> : <?php echo $pelanggan->kelurahan; ?></div>
          </div> 
            <div class="row data-user">
              <div class="col-md-2"><strong>Kecamatan</strong></div>
              <div class="col-md-4"> : <?php echo $pelanggan->kecamatan; ?></div>
          </div> 
       </div>
       <table id="tabel_pengiriman_by_pelanggan" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th width="10%">No pengiriman</th>
                   <th width="10%">Kode Produk</th>
                   <th width="15%">Sales</th> 
                   <th width="25%">Alamat</th> 
                   <th width="10%">Berat (Kg)</th> 
                   <th width="10%">Total Biaya</th>  
                   <th width="10%">Action</th>  
                </tr>
                </thead>
                <tbody>
                <?php 
                  if(!empty($DataPelanggan)){
                    $nomor=1;
                      foreach ($DataPelanggan as $wow) {
                        echo '
                        <tr>
                          <td>'.$wow->no_pengiriman.'</td>
                          <td>'.$wow->kode.'</td>
                          <td>'.$wow->nama.'</td>
                          <td>'.$wow->alamat.'</td>
                          <td>'.$wow->berat.'</td>
                          <td>'.$wow->harga.'</td>
                          <td>
                               <a href="'.base_url().'admin/Kelola_produk/surat_jalan/'.$wow->no_pengiriman.'/'.$wow->pelanggan_id.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Surat Jalan</a>
                               <a href="'.base_url().'admin/Kelola_produk/batal/'.$wow->no_pengiriman.'/'.$wow->pelanggan_id.'" class="btn btn-danger btn_hapus btn-xs"><i class="fa fa-trash"></i> Batal</a>
                          </td>
                        </tr>
                        ';
                      }              
                  }
               ?>  
                </tbody>
            </table>
        </div>



        <!-- /.box-body -->
        <div class="box-footer clearfix" > 
        </div>
      </div>
    </section>
      <section class="content" id="tambah">
      <!-- Default box -->
      <div class="box box-red" id="hidden_section" >
        <center><h3>Tambah Pengiriman Baru</h3></center>
        <div class="box-header with-border">
       <div class="col-lg-12">
          <form action="<?php echo base_url('admin/Kelola_produk/simpan_pengiriman') ?>" onsubmit="return checkSales()" method="post" accept-charset="utf-8">
            <div class="form-group">
            <div id="tabelProduk" class="col-sm-12 no-more-tables">
                <table id="tabelProduknya" class="table table-hover table-bordered">
                    <thead class="cf">
                      <tr>
                        <th style="width:3%" align="center">#</th>
                        <th style="width:10%">No Pengiriman</th>
                        <th style="width:10%">Sales</th>
                        <th style="width:15%">Produk</th>
                        <th style="width:20%">Alamat</th>
                        <th style="width:7%">Berat (Kg)</th>
                        <th style="width:10%">Harga (Rp)</th>
                        <th style="width:10%">Biaya Tambahan (Rp)</th>
                        <th style="width:15%">Total (Rp)</th>
                        <th style="width:5%"></th>
                      </tr>
                    </thead>
                    <tbody id="tbody_pemesanan">
                      <tr id="tr1">
                        <td align="center" data-title="#">1</td>
                        <td data-title="No Pengiriman*">
                          <input type="text" id="no_pengiriman1" name="no_pengiriman[]" class="no_pengiriman form-control" required="">
                        </td>
                        <td data-title="Sales*">
                          <div class="input-group">
                            <input type="text" class="sales form-control" placeholder="Sales" id="sales1" name="sales[]">
                          </div>
                          <input type="hidden" class="id_sales form-control" id="id_sales1" name="id_sales[]">
                        </td>
                        <td data-title="Produk*">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Produk" id="cari_produk1" name="nama_produk[]">
                          </div>
                          <input type="hidden" class="form-control"  onchange="hitungSubTotal(1)" id="kode_produk1" name="kode_produk[]">
                          <input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan">
                        </td>
                        <td data-title="">
                          <textarea id="alamat1" name="alamat[]" class="form-control" required=""></textarea>
                        </td>
                        <td data-title="">
                          <input type="text" style="text-align: center" onchange="hitungSubTotal(1)" id="berat1" name="berat[]" min="1" value="1" class="form-control" required="">
                        </td>
                        <td data-title="">
                          <input type="text" id="harga1" name="harga[]" onchange="hitungSubTotal(1)" readonly="" class="form-control" >
                        </td>
                        <td data-title="">
                          <input type="text" value="0" min="0" id="biaya_tambahan1"  onchange="hitungSubTotal(1)" name="biaya_tambahan[]" class="form-control" required="">
                        </td>
                        <td data-title="">
                          <input type="text" id="subtotal1" name="subtotal[]" class="subtotal form-control" readonly>
                        </td>
                        <td data-title="">
                          <a href="javascript:void(0);" onclick="T_removeElement_awal();" class="btn btn-danger" id="del_row1">
                          <i class="glyphicon glyphicon-minus"></i>
                          </a>
                        </td>
                    </tr>
                  </tbody>
                  <tfoot class="cf">
                    <tr>
                      <th></th>
                      <th colspan="4" rowspan="2"><center><strong>TOTAL BIAYA PENGIRIMAN</strong></center></th>
                      <th colspan="4"><input type="text" id="total_pengiriman" class="form-control" value="Rp. 0" readonly="" name="total_pengiriman"></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="form-group col-md-12"><button type="button" class="btn btn-warning" onclick="addPengiriman();" id="add_rowProduk"><i class="glyphicon glyphicon-plus"></i>Tambah Pengiriman Lain</button></div>
           </div>
           <div class="col-sm-12">
              <button type="submit" class="btn btn-primary pull-right"><i class="simpan glyphicon glyphicon-save"></i> Simpan</button>
            </div>
        </div>            
          </form>
        </div>
      </div>
    </section>
      <!-- /.box -->
        
      <a href="<?php  echo base_url('admin/kelola_pelanggan') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list pelanggan</a>
 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $footer_js = isset($js) ? $js : array() ; ?>
<?php $this->load->view('admin/layout/footer'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script type="text/javascript">
  var id_pelanggan = $('#list_pelanggan').val();
  $('#id_pelanggan').val(id_pelanggan);
  
  $(document).ready(function() {
    // get data pengiriman by pelanggan
   $('#list_pelanggan').change(function() {
    var id_pelanggan = $('#list_pelanggan').val();
    var table = $('#tabel_pengiriman_by_pelanggan').DataTable( {
       "bDestroy": true,
       "ajax": {
          "url" : "<?php echo base_url('admin/Kelola_produk/get_pengiriman_by_pelanggan') ?>/"+id_pelanggan,
          "type": "POST",
          "dataSrc":""
       }, 
       "columns": [
          { "data": "no_pengiriman"},
          { "data": "kode"},
          { "data": "nama"},
          { "data": "alamat"},
          { "data": "berat"},
          { "data": "harga"},
          { "data": "aksi"}
        ],  
    }); 

     $('#tabel_pengiriman_by_pelanggan tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert( data[0] +"'s salary is: "+ data[ 1 ] );
    } );
   });

   $('#list_pelanggan').change(function() {
      var id_pelanggan = $('#list_pelanggan').val()
      $('#id_pelanggan').val(id_pelanggan);
   });

  var list_pelanggan = $('.list-produk').select2();
  list_pelanggan.on('select2:select', function (e) {
      var value = e.params.data.element.value; 
      if(value != ''){
        window.location = BASE_URL + "admin/kelola_pelanggan/produk/" + value;
      }
  });

  var pelanggan_id = $('#list_pelanggan').val();
  var table_pelanggan = $('#table-pelanggan').DataTable( {
    columnDefs: [
             { orderable: false, targets: [ -1 ] }
          ],
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
    "language": {
      "emptyTable": "List harga belum di inputkan, silahkan tambah produk",
      "sSearch": "Pencarian"
    },
    data: [], 
    drawCallback: function () {
        $('.dataTables_paginate > .pagination').addClass('pagination-sm'); 
        var item_element = $('.dataTables_paginate .paginate_button').length;  
        if(item_element > 3) {
          $('.dataTables_paginate')[0].style.display = "block";
        } else {
          $('.dataTables_paginate')[0].style.display = "none";
        }
    }
  });

  var table_pelanggan_tambah = $('#table-pelanggan-tambah').DataTable( {
    columnDefs: [
             { orderable: false, targets: [ -1 ] }
          ],
    "bPaginate": true,
    "pageLength": 7,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
    "language" : {
      "emptyTable": "Semua produk sudah di inputkan",
      "sSearch": "Pencarian"
    }, 
    data: []
  });

  // function draw_data_tambah() { 
  //   $.ajax({
  //     url: BASE_URL + 'admin/kelola_pelanggan/get_produk_tambah/' + pelanggan_id,
  //     type: "GET",
  //     dataType: 'json'
  //   }).done(function (result) {
  //     table_pelanggan_tambah.clear().draw(); 
  //     table_pelanggan_tambah.rows.add(result.data).draw();
  //   });
  // }
  
  function draw_data() { 
    $.ajax({
      url: BASE_URL + 'admin/kelola_pelanggan/get_produk/' + pelanggan_id,
      type: "GET",
      dataType: 'json'
    }).done(function (result) {
      table_pelanggan.clear().draw(); 
      table_pelanggan.rows.add(result.data).draw();
    });
  }

  draw_data();
  
  $('.btn-modal-tambah').click(function() {
    // draw_data_tambah();
  });

  //format number
  table_pelanggan_tambah.on('change paste keyup', '.currency', function(e) {  
    var value = parseFloat($(this).val().replace(/\./g, "")).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
    value = (value == 'NaN') ? null : value ;
    $(this).val(value);
  }); 

  $('#table-pelanggan-tambah').on('click', '.btn-tambah-produk', function() { 
    var produk_id = $(this).data('produk_id');
    var harga = $('.data_input_' + produk_id ).val(); 
    var harga_modal = $(this).data('harga');
    var btn_click = $(this); 

    if(harga != ''){

      if(harga.replace(/\./g, "") < harga_modal){
        alert('harga jual tidak boleh lebih kecil dari harga model');
        return false;
      } 
      $.ajax({
          type: 'POST', 
          url: BASE_URL + 'admin/kelola_pelanggan/tambah_produk/',
          data: { 
              'submit': true, 
              'produk_id': produk_id,
              'pelanggan_id': pelanggan_id,
              'harga':  harga,
          },
          success: function(msg){
              alert(msg); 
              table_pelanggan_tambah.row(btn_click.parents('tr')).remove().draw();
              //draw_data_tambah();
              draw_data();
          }
      });
    }else{
      alert('harga jual tidak boleh kosong');
    }
  });

  $('#table-pelanggan').on('click', '.btn-hapus', function() { 
    var id = $(this).data('id');  
    $('#teks_modal_hapus').text('Apakah anda yakin akan menghapus produk ini dari pelanggan ?'); 
    $('#modal_hapus').modal('show');
    $('#konfirmasi_hapus').click(function(){ 
      $.ajax({
          type: 'POST', 
          url: BASE_URL + 'admin/kelola_pelanggan/hapus_produk_dari_pelanggan',
          data: { 
              'submit': true, 
              'id': id 
          },
          success: function(msg){ 
              draw_data_tambah();
              draw_data();
              $('#modal_hapus').modal('hide');
          }
      });
    });
  }); 
});


 $('#button_surat_jalan').click(function() {

 })
 function hitungSubTotal(i) {
    $('#harga'+i+', #berat'+i+', #biaya_tambahan'+i+'').change(function(){
        var harga = parseInt($('#harga'+i+'').val());
        var berat = parseInt($('#berat'+i+'').val());
        var biaya_tambahan = parseInt($('#biaya_tambahan'+i+'').val());

        var sub_total = (harga * berat) + biaya_tambahan;
        $('#subtotal'+i+'').val(sub_total)
        totalAll();
     });
 }

 function totalAll() {
    var jumlah_tot=0;
    $('.subtotal').each(function(i,e) {
        var amt = $(this).val();
        jumlah_tot += parseFloat(amt);        
    });
    console.log(jumlah_tot);
    $('#total_pengiriman').val('Rp. '+jumlah_tot);
 }

 function checkSales() {
    var idx = {};
    $('.sales').each(function(){
         var val = $(this).val();
        if(val.length)
        {
            if(idx[val]){
                idx[val]++;
            }
            else{
              idx[val] = 1;   
            }
        }
    });
    var gt_one = $.map(idx,function(e,i){return e>1 ? e: null});
    var isUnique = gt_one.length==0
    if (isUnique == false) {
      alert('Sales sudah di gunakan! Harap check kembali');
      return false;
    }
 }

 $("#sales1").autocomplete({
    autoFocus: true,
    source: "<?php echo site_url('admin/Kelola_produk/get_sales/?');?>",
    select: function (e, ui) {
      var nama_sales = ui.item.value;
      console.log(nama_sales);
      $.get("<?php echo site_url('admin/Kelola_produk/get_data_sales_bynama/'); ?>"+nama_sales, function(respon) {
        var data = JSON.parse(respon);
        $('#id_sales1').val(data.id);
      });
    },
    messages: {
      noResults: '',
      results: function() {}
    }
  });

 $("#cari_produk1").autocomplete({
    autoFocus: true,
    source: "<?php echo site_url('admin/Kelola_produk/get_produk/?');?>",
    select: function (e, ui) {
       var produk = ui.item.value;
       var n = produk.indexOf("Kode");
       var kode = produk.substr(n+6, 10);    
       console.log(kode);       
       $.ajax({
        type: "GET",
        data: "",
        url: "<?php echo site_url('admin/Kelola_produk/get_data_produk_bykode/'); ?>"+kode,
        success: function(results) {
          var data = JSON.parse(results);
          $('#harga1').val(data.harga);
          $('#kode_produk1').val(data.id);
          $('#subtotal1').val(data.harga);
          totalAll();
        }
       })
    },
    messages: {
      noResults: '',
      results: function() {}
    }
  });

  function showTable(){
    $('#hidden_section').show();
  }

 var count_id = 1;

  function T_removeElement_awal() {
    if($('#tbody_pemesanan').children('tr').length > 1) {
      document.getElementById('tbody_pemesanan').removeChild(document.getElementById('tr1'));
    } else {
      alert("Tidak Ada Form Yang Di Hapus ");
    }
  }

  function T_removeElement(i) {
    if($('#tbody_pemesanan').children('tr').length > 1) {
      document.getElementById('tbody_pemesanan').removeChild(document.getElementById('tr' + i));
      count_id--;
      sumall();
    } else {
      alert("Tidak Ada Form Yang Di Hapus ");
    }
  }

  function addPengiriman() {
    count_id++;

    var objNewDiv = document.createElement('tr');
    objNewDiv.setAttribute('id', 'tr' + count_id);
    objNewDiv.innerHTML = '<td align="center">'+count_id+'</td>';
    objNewDiv.innerHTML += '<td data-title="No Pengiriman*"> <input type="text" id="no_pengiriman'+count_id+'" name="no_pengiriman[]" class="no_pengiriman form-control"> </td></td> <td data-title="Sales*"> <div class="input-group"> <input type="text" class="sales form-control" placeholder="Sales" id="sales'+count_id+'" name="sales[]"> </div><input type="hidden" class="form-control" id="id_sales'+count_id+'" name="id_sales[]"> </td> <td data-title="Produk*"> <div class="input-group"> <span class="input-group-addon"><i class="fa fa-search"></i></span> <input type="text" class="form-control" placeholder="Produk" onchange="hitungSubTotal('+count_id+')"  id="cari_produk'+count_id+'" name="nama_produk[]"> </div> <input type="hidden" class="form-control" id="kode_produk'+count_id+'" name="kode_produk[]"> </td> <td data-title=""> <textarea id="alamat'+count_id+'" name="alamat[]" class="form-control"></textarea> </td> <td data-title=""><input type="text" style="text-align: center" onchange="hitungSubTotal('+count_id+')" id="berat'+count_id+'" name="berat[]" min="1" value="1" class="form-control" required=""></td> <td data-title=""><input type="text" id="harga'+count_id+'" name="harga[]" onchange="hitungSubTotal('+count_id+')" readonly="" class="form-control">  </td> <td data-title=""> <input type="text" onchange="hitungSubTotal('+count_id+')" id="biaya_tambahan'+count_id+'" name="biaya_tambahan[]" value="0" class="form-control"> </td><td data-title=""><input type="text" id="subtotal'+count_id+'" name="subtotal[]" class="subtotal form-control" readonly></td>';
    objNewDiv.innerHTML += '<td><a href="javascript:void(0);" onclick="T_removeElement('+count_id+');" class="btn btn-danger" id="del_row'+count_id+'"><i class="glyphicon glyphicon-minus"></i></a></td></tr>';
    document.getElementById('tbody_pemesanan').appendChild(objNewDiv);

    $( "#cari_produk"+count_id ).autocomplete({
      autoFocus: true,
      source: "<?php echo site_url('admin/Kelola_produk/get_produk/?');?>",
      select: function (e, ui) {
           var produk = ui.item.value;
           var n = produk.indexOf("Kode");
           var kode = produk.substr(n+6, 10);    
           console.log(kode);       
           $.ajax({
            type: "GET",
            data: "",
            url: "<?php echo site_url('admin/Kelola_produk/get_data_produk_bykode/'); ?>"+kode,
            success: function(results) {
              var data = JSON.parse(results);
              $('#harga'+count_id+'').val(data.harga);
              $('#kode_produk'+count_id+'').val(data.id);
              $('#subtotal'+count_id+'').val(data.harga);

              totalAll() 
            }
           })
        },
      
      messages: {
        noResults: '',
        results: function() {}
      }
    });

    $("#sales"+count_id).autocomplete({
      autoFocus: true,
      source: "<?php echo site_url('admin/Kelola_produk/get_sales/?');?>",
      select: function (e, ui) {
        var nama_sales = ui.item.value;
        console.log(nama_sales);
        $.get("<?php echo site_url('admin/Kelola_produk/get_data_sales_bynama/'); ?>"+nama_sales, function(respon) {
          var data = JSON.parse(respon);
          $('#id_sales'+count_id).val(data.id);
        });
        },
      messages: {
        noResults: '',
        results: function() {}
      }
    });
  }

  
</script>
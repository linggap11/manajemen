
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
          <a href="<?= base_url('admin/kelola_pengiriman') ?>" onclick="" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Pengiriman</a> 
          </div>
           
        </div><!-- /.box-header -->
        <div class="box-body">
          <select class="list-pelanggan form-control" id="list_pelanggan">
            <option value="0">Pilih Pelanggan</option>  
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
                   <th width="10%">Status</th>  
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
                          <td>'.format_rupiah($wow->harga).'</td>
                          <td><span class="btn btn-danger btn-xs">'.$wow->status.'</span></td>
                          <td>
                               <a href="'.base_url().'admin/Kelola_pengiriman/print_surat_jalan/'.$wow->no_pengiriman.'" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> Surat Jalan</a>
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
      <!-- /.box -->
        
      <a href="<?php  echo base_url('admin/kelola_pelanggan') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list pelanggan</a>
 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $footer_js = isset($js) ? $js : array() ; ?>
<?php $this->load->view('admin/layout/footer'); ?>
<script type="text/javascript">
  var id = $('#list_pelanggan').val();
  $('#id').val(id);
  
  $(document).ready(function() {

    $('#tabel_pengiriman_by_pelanggan').DataTable({

    });
    // get data pengiriman by pelanggan
   $('#list_pelanggan').change(function() {
    var id_pelanggan = $('#list_pelanggan').val();
    if (id_pelanggan == "0") { return false}
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
          { "data": "status"},
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




  
</script>
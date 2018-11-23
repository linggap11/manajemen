 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
     <ol class="breadcrumb left">
       <li><a href="<?php  echo base_url('admin/kelola_pelanggan') ?>"><i class="fa fa-users"></i> List Pelanggan</a></li> 
       <li class="active">Produk Pelanggan</li>
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
          <a href="#tambah" class="btn btn-modal-tambah btn-sm btn-primary pull-right" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Produk</a> 
          </div>
           
        </div><!-- /.box-header -->
        <div class="box-body">
          <select class="list-pelanggan form-control">
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
          <table id="table-pelanggan" class="table table-bordered">
          <thead>
            <tr class="default">
              <th width="5%">No</th>
                   <th width="10%">No pengiriman</th>
                   <th width="10%">Kode Produk</th>
                   <th width="15%">Alamat</th>  
                   <th width="5%">Kecamatan</th>  
                   <th width="5%">Kelurahan</th>
                   <th width="5%">Berat</th>
                   <th width="5%">Kode Pos</th>
                   <th width="10%">Harga</th>
                   <th width="10%">Biaya Tambahan</th>  
                   <th width="25%"></th>  
            </tr>
          </thead>
          
          <tbody>


            <?php foreach($result as $res) { ?>
            <tr>
                <td><?php echo $res->kode;?></td> 
                <td><?php echo $res->nama;?></td> 
                <td><?php echo format_rupiah($res->harga);?></td>                                    
                <td class="text-center"> 
                <a href="<?php echo site_url('admin/kelola_produk/edit/'. $res->id);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                <a href="<?php echo site_url('admin/kelola_produk/delete/' . $res->id);?>" class="btn btn-danger btn_hapus btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                </td>
            </tr>
            <?php } ?>


            <?php 
            // INSERT INTO `pengiriman`(`id`, `no_pengiriman`, `alamat`, `kecamatan`, `kelurahan`, `harga`, `berat`, `biaya_tambahan`, `kodepos`, `produk_id`, `pelanggan_id`)
            // if(!empty($DataPelanggan)){
            //   $nomor=1;

            //     foreach ($DataPelanggan as $wow => $res) {
            //       // echo '
            //       // <tr>
            //       //   <td>'.$wow['no_pengiriman'].'</td>
            //       //   <td>'.$wow['produk_id'].'</td>
            //       //   <td>'.$wow['alamat'].'</td>
            //       //   <td>'.$wow['kecamatan'].'</td>
            //       //   <td>'.$wow['kelurahan'].'</td>
            //       //   <td>'.$wow['berat'].'</td>
            //       //   <td>'.$wow['kodepos'].'</td>
            //       //   <td>'.$wow['harga'].'</td>
            //       //   <td>'.$wow['biaya_tambahan'].'</td>
            //       // </tr>
            //       // ';
            //       // echo $wow->no_pengiriman; 
            //       // var_dump($wow);
            //       echo $res->no_pengiriman;
            //       echo '<pre>';
            //       // var_dump();
            //       echo '</pre>';
            //       // echo $data['produk_id'] = $wow['produk_id'];
            //     }              

            // }

             ?>
          </tbody>
          <tfoot></tfoot>

          </table>
        </div>



        <!-- /.box-body -->

        <div class="box-footer clearfix"> 
        </div>

      </div>
      <!-- /.box -->

      <a href="<?php  echo base_url('admin/kelola_pelanggan') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list pelanggan</a>


  <!-- new item Modal -->
   <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-content animate modal-md">
       <div class="modal-content">
        <form action="<?php echo site_url('admin/kelola_pelanggan/tambah_produk');?>" class="form-horizontal" role="form" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Produk</h4>
          </div>
          <div class="modal-body">


           <!--   <table id="table-pelanggan-tambah" class="table table-bordered">
             <thead>
               <tr class="default">
                   <th width="15%">No Pengiriman</th>
                   <th width="15%">Kode Produk</th>
                   <th width="15%">Alamat</th>
                   <th width="5%">Kecamatan</th>  
                   <th width="5%">Kelurahan</th>   
                   <th width="5%">Berat</th>   
                   <th width="15%">Kode Pos</th>  
                   <th width="10%">Harga</th>   
                   <th width="10%">Biaya Tambahan</th> 
                   <th width="20%"></th>
               </tr>
             </thead>
             
             <tbody>
                 <tr> </tr>
             </tbody>
             <tfoot></tfoot>

             </table> -->



         </div><!-- end modal-body -->
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> 
         </div>
         </form>
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
 
<div class="modal fade" tabindex="-1" role="dialog" id="modal_hapus">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Hapus Data Harga</h4>
      </div>
      <div class="modal-body">
        <p id="teks_modal_hapus"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <a href="#" id="konfirmasi_hapus" class="btn btn-danger">Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php $footer_js = isset($js) ? $js : array() ; ?>
<?php $this->load->view('admin/layout/footer'); ?> 

<script type="text/javascript">
  $(document).ready(function() {
  var list_pelanggan = $('.list-pelanggan').select2();
  list_pelanggan.on('select2:select', function (e) {
      var value = e.params.data.element.value; 
      if(value != ''){
        window.location = BASE_URL + "admin/kelola_pelanggan/produk/" + value;
      }
  });

  var pelanggan_id = <?php echo $pelanggan->id; ?>;
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

  function draw_data_tambah() { 
    $.ajax({
      url: BASE_URL + 'admin/kelola_pelanggan/get_produk_tambah/' + pelanggan_id,
      type: "GET",
      dataType: 'json'
    }).done(function (result) {
      table_pelanggan_tambah.clear().draw(); 
      table_pelanggan_tambah.rows.add(result.data).draw();
    });
  }

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
    draw_data_tambah();
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
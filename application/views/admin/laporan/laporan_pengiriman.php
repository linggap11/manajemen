    <!-- Content Wrapper. Contains page content -->
    <style type="text/css" media="screen">
      th {
        text-align: center
      }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb left"> 
              <li class="active"><i class="fa fa-file-o"></i>Laporan Pengiriman</li>
            </ol>
            
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= $title ?> </h3> 
                            <div class="box-tools row" style="width: 400px;">
                              <div class="col-md-3"> 
                                <select id="select-status" name="select-status" class="form-control input-sm" style="border-radius: 3px;">
                                    <option data-status="all" value="all">Status</option>   
                                    <option data-status="BERHASIL" value="BERHASIL">BERHASIL</option>
                                    <option data-status="INORDER" value="INORDER">IN ORDER</option>
                                    <option data-status="BATAL" value="BATAL">BATAL</option>
                                </select>
                              </div>
                              <div class="col-md-4"> 
                                <select id="select-bulan" name="select-bulan" class="form-control input-sm" style="border-radius: 3px;">
                                    <option data-bulan="all" value="all">Bulan</option>
                                    <?php foreach ($bulan as $bul) { ?>
                                    <option value="<?= $bul->bulan ?>" data-bulan="<?php echo $bul->bulan?>"><?php echo getBulanIndo($bul->bulan)?></option>
                                    <?php } ?>
                                </select>
                              </div>
                              <div class="col-md-3"> 
                                <select id="select-tahun" class="form-control input-sm" style="border-radius: 3px;">
                                    <option data-bulan="all" value="all">Tahun</option>
                                    <?php foreach ($tahun as $thn) { ?>
                                    <option value="<?= $thn->tahun ?>" <?php echo ($bul->bulan == 'all' && $thn->tahun == $data_tahun) ? 'selected' : '' ; ?> data-bulan="all" data-tahun="<?php echo $thn->tahun?>"><?php echo $thn->tahun ?></option>
                                    <?php } ?>
                                </select>
                              </div>
                                <button type="button" class="btn btn-success" id="sorting"><strong>Apply</strong></button>
                              <div>
                              </div>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            <a href="<?php echo base_url('admin/Laporan/pengiriman_print/' . $data_bulan . '/' . $data_tahun. '/' . $data_status) ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Print Laporan</a><br><br>
                            <table id="table-laporan" class="table table-bordered">
                              <thead>
                              <tr>
                                  <th>No Pengiriman</th>
                                  <th>Tanggal</th>
                                  <th>Sales </th>
                                  <th>Pelanggan</th>
                                  <th>Produk</th>  
                                  <th>Total Biaya</th>
                                  <th>Kas Jalan</th>
                                  <th width="15%">Status</th>    
                              </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($result as $row): ?>
                                  <tr>
                                    <td><?php echo $row->no_pengiriman; ?></td>
                                    <td><?php echo $row->tgl_transaksi; ?></td>
                                    <td><?php echo $row->sales; ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->nama_produk; ?></td>
                                    <td><?php echo format_rupiah($row->total); ?></td>
                                    <td><?php echo format_rupiah($row->biaya_tambahan); ?></td>
                                    <td align="center"><strong><?php echo $row->status; ?></strong></td>
                                  </tr>
                                <?php endforeach ?>
                              </tbody>
                              </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer"> 
                        </div><!-- box-footer -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Pengiriman Berdasarkan Sales</h3> 
                            
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            <table id="table-laporan-sales" class="table table-bordered">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Nama Sales</th>
                                  <th>No Kendaraan</th>
                                  <th>No Telepon</th>
                                  <th>Total Pengiriman</th>      
                                  <th></th>      
                              </tr>
                              </thead>
                              <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data_sales as $row): ?>
                                  <tr>
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->plat_nomor; ?></td>
                                    <td><?php echo $row->no_telp; ?></td>
                                    <td align="center"><button type="button" class="btn btn-success btn-xs"><?php echo $row->total_pengiriman; ?></button></td>
                                    <td align="center"><button type="button" data-id="<?= $row->id ?>" class="detail btn btn-secondary btn-xs">Detail</button></td>
                                  </tr>
                                <?php endforeach ?>
                              </tbody>
                              </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer"> 
                        </div><!-- box-footer -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

<div class="modal fade" id="detailPengiriman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><center><strong>DETAIL PENGIRIMAN <i id="sales"></i> [<span id="plat"></span>]</strong></center></h5>
      </div>
      <div class="modal-body">
        <table id="table_detail" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Surat Jalan</th>
                    <th>Tanggal</th>
                    <th>Kas Jalan</th>
                    <th>Tagihan</th>
                    <th>Status</th>
                    <th>Detail SJ</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <a href="" target="_blank" id="print_invoice" class="btn btn-danger btn-xs"><span class="fa fa-print"></span> Print Semua</a>
        <button type="button" id="close" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
    <?php $footer_js = isset($js) ? $js : array() ; ?>
    <?php $this->load->view('admin/layout/footer', $footer_js); ?> 
 
    <script type="text/javascript">
  $(document).ready(function() {
    $('#table-laporan').dataTable({
       "order": [[ 0, "desc" ]]
    });

    $('#table-laporan-sales').dataTable({
       "order": [[ 0, "asc" ]],
       "bLengthChange": false,
       "bInfo": false,
    });

    $('#sorting').click(function() {
      var status = $('#select-status').val();
      var bulan = $('#select-bulan').val();
      var tahun = $('#select-tahun').val();
      window.location.replace(BASE_URL + 'admin/Laporan/laporan_pengiriman/' + bulan + '/' + tahun + '/' + status);

    });
    // $('#select-bulan').on('change', function(){
    //   if($(this).find(':selected').data('bulan') != ''){
    //     var bulan = $(this).find(':selected').data('bulan');
    //     var tahun = $(this).find(':selected').data('tahun');
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pengiriman/' + bulan + '/' + tahun);
    //   }else{
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pengiriman');
    //   }
    // }); 

    // $('#select-tahun').on('change', function(){
    //   if($(this).find(':selected').data('bulan') != ''){ 
    //     var tahun = $(this).find(':selected').data('tahun'); 
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pengiriman/all/' + tahun);
    //   }else{
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pengiriman');
    //   }
    // }); 
  }); 

  $('.detail').click(function() {
        var id = $(this).data('id');
        $.get('<?php echo base_url() ?>admin/Laporan/get_detail_sales/'+id, function(respon) {
            var data = JSON.parse(respon);
            var no = 1;
            $('#sales').html(data[0].nama);
            $('#plat').html(data[0].plat_nomor);
            
            for (var i = 0; i < data.length; i++) {
                $('#table_detail').find('tbody').append("<tr><td align='center'>"+no+"</td><td align='center'>"+data[i].no_pengiriman+"</td><td align='center'>"+data[i].tgl_transaksi+"</td><td>"+convertToRupiah(data[i].biaya_tambahan)+"</td><td>"+convertToRupiah(data[i].total)+"</td><td align='center'>"+data[i].status+"</td><td align='center'><a href='<?= base_url('admin/Kelola_pengiriman/print_surat_jalan/') ?>"+data[i].no_pengiriman+"' title='SJ "+data[i].no_pengiriman+"' target='_blank' class='btn btn-success btn-xs'>Lihat</a></td></tr>");    
                no++;
            }    
            $('#print_invoice').prop({
              href: '<?= base_url('admin/Laporan/print_sj_by_sales/') ?>'+data[0].sales_id,
            })
        });
        
        $('#detailPengiriman').modal('show');
    });
   
   $('#close').click(function() {
        $('#table_detail').find('tbody').empty();
    });
   
   $('#detailPengiriman').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    })

   function convertToRupiah(angka) {
        var rupiah = '';        
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
    }
</script>
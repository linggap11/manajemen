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
                            <h3 class="box-title"><?= $title ?></h3> 
                            <div class="box-tools row" style="width: 400px;">
                              <div class="col-md-3"> 
                                <select id="select-status" name="select-status" class="form-control input-sm" style="border-radius: 3px;">
                                    <option data-status="all" value="all">Status</option>   
                                    <option data-status="APPROVED" value="APPROVED">APPROVED</option>
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
                            <a href="<?php echo base_url('admin/Laporan/pemesanan_print/' . $data_bulan . '/' . $data_tahun. '/' . $data_status) ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Print Laporan</a><br><br>
                            <table id="table-laporan" class="table table-bordered">
                              <thead>
                              <tr>
                                  <th>No Bukti</th>
                                  <th>Tanggal</th>
                                  <th>Sales </th>
                                  <th>Pelanggan</th>
                                  <th>Alamat</th>  
                                  <th>Total</th>  
                                  <th width="15%">Status</th>    
                              </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($result as $row): ?>
                                  <tr>
                                    <td><?php echo $row->no_bukti; ?></td>
                                    <td><?php echo $row->tgl_transaksi; ?></td>
                                    <td><?php echo $row->sales; ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->alamat; ?></td>
                                    <td><?php echo $row->total; ?></td>
                                    <td align="center"><strong><?php echo $row->status_transaksi; ?></strong></td>
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
    <!-- /.content-wrapper -->


    <?php $footer_js = isset($js) ? $js : array() ; ?>
    <?php $this->load->view('admin/layout/footer', $footer_js); ?> 
 
<script type="text/javascript">
  $(document).ready(function() {
    $('#table-laporan').dataTable({
       "order": [[ 0, "desc" ]]
    });

    $('#sorting').click(function() {
      var status = $('#select-status').val();
      var bulan = $('#select-bulan').val();
      var tahun = $('#select-tahun').val();
      window.location.replace(BASE_URL + 'admin/Laporan/laporan_pemesanan/' + bulan + '/' + tahun + '/' + status);

    });
    // $('#select-bulan').on('change', function(){
    //   if($(this).find(':selected').data('bulan') != ''){
    //     var bulan = $(this).find(':selected').data('bulan');
    //     var tahun = $(this).find(':selected').data('tahun');
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pemesanan/' + bulan + '/' + tahun);
    //   }else{
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pemesanan');
    //   }
    // }); 

    // $('#select-tahun').on('change', function(){
    //   if($(this).find(':selected').data('bulan') != ''){ 
    //     var tahun = $(this).find(':selected').data('tahun'); 
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pemesanan/all/' + tahun);
    //   }else{
    //     window.location.replace(BASE_URL + 'admin/Laporan/laporan_pemesanan');
    //   }
    // }); 
  }); 
</script>
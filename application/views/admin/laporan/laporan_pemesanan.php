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
                            <h3 class="box-title">Laporan Pemesanan</h3>
                            <div class="box-tools row" style="width: 600px;">
                              <form class="" action="<?php echo base_url('admin/Laporan/laporan_pemesanan') ?>" method="post">
                                <div class="col-md-3">
                                  <select name="status" id="status" class="form-control input-sm" style="border-radius: 3px;">
                                      <?php if ($status == 'APPROVED'): ?>
                                          <option value="ALL">STATUS</option>
                                          <option value="APPROVED" selected>APPROVED</option>
                                          <option value="PENDING">IN ORDER</option>
                                          <option value="BATAL">BATAL</option>
                                        <?php elseif ($status == 'PENDING'): ?>
                                          <option value="ALL">STATUS</option>
                                          <option value="APPROVED">APPROVED</option>
                                          <option value="PENDING" selected>IN ORDER</option>
                                          <option value="BATAL">BATAL</option>
                                        <?php elseif ($status == 'BATAL'): ?>
                                          <option value="ALL">STATUS</option>
                                          <option value="APPROVED">APPROVED</option>
                                          <option value="PENDING">IN ORDER</option>
                                          <option value="BATAL" selected>BATAL</option>
                                        <?php else: ?>
                                          <option value="ALL" selected>STATUS</option>
                                          <option value="APPROVED">APPROVED</option>
                                          <option value="PENDING">IN ORDER</option>
                                          <option value="BATAL">BATAL</option>
                                      <?php endif; ?>

                                  </select>
                                </div>
                                <div class="col-md-3">
                                  <input type="text" name="awal" autocomplete="off" class="datepicker form-control input-sm" value="<?php echo $tgl_awal ?>" size="2" id="awal" placeholder="Tanggal Awal">
                                </div>
                                <div class="col-md-3">
                                  <input type="text" name="akhir" autocomplete="off" class="datepicker form-control input-sm" value="<?php echo $tgl_akhir ?>" size="2" id="akhir" placeholder="Tanggal Akhir">
                                </div>
                                  <button type="submit" class="btn btn-success"><strong>Apply</strong></button>
                                <div>
                                </div>
                              </form>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            
                            <a href="<?php echo base_url('admin/Laporan/pemesanan_print/'.$status.'/'.$tgl_awal.'/'.$tgl_akhir.'') ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Print Laporan</a><br><br>
                            <table id="table-laporan" class="table table-bordered">
                              <thead>
                              <tr>
                                  <th>No Bukti</th>
                                  <th>Tanggal</th>
                                  <th>Sales </th>
                                  <th>Pelanggan</th>
                                  <th>Alamat</th>
                                  <th>Total Biaya</th>
                                  <th>Kas Jalan</th>
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
                                    <td><?php echo format_rupiah($row->total); ?></td>
                                    <td><?php echo format_rupiah($row->biaya_tambahan); ?></td>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>">
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table-laporan').dataTable({
       "order": [[ 0, "desc" ]]
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
  $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
  });
</script>

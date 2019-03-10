    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Dashboard admin
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

              <div class="row">
                <div class="col-md-12">
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h3>Rp. <sup style="font-size: 20px"><?php echo format_rp($kas) ?></sup></h3>

                        <p>Kas</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-bank"></i>
                      </div>
                      <a href="<?php echo base_url('admin/Kelola_keuangan/buku_kas').get_url_cache() ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h3>Rp. <sup style="font-size: 20px"><?php echo format_rp($piutang) ?></sup></h3>

                        <p>Total Piutang</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-sign-in"></i>
                      </div>
                      <a href="<?php echo base_url('admin/Kelola_keuangan/piutang').get_url_cache() ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3>Rp. <sup style="font-size: 20px"><?php echo format_rp($hutang) ?></sup></h3>

                        <p>Total Hutang</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-sign-out"></i>
                      </div>
                      <a href="<?php echo base_url('admin/Kelola_keuangan/buku_hutang').get_url_cache() ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                      <div class="inner">
                        <h3><?php echo count($total_penagihan) ?></h3>

                        <p>Total Penagihan</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-list-alt"></i>
                      </div>
                      <a href="<?php echo base_url('admin/Laporan/laporan_tagihan').get_url_cache() ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>

               </div> <!-- /.col md 12 -->
            </div> <!-- /.row -->

        </section>
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('admin/layout/footer'); ?>

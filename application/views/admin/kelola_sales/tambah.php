    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            
            <ol class="breadcrumb left">
              <li><a href="<?php  echo base_url('admin/kelola_sales') ?>"><i class="fa fa-users"></i> List Sales</a></li> 
              <li class="active">Tambah Sales</li>
            </ol>

        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Sales</h3>
                        </div><!-- /.box-header -->
                        <form class="form" action="<?php echo site_url('admin/kelola_sales/tambah');?>" method="post">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-5">

                              <div class="form-group <?php echo (form_error('nama')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nama</label> 
                                <input class="form-control" type="text" name="nama" value="<?php echo set_value('nama'); ?>">
                                <?php echo (form_error('nama')) ? '<span class="help-block">' . form_error('nama') . '</span>' : '';?> 
                              </div> 

                            </div><!-- end col -->
                            <div class="col-md-5">  
                               <div class="form-group <?php echo (form_error('plat_nomor')) ? 'has-error' : '';?>">
                                 <label for="inputNama" class="control-label">Plat Nomor</label> 
                                 <input class="form-control" name="plat_nomor"><?php echo set_value('plat_nomor'); ?></input>
                                 <?php echo (form_error('plat_nomor')) ? '<span class="help-block">' . form_error('plat_nomor') . '</span>' : '';?> 
                               </div>
                            </div>

                            <div class="col-md-5">  
                              <div class="form-group <?php echo (form_error('no_telp')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nomor Telepon</label> 
                                <input class="form-control" type="text" name="no_telp" value="<?php echo set_value('no_telp'); ?>">
                                <?php echo (form_error('no_telp')) ? '<span class="help-block">' . form_error('no_telp') . '</span>' : '';?> 
                            </div>
                           </div>  
                              
                              <div class="col-md-5">
                              <div class="form-group <?php echo (form_error('no_gps')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nomor GPS</label> 
                                <input class="form-control" type="text" name="no_gps" value="<?php echo set_value('no_gps'); ?>">
                                <?php echo (form_error('no_gps')) ? '<span class="help-block">' . form_error('no_gps') . '</span>' : '';?> 
                            </div><!-- end col -->
                          </div><!-- end row -->
                        </div><!-- /.box-body -->
                        <div class="box-footer c">
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="save"><i class="fa fa-save"></i> Tambah Sales</button>
                        </div><!-- box-footer -->
                    </form>
                    </div><!-- /.box -->
        <a href="<?php  echo base_url('admin/kelola_sales') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list Sales</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('admin/layout/footer'); ?>
 
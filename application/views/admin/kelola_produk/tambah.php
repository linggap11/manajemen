    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            
            <ol class="breadcrumb left">
              <li><a href="<?php  echo base_url('admin/kelola_produk') ?>"><i class="fa fa-users"></i> List Sales</a></li> 
              <li class="active">Tambah Produk</li>
            </ol>

        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Produk</h3>
                        </div><!-- /.box-header -->
                        <form class="form" action="<?php echo site_url('admin/kelola_produk/tambah');?>" method="post">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-5">

                              <div class="form-group <?php echo (form_error('kode')) ? 'has-error' : '';?>">
                                <label for="inputkode" class="control-label">Kode Produk</label> 
                                <input class="form-control" type="text" name="kode" value="<?php echo set_value('kode'); ?>">
                                <?php echo (form_error('kode')) ? '<span class="help-block">' . form_error('kode') . '</span>' : '';?> 
                              </div> 


                              <div class="form-group <?php echo (form_error('nama')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nama</label> 
                                <input class="form-control" type="text" name="nama" value="<?php echo set_value('nama'); ?>">
                                <?php echo (form_error('nama')) ? '<span class="help-block">' . form_error('nama') . '</span>' : '';?> 
                              </div> 

                            </div><!-- end col -->
                            <div class="col-md-5">  
                               <div class="form-group <?php echo (form_error('harga')) ? 'has-error' : '';?>">
                                 <label for="inputNama" class="control-label">Harga</label> 
                                 <input class="form-control" name="harga"><?php echo set_value('harga'); ?></input>
                                 <?php echo (form_error('harga')) ? '<span class="help-block">' . form_error('harga') . '</span>' : '';?> 
                            </div> <!-- end col -->
                          </div><!-- end row -->
                        </div><!-- /.box-body -->
                        <div class="box-footer c">
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="save"><i class="fa fa-save"></i> Tambah Produk</button>
                        </div><!-- box-footer -->
                    </form>
                    </div><!-- /.box -->
        <a href="<?php  echo base_url('admin/kelola_produk') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list Produk</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('admin/layout/footer'); ?>
 
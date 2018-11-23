    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            
            <ol class="breadcrumb left">
              <li><a href="<?php  echo base_url('admin/kelola_produk') ?>"><i class="fa fa-users"></i> List Produk</a></li> 
              <li class="active">Edit Produk</li>
            </ol>
             
        </section>

        <!-- Main content -->
        <section class="content">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Produk</h3>
                        </div><!-- /.box-header -->
                        <form class="" action="<?php echo site_url('admin/kelola_produk/edit/' . $id);?>" method="post">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-5">

                               <div class="form-group <?php echo (form_error('kode')) ? 'has-error' : '';?>">
                                <label for="inputkode" class="control-label">Kode Produk</label> 
                                <input class="form-control" type="text" name="kode" value="<?php echo set_value('kode', $produk->kode); ?>">
                                <?php echo (form_error('kode')) ? '<span class="help-block">' . form_error('kode') . '</span>' : '';?> 
                              </div>   

                              <div class="form-group <?php echo (form_error('nama')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nama</label> 
                                <input class="form-control" type="text" name="nama" value="<?php echo set_value('nama', $produk->nama); ?>">
                                <?php echo (form_error('nama')) ? '<span class="help-block">' . form_error('nama') . '</span>' : '';?> 
                              </div> 

                              <div class="form-group <?php echo (form_error('harga  ')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Harga</label> 
                                <input class="form-control" type="text" name="harga" value="<?php echo set_value('harga', $produk->harga); ?>">
                                <?php echo (form_error('harga')) ? '<span class="help-block">' . form_error('harga') . '</span>' : '';?> 
                              </div>
                            </div><!-- end col -->
                          </div><!-- end row -->
                        </div><!-- /.box-body -->
                        <div class="box-footer c">
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="save"><i class="fa fa-save"></i> Simpan Perubahan</button>
                        </div><!-- box-footer -->
                    </form>
                    </div><!-- /.box -->
        <a href="<?php  echo base_url('admin/kelola_produk') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list produk</a>

                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    

    <?php $this->load->view('admin/layout/footer'); ?>

     
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb left">
              <li><a href="<?php  echo base_url('admin/kelola_pelanggan') ?>"><i class="fa fa-users"></i> List Pelanggan</a></li> 
              <li class="active">Edit Pelanggan</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Pelanggan</h3>
                        </div><!-- /.box-header -->
                        <form class="" action="<?php echo site_url('admin/kelola_pelanggan/edit/' . $id);?>" method="post">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-5">

                              <div class="form-group <?php echo (form_error('nama')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nama</label> 
                                <input class="form-control" type="text" name="nama" value="<?php echo set_value('nama', $pelanggan->nama); ?>">
                                <?php echo (form_error('nama')) ? '<span class="help-block">' . form_error('nama') . '</span>' : '';?> 
                              </div> 

                              <div class="form-group <?php echo (form_error('no_telp  ')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nomor Telepon</label> 
                                <input class="form-control" type="text" name="no_telp" value="<?php echo set_value('no_telp', $pelanggan->no_telp); ?>">
                                <?php echo (form_error('no_telp')) ? '<span class="help-block">' . form_error('no_telp') . '</span>' : '';?> 
                              </div>

                                <div class="form-group <?php echo (form_error('alamat')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Alamat</label> 
                                <textarea class="form-control" name="alamat"><?php echo set_value('alamat', $pelanggan->alamat); ?></textarea>
                                <?php echo (form_error('alamat')) ? '<span class="help-block">' . form_error('alamat') . '</span>' : '';?> 
                              </div>
                          </div> <!-- end col -->
                          
                          <div class="col-md-5 col-md-offset-1">
                              <div class="form-group <?php echo (form_error('kode_pos  ')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Kode Pos</label> 
                                <input class="form-control" type="text" name="kode_pos" value="<?php echo set_value('kode_pos', $pelanggan->kode_pos); ?>">
                                <?php echo (form_error('kode_pos')) ? '<span class="help-block">' . form_error('kode_pos') . '</span>' : '';?> 
                              </div>

                            
                

                            </div><!-- end col -->
                          </div><!-- end row -->
                        </div><!-- /.box-body -->
                        <div class="box-footer c">
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="save"><i class="fa fa-save"></i> Simpan Perubahan</button>
                        </div><!-- box-footer -->
                    </form>
                    </div><!-- /.box -->
        <a href="<?php  echo base_url('admin/kelola_pelanggan') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list pelanggan</a>

                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    

    <?php $this->load->view('admin/layout/footer'); ?>

     
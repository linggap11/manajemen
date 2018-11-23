    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
             <ol class="breadcrumb left">
               <li><a href="<?php  echo base_url('admin/kelola_admin') ?>"><i class="fa fa-user-secret"></i> List Admin</a></li> 
               <li class="active">Tambah Admin</li>
             </ol> 
        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Admin</h3>
                        </div><!-- /.box-header -->
                        <form class="form" action="<?php echo site_url('admin/kelola_admin/tambah');?>" method="post">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-5">

                              <div class="form-group <?php echo (form_error('nama')) ? 'has-error' : '';?>">
                                <label class="control-label">Nama</label> 
                                <input class="form-control" type="text" name="nama" value="<?php echo set_value('nama'); ?>">
                                <?php echo (form_error('nama')) ? '<span class="help-block">' . form_error('nama') . '</span>' : '';?> 
                              </div>

                              <div class="form-group <?php echo (form_error('username')) ? 'has-error' : '';?>">
                                <label class="control-label">Username</label> 
                                <input class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>">
                                <?php echo (form_error('username')) ? '<span class="help-block">' . form_error('username') . '</span>' : '';?> 
                              </div>

                              <div class="form-group <?php echo (form_error('email')) ? 'has-error' : '';?>">
                                <label class="control-label">Email</label> 
                                <input class="form-control" type="email" name="email" value="<?php echo set_value('email'); ?>">
                                <?php echo (form_error('email')) ? '<span class="help-block">' . form_error('email') . '</span>' : '';?> 
                              </div>
                              
                              <div class="form-group <?php echo (form_error('hak_akses')) ? 'has-error' : '';?>">
                                <label class="control-label">Hak Akses</label> 
                                <select class="form-control" name="hak_akses">
                                    <option value="admin">Administrator</option>
                                    <option value="staff">Staff Karyawan</option>
                                </select>
                                <?php echo (form_error('hak_akses')) ? '<span class="help-block">' . form_error('hak_akses') . '</span>' : '';?> 
                              </div>

                            </div><!-- end col -->
                            <div class="col-md-5 col-md-offset-1">

                              <div class="form-group <?php echo (form_error('password')) ? 'has-error' : '';?>">
                                <label class="control-label">Password</label> 
                                <input class="form-control" type="password" name="password" value="<?php echo set_value('password'); ?>">
                                <?php echo (form_error('password')) ? '<span class="help-block">' . form_error('password') . '</span>' : '';?> 
                              </div>

                              <div class="form-group <?php echo (form_error('cpassword')) ? 'has-error' : '';?>">
                                <label class="control-label">Konfirmasi Password</label> 
                                <input class="form-control" type="password" name="cpassword" value="<?php echo set_value('cpassword'); ?>">
                                <?php echo (form_error('cpassword')) ? '<span class="help-block">' . form_error('cpassword') . '</span>' : '';?> 
                              </div> 

                            </div><!-- end col -->
                          </div><!-- end row -->
                        </div><!-- /.box-body -->
                        <div class="box-footer c">
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="save"><i class="fa fa-save"></i> Tambah Admin</button>
                        </div><!-- box-footer -->
                    </form>
                    </div><!-- /.box -->
        <a href="<?php  echo base_url('admin/kelola_admin') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list admin</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('admin/layout/footer'); ?>
 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header"> 
          <ol class="breadcrumb left">
            <li class="active"> <i class="fa fa-users"></i> List Sales </li> 
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Sales</h3>
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/kelola_sales/tambah');?>"><i class="fa fa-plus"></i> Tambah Sales</a>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                            <table id="table-regular" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Nama </th> 
                                    <th>Plat Nomor </th>                                     
                                    <th>Nomor Telepon</th> 
                                    <th>Nomor Gps</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($result as $res) { ?>
                                <tr>
                                    <td><?php echo $res->nama;?></td> 
                                    <td><?php echo $res->plat_nomor;?></td> 
                                    <td><?php echo $res->no_telp;?></td> 
                                    <td><?php echo $res->no_gps;?></td>                                    
                                    <td class="text-center"> 
                                    <a href="<?php echo site_url('admin/kelola_sales/edit/' . $res->id);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="<?php echo site_url('admin/kelola_sales/delete/' . $res->id);?>" class="btn btn-danger btn_hapus btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            </div><!-- end table responsive -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <?php echo $this->pagination->create_links();?>
                        </div><!-- box-footer -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


 
    <?php $this->load->view('admin/layout/footer'); ?>

    <script type="text/javascript">
        table_regular.on('click', '.btn_hapus', function(){
            return confirm('apakah anda yakin?');
        });
    </script>
    

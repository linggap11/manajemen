    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header"> 
          <ol class="breadcrumb left">
            <li class="active"> <i class="fa fa-users"></i> List Pelanggan </li> 
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Pelanggan</h3>
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/kelola_pelanggan/tambah');?>"><i class="fa fa-plus"></i> Tambah Pelanggan</a>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                            <table id="table-regular" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Nama Pelanggan</th> 
                                    <th>No Telpon</th> 
                                    <th width="15%">Alamat</th>                                     
                                    <th>Kode Pos</th> 
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th width="15%" class="text-center">Jumlah Produk </th> 
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($result as $res) { ?>
                                <tr>
                                    <td><?php echo $res->nama;?></td> 
                                    <td><?php echo $res->no_telp;?></td> 
                                    <td><?php echo $res->alamat;?></td> 
                                    <td><?php echo $res->kode_pos;?></td> 
                                    <td><?php echo $res->kecamatan;?></td> 
                                    <td><?php echo $res->kelurahan;?></td>                                   
                                    <td class="text-center">
                                        <span class="label label-info">
                                            <?php echo $this->model_produk->countListHargaByPelangganID($res->id);?>
                                        </span></td>                                    
                                    <td class="text-center">

                                    <a href="<?php echo site_url('admin/kelola_pelanggan/produk/' . $res->id);?>" class="btn btn-success btn-xs"><i class="fa fa-archive">Produk</i> </a>
                                    <a href="<?php echo site_url('admin/kelola_pelanggan/edit/' . $res->id);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="<?php echo site_url('admin/kelola_pelanggan/delete/' . $res->id);?>" class="btn btn-danger btn_hapus btn-xs"><i class="fa fa-trash"></i> Hapus</a>
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
    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb left">
            <li class="active"> <i class="fa fa-users"></i> List Produk </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Produk</h3>
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/kelola_produk/tambah');?>"><i class="fa fa-plus"></i> Tambah Produk</a>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                            <table id="table-regular" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi Produk</th>
                                    <th width="10%" >Harga</th>
                                    <th>Pelanggan</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1?>
                                <?php foreach($result as $res) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++;?></td>
                                    <td><?php echo $res->nama;?></td>
                                    <td><?php echo $res->deskripsi;?></td>
                                    <td><?php echo format_rupiah($res->harga);?></td>
                                    <td><strong><?php echo $res->pelanggan;?></strong></td>
                                    <td class="text-center">
                                    <a href="<?php echo site_url('admin/kelola_produk/edit/'. $res->id);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="<?php echo site_url('admin/kelola_produk/delete/' . $res->id);?>" class="btn btn-danger btn_hapus btn-xs"><i class="fa fa-trash"></i> Hapus</a>
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

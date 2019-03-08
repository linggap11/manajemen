    <style type="text/css" media="screen">
        th {
          text-align: center;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header"> 
          <ol class="breadcrumb left">
            <li class="active"> <i class="fa fa-users"></i> Daftar Tagihan </li> 
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Tagihan Pelanggan Yang Telah Disetujui</h3>
                            <br>
                            
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                            <table id="table-tagihan" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th> 
                                    <th>Pelanggan</th>
                                    <th>Alamat</th>                            
                                    <th>No Telp</th>         
                                    <th>Kode Pos</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Total Surat Jalan</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach($data_pelanggan as $res) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $res->nama;?></td> 
                                    <td><?php echo $res->alamat;?></td>                                  
                                    <td><?php echo $res->no_telp;?></td>                                  
                                    <td><?php echo $res->kode_pos;?></td>                                  
                                    <td><?php echo format_rupiah($res->total);?></td>                                  
                                    <td align="center"><span class="btn btn-primary btn-xs"><?php echo $res->jum_tagihan ?></span></td>                                  
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/Kelola_pengiriman/tagihan_pelanggan/'.$res->pelanggan_id.'') ?>" class="btn btn-info btn-xs"> <span class="fa fa-list"></span> Tagihan</a> 
                                        
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
<script>
    $(document).ready(function(){
     
     $('#table-tagihan').DataTable({

     });

    });
</script>
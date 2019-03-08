<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <ol class="breadcrumb left">
        <li class="active"> <i class="fa fa-money"></i> Edit Kas </li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <div class="row">
            <div class="col-md-12">
                <div class="box box-red">
                    <div class="box-header with-border">
                        <h3 class="box-title">Buku Kas</h3>
                        <div class="box-tools pull-right">
                                               
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="<?= base_url('admin/Kelola_keuangan/simpan_edit') ?>" method="post" accept-charset="utf-8">
                                <input type="hidden" name="id" value="<?= $edit_kas->id ?>">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label"><strong>Tanggal</strong></label>
                                        <div class="datepicker input-group date">
                                            <input style="text-align : center" type="text" class="form-control" id="tanggal" name="tanggal" required="" value="<?php echo $edit_kas->tanggal ?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label"><strong>Keterangan</strong></label>
                                        <select name="keterangan" class="form-control">
                                            <?php if ($edit_kas->jenis == 'KREDIT'): ?>
                                                    <option value="KREDIT" selected>KREDIT</option>
                                                    <option value="DEBIT">DEBIT</option>   
                                                <?php else: ?>
                                                    <option value="KREDIT">KREDIT</option>
                                                    <option value="DEBIT" selected>DEBIT</option>
                                            <?php endif ?>
                                             
                                         </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control"  required=""><?= $edit_kas->deskripsi ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="">Nominal (Rp)</label>
                                        <input type="number" name="nominal" required="" value="<?= $edit_kas->nominal ?>" class="form-control">
                                    </div>    
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                         <br> <br> <br> <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-info">Reset</button>
                                    </div>    
                                </div>
                            </form>
                            </div>
                            
                        </div>
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

<?php $this->load->view('admin/layout/footer'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>">
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.datepicker').datepicker({
              autoclose: true,
              format: "yyyy-mm-dd",
              todayHighlight: true,
              orientation: "top auto",
              todayBtn: true,
              todayHighlight: true,
          });

    } );
</script>

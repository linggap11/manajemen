<style type="text/css" media="screen">
    th {
        text-align: center;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb left">
        <li class="active"> <i class="fa fa-money"></i> Buku Kas </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-red">
                    <div class="box-header with-border">
                        <h3 class="box-title">Buku Kas</h3>
                    <div class="box-body">
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_transaksi"><i class="fa fa-plus"></i> TAMBAH TRANSAKSI</button>
                        <div class="table-responsive">
                        <table id="table-kas" class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="10%">TANGGAL</th>
                                <th width="45%">DESKRIPSI</th>
                                <th>DEBIT</th>
                                <th>KREDIT</th>
                                <th>SALDO</th>
                                <th width="5%">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $total_kredit = 0; $total_debit = 0;?>
                            <?php foreach ($data_kas as $kas): ?>
                                <tr>
                                    <td align="center"><?= $no++ ?></td>
                                    <td align="center"><?= date("d-M-y", strtotime($kas->tanggal)) ?></td>
                                    <td><?= $kas->deskripsi ?></td>
                                    <?php if ($kas->jenis == 'KREDIT'): ?>
                                            <td><?= format_rupiah($kas->nominal) ?></td>
                                            <td>-</td>
                                            <?php $total_kredit = $total_kredit + $kas->nominal ?>
                                        <?php else: ?>
                                            <td>-</td>
                                            <td><?= format_rupiah($kas->nominal) ?></td>
                                            <?php $total_debit = $total_debit + $kas->nominal ?>
                                    <?php endif ?>
                                    <td><?= format_rupiah($kas->total) ?></td>
                                    <td align="center"><a href="<?= base_url('admin/Kelola_keuangan/ubah_kas/'.$kas->id.'') ?>" title="Edit Kas"><span class="fa fa-pencil-square-o"></span></a></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">TOTAL</th>
                                    <th align="left"><?= format_rupiah($total_kredit) ?></th>
                                    <th align="left"><?= format_rupiah($total_debit) ?></th>
                                    <th align="left"><?= format_rupiah($total_kredit - $total_debit) ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
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
<!-- modal -->
<div class="modal fade" id="tambah_transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><center>TAMBAH TRANSAKSI</center></h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <form action="<?= base_url('admin/Kelola_keuangan/tambah_kas') ?>" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label"><strong>Tanggal</strong></label>
                        <div class="datepicker input-group date">
                            <input style="text-align : center" type="text" class="form-control" id="tanggal" name="tanggal" required="" value="<?php echo(date("Y-m-d")); ?>">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label"><strong>Keterangan</strong></label>
                        <select name="keterangan" class="form-control" style="margin-top: 4px;">
                             <option value="KREDIT">KREDIT</option>
                             <option value="DEBIT">DEBIT</option>
                         </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"  required=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Nominal (Rp)</label>
                        <input type="number" name="nominal" required="" class="form-control">
                    </div>
                </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Setujui</button>
        <button type="reset" class="btn btn-info">Reset</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>">
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table-kas').dataTable( {
            fixedHeader: {
                header: true,
                footer: true
            },
            "iDisplayLength": 25,
            "ordering": false
        } );

        table.fnPageChange('last');

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

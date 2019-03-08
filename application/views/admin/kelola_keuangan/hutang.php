<style type="text/css" media="screen">
    th {
        text-align: center;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <ol class="breadcrumb left">
        <li class="active"> <i class="fa fa-money"></i> Buku Hutang </li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <div class="row">
            <div class="col-md-12">
                <div class="box box-red">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Hutang </h3>
                    </div>
                    <div class="box-body">
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_transaksi"><i class="fa fa-plus"></i> TAMBAH TRANSAKSI</button>
                        <div class="table-responsive">
                        <table id="table-hutang" class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="5%">NO</th> 
                                <th>TGL MASUK</th>                             
                                <th>TGL HUTANG</th>                             
                                <th>NO PIUTANG</th>                             
                                <th>DESKRIPSI</th>   
                                <th>DEBIT</th>                             
                                <th>KREDIT</th>                                                                                    
                                <th>SALDO</th>                            
                                <th>KETERANGAN</th>                            
                                <th width="10%">PEMBAYARAN</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $total_kredit = 0; $total_debit = 0;?>
                            <?php foreach ($data_hutang as $hutang): ?>
                                <tr>
                                    <td align="center"><?= $no++ ?></td>
                                    <td align="center"><?= date("d-M-y", strtotime($hutang->tanggal_masuk)) ?></td>
                                    <td align="center"><?= date("d-M-y", strtotime($hutang->tanggal_hutang)) ?></td>
                                    <td align="center"><?= $hutang->no_piutang ?></td>
                                    <td><?= $hutang->deskripsi ?></td>
                                    <?php if ($hutang->keterangan == 'KREDIT'): ?>
                                            <td><?= format_rupiah($hutang->nominal) ?></td>
                                            <td>-</td>
                                            <?php $total_kredit = $total_kredit + $hutang->nominal ?>
                                        <?php else: ?>
                                            <td>-</td>
                                            <td><?= format_rupiah($hutang->nominal) ?></td> 
                                            <?php $total_debit = $total_debit + $hutang->nominal ?>
                                    <?php endif ?>
                                    <td><?= format_rupiah($hutang->saldo) ?></td>
                                    <td><?= $hutang->status ?></td>
                                    <td align="center">
                                        <?php if ($hutang->lunas == 'YA'): ?>
                                            <button class="pembayaran btn btn-secondary btn-xs" data-id="<?= $hutang->no_piutang ?>" title="Pembayaran"><span class="fa fa-pencil-square-o"></span> PEMBAYARAN</button>
                                            <?php else: ?>
                                            <button class="pembayaran btn btn-danger btn-xs" data-id="<?= $hutang->no_piutang ?>" title="Pembayaran"><span class="fa fa-pencil-square-o"></span> PEMBAYARAN</button>
                                        <?php endif ?>
                                    </td>
                                </tr>    
                            <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>                            
                                    <th colspan="5">TOTAL</th>                            
                                    <th align="left"><?= format_rupiah($total_kredit) ?></th>                            
                                    <th align="left"><?= format_rupiah($total_debit) ?></th>                            
                                    <th align="left"><?= format_rupiah($total_kredit - $total_debit) ?></th>
                                    <th colspan="2"></th>
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
<div class="modal fade" id="pembayaranModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><center>PEMBAYARAN NO PIUTANG : <span id="piutang"></span></center></h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <form action="<?= base_url('admin/Kelola_keuangan/pembayaran_hutang') ?>" method="post" onsubmit="return cek_pembayaran()" accept-charset="utf-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">HUTANG <i><span id="title"></i></strong><input type="hidden" name="deskripsi" id="deskripsi" value=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tanggal</td>
                            <td><input style="text-align : center" type="text" class="datepicker form-control" readonly="" id="tanggal" name="tanggal" required="" value="<?php echo(date("Y-m-d")); ?>">
                                <input type="hidden" name="tanggal_hutang" id="tanggal_hutang" value=""></td>
                        </tr>
                        <tr>
                            <td>Jumlah Hutang</td>
                            <td><input type="text" id="jumlah_hutangrp" readonly="" required="" class="form-control"><input type="hidden" id="jumlah_hutang" readonly="" name="jumlah_hutang" required="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Yang Dibayarkan</td>
                            <td><input type="number" id="jumlah_bayar" onkeyup="bayar()" name="jumlah_bayar" required="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Sisa</td>
                            <td><input type="text" name="sisa" id="sisa" readonly class="form-control">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="kas_id" id="kas_id" value="">
                        <input type="hidden" name="sisa_bayar" id="sisa_bayar" value=""></td>
                        </tr>
                    </tbody>
                </table>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Setujui</button>
      </div>
      </form>
    </div>
  </div>
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
            <form action="<?= base_url('admin/Kelola_keuangan/tambah_hutang') ?>" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label"><strong>Tanggal</strong></label>
                        <div class="datepicker input-group date">
                            <input style="text-align : center" type="text" class="form-control" id="tanggal" name="tanggal" required="" value="<?php echo(date("Y-m-d")); ?>">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div> 
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
        var table = $('#table-hutang').dataTable( {
            fixedHeader: {
                header: true,
                footer: true
            },
            "iDisplayLength": 10,
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

        $('#select-bulan').on('change', function(){
          if($(this).find(':selected').data('bulan') != ''){
            var bulan = $(this).find(':selected').data('bulan');
            var tahun = $(this).find(':selected').data('tahun'); 
            window.location.replace(BASE_URL + 'admin/Kelola_keuangan/kas_by/' + bulan + '/' + tahun);
          }else{
            window.location.replace(BASE_URL + 'admin/Kelola_keuangan/kas_by');
          }
        }); 

        $('#select-tahun').on('change', function(){
          if($(this).find(':selected').data('bulan') != ''){ 
            var tahun = $(this).find(':selected').data('tahun'); 
            window.location.replace(BASE_URL + 'admin/Kelola_keuangan/kas_by/all/' + tahun);
          }else{
            window.location.replace(BASE_URL + 'admin/Kelola_keuangan/kas_by');
          }
        }); 

        

    } );

    $('.pembayaran').click(function() {
        var no_piutang = $(this).data('id');
        $.get('<?php echo base_url() ?>admin/Kelola_keuangan/get_data_hutang/'+no_piutang, function(respon) {
            var data = JSON.parse(respon);
            $('#piutang').html(data.no_piutang);
            $('#tanggal_hutang').val(data.tanggal_hutang);
            $('#deskripsi').html(data.deskripsi);
            $('#title').html(data.deskripsi);
            $('#sisa_bayar').val(data.sisa_bayar);
            $('#jumlah_bayar').prop({
                min: '0',
                max: data.sisa_bayar,
            });
            $('#jumlah_hutangrp').val(convertToRupiah(data.jumlah_hutang));
            $('#jumlah_hutang').val(data.jumlah_hutang);
            $('#sisa').val(convertToRupiah(data.sisa_bayar));
            $('#id').val(data.id);
            $('#kas_id').val(data.kas_id);
            if (data.status == 'LUNAS') {
                $('#jumlah_bayar').val(0);
                $('#jumlah_bayar').prop('readonly', true);
            } else {
                $('#jumlah_bayar').prop('readonly', false);
            }
        });
        $('#pembayaranModal').modal('show');
    });

    

    $('#close').click(function() {
        $('#table_detail').find('tbody').empty();
    });
    function bayar() {
        var jumlah_bayar = parseInt($('#jumlah_bayar').val());
        var hutang = convertToAngka($('#jumlah_hutang').val());
        var sisa = convertToAngka($('#sisa_bayar').val());
        var temp = hutang - sisa; // baru bayar

        if (isNaN(jumlah_bayar)) {
            jumlah_bayar = 0;
        }
        if (jumlah_bayar > sisa || jumlah_bayar < 0) {
            alert('Jumlah Melibihi Sisa Pembayaran');
            jumlah_bayar = sisa;
            $('#jumlah_bayar').val(sisa);
        } 
        sisa = hutang - (jumlah_bayar + temp);
        $('#sisa').val(sisa);
    }


    function convertToRupiah(angka) {
        var rupiah = '';        
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
    }

    function convertToAngka(rupiah) {
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    }

    function cek_pembayaran() {
        if ($('#jumlah_bayar').val() == 0 || $('#jumlah_bayar').val() == "")  {            
            alert('Jumlah Bayar Tidak Boleh Kosong');            
            return false;
        } else {
            return true;
        }
        
    }

    $('#detailPiutang').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    })


</script>

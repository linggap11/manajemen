<style type="text/css" media="screen">
    th {
        text-align: center;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <ol class="breadcrumb left">
        <li class="active"> <i class="fa fa-money"></i> PIUTANG </li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <div class="row">
            <div class="col-md-12">
                <div class="box box-red">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Piutang </h3>
                    </div>
                    <div class="box-body">
                        <br>

                        <div class="table-responsive">
                        <table id="table-kas" class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="5%">NO</th> 
                                <th>TANGGAL MASUK</th>                                      
                                <th>NO PIUTANG</th>                            
                                <th>PELANGGAN</th>         
                                <th>DEBIT</th>                               
                                <th>KREDIT</th>                          
                                <th>SALDO</th>                            
                                <th>KETERANGAN</th>                            
                                <th width="10%">PEMBAYARAN</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $total_kredit = 0; $total_debit = 0;?>
                            <?php foreach ($data_piutang as $piutang): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td align="center"><?= date("d-M-y", strtotime($piutang->tanggal)) ?></td>
                                    <td><?= $piutang->no_piutang ?></td>
                                    <td><?= $piutang->nama ?></td>
                                    <?php if ($piutang->jenis == 'KREDIT'): ?>
                                            <td><?= format_rupiah($piutang->jumlah_bayar) ?></td>
                                            <td>-</td>
                                            <?php $total_kredit = $total_kredit + $piutang->jumlah_bayar ?>
                                        <?php else: ?>
                                            <td>-</td>
                                            <td><?= format_rupiah($piutang->jumlah_bayar) ?></td> 
                                            <?php $total_debit = $total_debit + $piutang->jumlah_bayar ?>
                                    <?php endif ?>
                                    <td><?= format_rupiah($piutang->saldo) ?></td>
                                    <td><?= $piutang->keterangan ?></td>
                                    <td align="center">
                                        <button class="pembayaran btn btn-secondary btn-xs" data-id="<?= $piutang->no_piutang ?>" title="Pembayaran"><span class="fa fa-pencil-square-o"></span></button>
                                        <button class="detail btn btn-info btn-xs" data-id="<?= $piutang->no_piutang ?>" title="Detail Piutang">Detail</button>
                                    </td>
                                </tr>    
                            <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>                            
                                    <th colspan="4">TOTAL</th>                            
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
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><center>PEMBAYARAN PELANGGAN : <span id="pelanggan"></span></center></h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <form action="<?= base_url('admin/Kelola_keuangan/pembayaran') ?>" method="post" onsubmit="return cek_pembayaran()" accept-charset="utf-8">
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
                        <select name="jenis" id="jenis" class="form-control" style="margin-top: 4px;">
                             <option value="DEBIT" selected="selected">DEBIT</option>                     
                         </select> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Jumlah Piutang</label>
                        <input type="text" id="jumlah_piutangrp" readonly="" required="" class="form-control">
                        <input type="hidden" id="jumlah_piutang" readonly="" name="jumlah_piutang" required="" class="form-control">

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Jumlah Bayar</label>
                        <input type="number" id="jumlah_bayar" onkeyup="bayar()" name="jumlah_bayar" required="" class="form-control">
                    </div>    
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Sisa</label>
                        <input type="text" name="sisa" id="sisa" readonly class="form-control">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="sisa_bayar" id="sisa_bayar" value="">
                    </div>    
                </div>
            
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
<div class="modal fade" id="detailPiutang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><center><strong>DETAIL PIUTANG <i class="pelanggan"></i> </strong></center></h5>
      </div>
      <div class="modal-body">
        <table id="table_detail" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Surat Jalan</th>
                    <th>Deskripsi</th>
                    <th>Berat (Kg)</th>
                    <th>Harga Produk</th>
                    <th>Total</th>
                    <th>Detail SJ</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="" target="_blank" id="print_invoice" class="btn btn-warning">Print</a>
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
        $.get('<?php echo base_url() ?>admin/Kelola_keuangan/get_data_piutang/'+no_piutang, function(respon) {
            var data = JSON.parse(respon);
            $('#pelanggan').html(data.nama);
            $('#sisa_bayar').val(data.sisa_bayar);
            $('#jumlah_bayar').prop({
                min: '0',
                max: data.sisa_bayar,
            });
            $('#jumlah_piutangrp').val(convertToRupiah(data.jumlah_piutang));
            $('#jumlah_piutang').val(data.jumlah_piutang);
            $('#sisa').val(convertToRupiah(data.sisa_bayar));
            $('#id').val(data.id);
            if (data.keterangan == 'LUNAS') {
                $('#jumlah_bayar').val(0);
                $('#jumlah_bayar').prop('readonly', true);
            } else {
                $('#jumlah_bayar').prop('readonly', false);
            }
        });
        $('#pembayaranModal').modal('show');
    });

    $('.detail').click(function() {
        var id = $(this).data('id');
        $.get('<?php echo base_url() ?>admin/Kelola_keuangan/get_detail_piutang/'+id, function(respon) {
            var data = JSON.parse(respon);
            var no = 1;
            $('.pelanggan').html(data[0].nama);
            $('#print_invoice').attr({
                'href': '<?= base_url('admin/Kelola_keuangan/print_invoice_by_piutang/')?>'+id
            });
            for (var i = 0; i < data.length; i++) {
                $('#table_detail').find('tbody').append("<tr><td>"+no+"</td><td>"+data[i].no_pengiriman+"</td><td>"+data[i].deskripsi+"</td><td>"+data[i].berat+"</td><td>"+convertToRupiah(data[i].harga)+"</td><td>"+convertToRupiah(data[i].total)+"</td><td align='center'><a href='<?= base_url('admin/Kelola_pengiriman/print_surat_jalan/') ?>"+data[i].no_pengiriman+"' title='SJ "+data[i].no_pengiriman+"' target='_blank' class='btn btn-success btn-xs'>Lihat</a></td></tr>");    
                no++;
            }    
        });
        $('#detailPiutang').modal('show');
    });

    $('#close').click(function() {
        $('#table_detail').find('tbody').empty();
    });
    function bayar() {
        var jumlah_bayar = parseInt($('#jumlah_bayar').val());
        var piutang = convertToAngka($('#jumlah_piutang').val());
        var sisa = convertToAngka($('#sisa_bayar').val());
        var temp = piutang - sisa; // baru bayar

        if (isNaN(jumlah_bayar)) {
            jumlah_bayar = 0;
        }
        if (jumlah_bayar > sisa || jumlah_bayar < 0) {
            alert('Jumlah Melibihi Sisa Pembayaran');
            jumlah_bayar = sisa;
            $('#jumlah_bayar').val(sisa);
        } 
        sisa = piutang - (jumlah_bayar + temp);
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

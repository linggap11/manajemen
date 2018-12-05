    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            
            <ol class="breadcrumb left">
              <li><a href="<?php  echo base_url('admin/kelola_produk') ?>"><i class="fa fa-users"></i> List Sales</a></li> 
              <li class="active">Tambah Produk</li>
            </ol>

        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-red">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Produk</h3>
                        </div><!-- /.box-header -->
                        <form class="form" action="<?php echo site_url('admin/kelola_produk/tambah');?>" method="post">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <h6>Data Produk</h6>
                              <div class="form-group <?php echo (form_error('nama')) ? 'has-error' : '';?>">
                                <label for="inputNama" class="control-label">Nama</label> 
                                <input class="form-control" type="text" name="nama" value="<?php echo set_value('nama'); ?>">
                                <?php echo (form_error('nama')) ? '<span class="help-block">' . form_error('nama') . '</span>' : '';?> 
                              </div> 
                              <div class="form-group">
                                 <label for="" class="control-label">Deskripsi Produk</label> 
                                 <textarea class="form-control" name="deskripsi"></textarea>  
                              </div>
                              <div class="form-group">
                                 <label for="" class="control-label">Harga Produk (Rp. )</label> 
                                 <input type="text" name="harga" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Harga Produk">  
                              </div> <!-- end col -->

                            </div><!-- end col -->
                            <div class="col-md-5"> 
                            <h6>Data Pelanggan</h6> 
                              <div class="col-md-12" style="display: block" id="pelanggan_lama">
                                <table id="tabelProduknya" class="table table-hover table-bordered">
                                  <thead class="cf">
                                    <tr>
                                      <th style="width:35%" align="center">Pelanggan</th>
                                    </tr></thead>
                                  <tbody id="tbody_stok">
                                    <tr id="tr1">
                                      <td data-title="Produk*">
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                          <select id="search_pelanggan1" onchange="cari_pelanggan(1)" class="form-control btn-block" style="">                                            
                                            <?php if (count($data_pelanggan) > 0): ?>
                                                <option value="">Pilih Pelanggan</option>
                                                <?php foreach ($data_pelanggan as $row): ?>
                                                  <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                                <?php endforeach ?>
                                              <?php else: ?>
                                                <option value="">Tidak Ada Pelanggan</option>
                                            <?php endif ?>

                                          </select>
                                        </div>
                                        <input type="hidden" class="pelanggan form-control" id="pelanggan_id1" name="pelanggan_id">

                                      </td>
                                     <!--  <td align="center">
                                        <a href="javascript:void(0);" onclick="T_removeElement_awal();" class="btn btn-danger" id="del_row1">
                                        <i class="glyphicon glyphicon-minus"></i>
                                        </a>
                                      </td> -->
                                  </tr>
                                </tbody>
                              </table>
                               <button class="btn btn-primary pull-right" type="submit" name="submit" value="save"><i class="fa fa-save"></i> Tambah Produk</button>
                              <!-- <div class="form-group col-md-12"><button type="button" class="badge progress-bar-warning" onclick="addPelanggan();" id="add_rowProduk"><i class="glyphicon glyphicon-plus"></i> Tambah Produk Lain</button></div>  -->
                              </div>
                              
                              <!-- <div class="col-md-12" style="display: none" id="pelanggan_baru">
                                <div class="form-group">
                                 <label for="inputNama" class="control-label">Nama Pelanggan</label> 
                                 <input class="form-control" type="text" name="nama_pelanggan">
                              </div> 
                              <div class="form-group">
                                 <label for="" class="control-label">No Telp</label> 
                                 <input class="form-control" type="text" name="telp_pelanggan">
                              </div> 
                              <div class="form-group">
                                 <label for="inputNama" class="control-label">Alamat</label> 
                                 <textarea name="alamat_pelanggan" class="form-control"></textarea>
                              </div> 
                              
                              <div class="form-group">
                                 <label for="" class="control-label">Kode Pos</label> 
                                 <input class="form-control" type="text" name="kode_pos">
                              </div> 
                              </div> -->
                              <div class="form-group">
                                
                              </div>
                            </div>
                               
                             
                          </div><!-- end row -->
  
                        </div><!-- /.box-body -->
                        <div class="box-footer c">
                            
                        </div><!-- box-footer -->
                    </form>
                    </div><!-- /.box -->
        <a href="<?php  echo base_url('admin/kelola_produk') ?>" class="btn btn-xs btn-default" href=""><i class="fa fa-long-arrow-left"></i> Kembali Ke list Produk</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('admin/layout/footer'); ?>
 <script type="text/javascript">
   $(document).ready(function() {

   });
   function showPelanggan(i) {
    if ($('#pilih_pelanggan'+i).val() == 'lama') {
      $('#search_pelanggan'+i).prop('disabled', false);
      $("#pelanggan_lama").css("display", "block");
      $("#pelanggan_baru").css("display", "none");
    } else {
      $("#pelanggan_lama").css("display", "none");
      $("#pelanggan_baru").css("display", "block");
      $('#search_pelanggan'+i).prop('disabled', true);
    }
  }
  var count_id = 1;

  function T_removeElement_awal() {
    if($('#tbody_stok').children('tr').length > 1) {
      document.getElementById('tbody_stok').removeChild(document.getElementById('tr1'));
    } else {
      alert("Tidak Ada Form Yang Di Hapus ");
    }
  }

  function T_removeElement(i) {
    if($('#tbody_stok').children('tr').length > 1) {
      document.getElementById('tbody_stok').removeChild(document.getElementById('tr' + i));
      count_id--;
    } else {
      alert("Tidak Ada Form Yang Di Hapus ");
    }
  }
  function addPelanggan() {
    count_id++;

    $('#tbody_stok').append('<tr id="tr'+count_id+'"> <td align="center" data-title="#">'+count_id+'</td><td data-title="Pelanggan*"> <div class="input-group"> <span class="input-group-addon"><i class="fa fa-search"></i></span> <select id="search_pelanggan'+count_id+'" onchange="cari_pelanggan('+count_id+')" class="form-control" style=""> <option value="">Pilih Pelanggan</option> <?php foreach ($data_pelanggan as $row): ?> <option value="<?=$row->id ?>"><?=$row->nama ?></option> <?php endforeach ?> </select> </div><input type="hidden" class="form-control" id="pelanggan_id'+count_id+'" name="pelanggan_id[]"> </td><td align="center"> <a href="javascript:void(0);" onclick="T_removeElement('+count_id+');" class="btn btn-danger" id="del_row1"> <i class="glyphicon glyphicon-minus"></i> </a> </td></tr>')
  }


  function cari_pelanggan(i) {
    var id = $('#search_pelanggan'+i).val()
     $('#pelanggan_id'+i).val(id);
  }
 </script>
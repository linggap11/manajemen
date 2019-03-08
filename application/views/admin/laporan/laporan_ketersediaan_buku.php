<?php $this->load->view('admin/_template/css') ?>
<style type="text/css" media="screen">
  th {
    text-align: center; border-right: 2px solid #dddddd;
    border: bo
  }
  td {
    border-right: 2px solid #dddddd; 
  }
</style>

<?php $this->load->view('admin/_template/header') ?>
<div class="page-body">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Sample Page
                        <small>Universal Admin panel</small>
                    </h3>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Sample Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends -->
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Ketersediaan Buku Saat Ini</h5>
                        <span>Berikut adalah data buku yang tersedia di perpustakaan saat ini (belum dipinjam)</span>
                    </div>
                    <div class="card-body">
                      <div class="row">    
                        <div class="col-sm-6 col-sm-8">
                            <div class="input-group">
                                <div class="input-group-btn search-panel">
                                    <select name="" class="form-control digits">
                                        <option value="">Dari Bulan</option>
                                        <option value="">Januari</option>
                                        <option value="">Februari</option>
                                        <option value="">Maret</option>
                                        
                                    </select>
                                </div>
                                <div class="input-group-btn search-panel">
                                    <select name="" class="form-control digits">
                                        <option value="">Tahun</option>
                                        <option value="">2017</option>
                                        <option value="">2016</option>
                                        <option value="">2015</option>
                                        
                                    </select>
                                </div>
                                &nbsp;&nbsp;
                                <button type="" class="btn btn-primary" data-toggle="modal" data-target="#tambah_dataModal" data-whatever="@mdo"><i class="icofont icofont-printer"></i>&nbsp; Cetak</button>
                            </div>
                        </div>
                        </div>
                         
                          
                        <div class="table-responsive">
                            <table id="data_buku" class="display">
                                <thead>
                                    <tr>
                                     <th rowspan="2" width="5%">No</th>
                                     <th colspan="3">Title</th>
                                     <th colspan="3">Publisher</th>
                                     <th rowspan="2" width="15%">Aksi</th>
                                    </tr>
                                    <tr>
                                      <th>ISBN</th>
                                      <th>Judul</th>
                                      <th width="5%">Edisi</th>
                                      <th>Pengarang</th>
                                      <th>Penerbit</th>
                                      <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $no=1; ?>
                                  <?php foreach ($daftar_buku as $buku): ?>
                                    <tr>
                                      <td><?= $no++ ?></td>
                                      <td><?= $buku->isbn ?></td>
                                      <td><?= $buku->judul ?></td>
                                      <td align="center"><?= $buku->edisi ?></td>
                                      <td><?= $buku->pengarang ?></td>
                                      <td><?= $buku->penerbit ?></td>
                                      <td><?= $buku->tahun_terbit ?></td>
                                      <td align="center"><a href="#" title="Detail Buku" class="btn btn-info btn-xs">Detail</a></td>
                                    </tr>
                                  <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>                                                                                                  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts -->.
</div>
<?php $this->load->view('admin/_template/js') ?>

<?php $this->load->view('admin/_template/footer') ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#data_buku').DataTable({
      "bLengthChange": false,
      "pageLength": 25,
      "columnDefs": [ {
        
        } ]
    });
  });

</script>
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
                    
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Anggota</li>
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
                        <h5>Data Anggota</h5>
                        <span>Data Anggota Yang Telah Terdaftar Di Perpustakaan </span>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-6 col-sm-8">
                            <div class="input-group">
                                <div class="input-group-btn search-panel">
                                    <select name="" class="form-control digits">
                                        <option value="">Bulan Masuk</option>
                                        <option value="">Januari</option>
                                        <option value="">Februari</option>
                                        <option value="">Maret</option>
                                        
                                    </select>
                                </div>
                                <div class="input-group-btn search-panel">
                                    <select name="" class="form-control digits">
                                        <option value="">Tahun Masuk</option>
                                        <option value="">2017</option>
                                        <option value="">2016</option>
                                        <option value="">2015</option>
                                        
                                    </select>
                                </div>
                                <div class="input-group-btn search-panel">
                                    <select name="" class="form-control digits">
                                        <option value="">Status</option>
                                        <option value="">Aktif</option>
                                        <option value="">Tidak Aktif</option>
                                        
                                    </select>
                                </div>
                                &nbsp;&nbsp;
                                <button type="" class="btn btn-primary" data-toggle="modal" data-target="#tambah_dataModal" data-whatever="@mdo"><i class="icofont icofont-printer"></i>&nbsp; Cetak</button>
                            </div>
                        </div><br><br><br><br>
                       <div class="table-responsive">
                            <table id="table_anggota" class="display">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Lengkap</th>
                                        <th width="">Email</th>
                                        <th width="">Kelas</th>
                                        <th width="">No Telp</th>
                                        <th width="30%">Alamat Rumah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        for ($i = 1; $i < 200; $i++) {
                                            ?>
                                            <tr>
                                        <td><?= $i ?></td>
                                        <td>John Doe <?= $i ?></td>
                                        <td>email@email.com</td>
                                        <td>Kelas XYZ</td>
                                        <td>02223213</td>
                                        <td>Jalan abcdefghijabcdefghijabcdefghij </td>
                                        <?php if ($i % 3 == 0): ?>
                                            <td align="center"><span class="btn btn-danger btn-xs">Tidak Aktif</span></td>
                                        <?php else: ?>
                                            <td align="center"><span class="btn btn-success btn-xs">Aktif</span></td>
                                        <?php endif ?>
                                        <td><a href="#" title="Detail Anggota" class="btn btn-primary btn-xs"><i class="fa fa-info-circle"> </i> Detail</a></td>
                                    </tr>
                                            <?php
                                        }
                                     ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts -->
    <div class="modal fade" id="tambah_dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >Kode Anggota:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="" Value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >Nama Anggota:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="" Value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >Email:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="" Value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >Kelas:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="" Value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >No Telp:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="" Value="">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Alamat:</label>
                        <textarea class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >Username:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="" Value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >Password:</label>
                        <input type="password" class="form-control" id="recipient-name" placeholder="" Value="" placeholder="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
  </div>
</div>
<?php $this->load->view('admin/_template/js') ?>
<?php $this->load->view('admin/_template/footer') ?>
<script type="text/javascript">
    $('#table_anggota').DataTable({

    });
</script>

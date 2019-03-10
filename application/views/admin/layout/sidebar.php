
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left info">
          <p><i class="fa fa-user-circle"></i> <?php echo $this->model_admin->getNama($this->session->admin_id); ?></p>
          <a href="<?php echo site_url('admin/kelola_admin/edit/') . $this->session->admin_id ?>"><i class="fa fa-gear text-green"></i> Kelola profil</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu tree">

        <li <?php echo ($menu == 'dashboard') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/dashboard' . get_url_cache()) ?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

        <li <?php echo ($menu == 'kelola_admin') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/kelola_admin' . get_url_cache()) ?>"><i class="fa fa-user-secret"></i> <span>Kelola Admin</span></a></li>


        <li <?php echo ($menu == 'kelola_sales') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/kelola_sales' . get_url_cache()) ?>"><i class="fa fa-address-book"></i> <span>Kelola <S></S>Sales</span></a></li>

        <li <?php echo ($menu == 'kelola_produk') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/kelola_produk' . get_url_cache()) ?>"><i class="fa fa-list"></i> <span>Kelola Produk</span></a></li>

        <li <?php echo ($menu == 'kelola_pelanggan') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/kelola_pelanggan' . get_url_cache()) ?>"><i class="fa fa-users"></i> <span>Kelola Pelanggan</span></a></li>

        <li class="treeview <?php echo ($menu == 'pengiriman' || $menu == 'tagihan') ? 'active' : '';?>">
         <a href="#">
           <i class="fa fa-truck"></i> <span>Kelola Pengiriman</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">

           <li <?php echo ($menu == 'pengiriman') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/kelola_pengiriman' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Pengiriman</span></a></li>
           <li <?php echo ($menu == 'tagihan') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/kelola_pengiriman/penagihan' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Penagihan</span></a></li>
         </ul>
       </li>
        <li class="treeview <?php echo ($menu == 'buku_kas' || $menu == 'piutang' || $menu == 'hutang') ? 'active' : '';?>">
         <a href="#">
           <i class="fa fa-money"></i> <span>Laporan Keuangan</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">

           <li <?php echo ($menu == 'buku_kas') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/Kelola_keuangan/buku_kas' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Buku Kas</span></a></li>
           <li <?php echo ($menu == 'piutang') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/Kelola_keuangan/piutang' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Piutang</span></a></li>
           <li <?php echo ($menu == 'hutang') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/Kelola_keuangan/buku_hutang' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Buku Hutang</span></a></li>
         </ul>
       </li>
         <li class="treeview <?php echo ($menu == 'laporan_pengiriman' || $menu == 'laporan_pemesanan' || $menu == 'laporan_tagihan') ? 'active' : '';?>">
         <a href="#">
           <i class="fa fa-file"></i> <span>Kelola Laporan</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">

           <li <?php echo ($menu == 'laporan_pengiriman') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/Laporan/laporan_pengiriman' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Laporan Pengiriman</span></a></li>
           <li <?php echo ($menu == 'laporan_pemesanan') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/Laporan/laporan_pemesanan' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Laporan Pemesanan</span></a></li>
           <li <?php echo ($menu == 'laporan_tagihan') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/Laporan/laporan_tagihan' . get_url_cache()) ?>"><i class="fa fa-circle"></i> <span>Laporan Penagihan</span></a></li>
         </ul>
       </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

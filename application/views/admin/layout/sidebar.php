
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

        <li <?php echo ($menu == 'kelola_pengiriman') ? 'class="active"' : '';?>><a href="<?php echo site_url('admin/kelola_pengiriman' . get_url_cache()) ?>"><i class="fa fa-money"></i> <span>Kelola Pengiriman</span></a></li> 

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
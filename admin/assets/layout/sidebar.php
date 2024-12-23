<!-- Sidebar -->
<?php
  if (isset($_GET['menu'])) {
    $menu=$_GET['menu'];
  }else{
    $menu='';
  }

  switch ($menu) {
    case 'dashboard':
      $showPenyewaan='collapse';
      $showPengembalian='collapse';      
      // $showPengadaan='collapse';  
      $statusDashboard='active';
      break;

    case 'barang':
      $showPenyewaan='collapse';
      $showPengembalian='collapse'; 
      // $showPengadaan='collapse'; 
      $statusBarang='active';
      break;

    case 'penyewaan':
      $showPenyewaan='collapse show';      
      $statusPenyewaan='active';
      $statuslaporanPenyewaan='';
      // $showPengadaan='collapse';
      $showPengembalian='collapse';
      break;

    case 'laporanPenyewaan':
      $showPenyewaan='collapse show';  
      // $showPengadaan='collapse';
      $showPengembalian='collapse';   
      $statuslaporanPenyewaan='active';
      break;

    case 'pengembalian':
      $showPenyewaan='collapse';
      // $showPengadaan='collapse';
      $showPengembalian='collapse show';  
      $statusPengembalian='active';   
      $statuslaporanPengembalian='';
      break;
      
    case 'laporanPengembalian':
      $showPenyewaan='collapse';
      // $showPengadaan='collapse';
      $showPengembalian='collapse show';  
      $statusPengembalian='';   
      $statuslaporanPengembalian='active';
      break;

    // case 'Pengadaan':
    //   $showPenyewaan='collapse';
    //   $showPengembalian='collapse';
    //   $showPengadaan='collapse show';  
    //   $statusPengadaan='active';   
    //   $statuslaporanPengadaan='';
    //   break;
      
    // case 'laporanPengadaan':
    //   $showPenyewaan='collapse';
    //   $showPengembalian='collapse';
    //   $showPengadaan='collapse show';  
    //   $statusPengadaan='';   
    //   $statuslaporanPengadaan='active';
    //   break;

    // case 'notaPengadaan':
    //   $showPenyewaan='collapse';
    //   $showPengembalian='collapse';
    //   $showPengadaan='collapse show';  
    //   $statusPengadaan='';   
    //   $statuslaporanPengadaan='';
    //   $statusNotaPengadaan='active';
    //   break;

    default:
        $statusPenyewaan='';
        $showPenyewaan='collapse';
        $showPengembalian='collapse';
        // $showPengadaan='collapse';
      break;
  }
?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
        <div class="sidebar-brand-text mx-3">KamiKamera</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?=$statusDashboard;?>">
        <a class="nav-link" href="index?menu=dashboard">
          <i class="fas fa-fw fa-tachometer-alt text-light"></i>
          <span class="text-light">Dashboard</span></a>
      </li>

      <!-- Heading
      <div class="sidebar-heading text-light">
        Barang
      </div> -->

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?=$statusBarang;?>">
        <a class="nav-link" href="barang-sewa?menu=barang">
          <i class="fas fa-fw fa-campground text-light"></i>
          <span class="text-light">Barang Sewa</span></a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item <?=$statusPenyewaan;?> <?=$statuslaporanPenyewaan;?>">
        <a class="nav-link collapsed" href="?menu=penyewaan" data-toggle="collapse" data-target="#collapsePenyewaan" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-clipboard-list text-light"></i>
          <span class="text-light">Penyewaan</span>
        </a>
        <div id="collapsePenyewaan" class="<?=$showPenyewaan;?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$statusPenyewaan;?>" href="daftar-penyewaan?menu=penyewaan">Daftar Penyewaan</a>
            <a class="collapse-item <?=$statuslaporanPenyewaan;?>" href="daftar-laporanPenyewaan?menu=laporanPenyewaan">Laporan</a>
          </div>
        </div>
      </li>

      <!-- <li class="nav-item <?=$statusPengembalian;?> <?=$statuslaporanPengembalian;?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengembalian" aria-expanded="true" aria-controls="collapsePengembalian">
          <i class="fas fa-fw fa-undo-alt text-light"></i>
          <span class="text-light">Pengembalian</span>
        </a>
        <div id="collapsePengembalian" class="<?=$showPengembalian;?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$statusPengembalian;?>" href="daftar-pengembalian?menu=pengembalian">Daftar Pengembalian</a>
            <a class="collapse-item <?=$statuslaporanPengembalian;?>" href="daftar-laporanPengembalian?menu=laporanPengembalian">Laporan</a>
          </div>
        </div>
      </li> -->

      <!-- <li class="nav-item <?=$statusPengadaan;?> <?=$statuslaporanPengadaan;?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengadaan" aria-expanded="true" aria-controls="collapsePengadaan">
          <i class="fas fa-fw fa-folder-plus text-light"></i>
          <span class="text-light">Pengadaan Barang</span>
        </a>
        <div id="collapsePengadaan" class="<?=$showPengadaan;?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?=$statusPengadaan;?>" href="daftar-Pengadaan?menu=Pengadaan">Daftar Pengadaan</a>
            <a class="collapse-item <?=$statusNotaPengadaan;?>" href="daftar-notaPengadaan?menu=notaPengadaan">Daftar Nota Pengadaan</a>
            <a class="collapse-item <?=$statuslaporanPengadaan;?>" href="daftar-laporanPengadaan?menu=laporanPengadaan">Laporan</a>
          </div>
        </div>
      </li> -->

      <!-- <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-wallet text-light"></i>
          <span class="text-light">Pembukuan</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->
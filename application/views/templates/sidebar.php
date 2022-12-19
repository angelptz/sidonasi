<style>
    body {
        background: linear-gradient(to right, #F933FF, #FFF633 25%);
    }
</style>


<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin/index">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laptop"></i>
        </div>
        <div class="sidebar-brand-text mx-3" >Admin Sido</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Looping Menu -->
    <div class="sidebar-heading">
        Beranda
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
            <i class="fa fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Donasi
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('donasi/kategori'); ?>">
            <i class="fa fa-fw fa-file"></i>
            <span>Kategori Projek</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('donasi'); ?>">
            <i class="fa fa-fw fa-folder"></i>
            <span>Laporan Donasi</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
</ul>
<!-- End of Sidebar -->
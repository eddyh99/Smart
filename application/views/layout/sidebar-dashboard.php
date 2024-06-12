<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo pt-4 d-flex align-items-center justify-content-center">
            <a href="<?=base_url()?>dashboard" class="text-nowrap logo-img">
                <img src="<?= base_url()?>assets/img/logo.png" width="130" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <div class="mx-3">
            <hr>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$dash_active?>" href="<?= base_url()?>dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MASTER</span>
                </li> -->
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$user_active?>" href="<?= base_url()?>user" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$kriteria_active?>" href="<?= base_url()?>kriteria" aria-expanded="false">
                        <span>
                            <i class="ti ti-notes"></i>
                        </span>
                        <span class="hide-menu">Kriteria</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$bahan_active?>" href="<?= base_url()?>kriteria/bahan" aria-expanded="false">
                        <span>
                            <i class="ti ti-notes"></i>
                        </span>
                        <span class="hide-menu">Kualitas Bahan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$jenis_active?>" href="<?= base_url()?>Jenis" aria-expanded="false">
                        <span>
                            <i class="ti ti-notes"></i>
                        </span>
                        <span class="hide-menu">Jenis Produk</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$guru_active?>" href="<?= base_url()?>Produk" aria-expanded="false">
                        <span>
                            <i class="ti ti-school"></i>
                        </span>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$penilaian_active?>" href="<?= base_url()?>guru/penilaian" aria-expanded="false">
                        <span>
                            <i class="ti ti-checklist"></i>
                        </span>
                        <span class="hide-menu">Penilaian</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$topsis_active?>" href="<?= base_url()?>topsis" aria-expanded="false">
                        <span>
                            <i class="ti ti-crown"></i>
                        </span>
                        <span class="hide-menu">Perangkingan TOPSIS</span>
                    </a>
                </li>
                <li class="sidebar-item mb-5 pb-5">
                    <a class="sidebar-link" href="<?= base_url()?>auth/logout" aria-expanded="false">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!--  Sidebar End -->

<!--  Main wrapper -->
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header" style="background-color: #ffffff; box-shadow: 2px 2px 10px rgba(0,0,0,0.1);">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url()?>assets/img/user-4.jpg" alt="" width="35" height="35" class="rounded-circle">
                        </a>
                    </li>
                    <li class="nav-item dropdown pe-3" style="border-right: 2px solid white;">
                        <?= $_SESSION['logged_status']['username']?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->

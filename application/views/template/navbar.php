<nav class="pcoded-navbar menupos-fixed ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="#" class="b-brand">
                <div class="b-bg">
                    S
                </div>
                <span class="b-title">SIPES</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu Navigasi</label>
                </li>
                <li data-username="home" class="nav-item"><a href="<?= site_url('home') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Master Data</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('mahasiswa') ?>" class="">Data Mahasiswa</a></li>
                        <li class=""><a href="<?= site_url('prodi') ?>" class="">Data Program Studi</a></li>
                        <li class=""><a href="<?= site_url('konsentrasi') ?>" class="">Data Konsentrasi</a></li>
                        <li class=""><a href="<?= site_url('jenjang') ?>" class="">Data Jenjang</a></li>
                    </ul>
                </li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-mic"></i></span><span class="pcoded-mtext">Data Seminar</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('seminar') ?>" class="">Data Seminar</a></li>
                        <li class=""><a href="<?= site_url('tiket') ?>" class="">Data Tiket</a></li>
                        <li class=""><a href="<?= site_url('pembicara') ?>" class="">Data Pembicara</a></li>
                        <li class=""><a href="<?= site_url('sponsor') ?>" class="">Data Sponsor</a></li>
                    </ul>
                </li>
                <li data-username="pendaftaran" class="nav-item"><a href="<?= site_url('pendaftaran') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Pendaftaran Seminar</span></a></li>
                <li data-username="extra components session timeout session idle timeout offline" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-grid"></i></span><span class="pcoded-mtext">Data QR Code</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('genqr') ?>" class="">Ambil QR Code</a></li>
                        <li class=""><a href="<?= site_url('scan') ?>" class="">Scan QR Code</a></li>
                    </ul>
                </li>
                <li data-username="animations" class="nav-item"><a href="<?= site_url('laporan') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Laporan Pendaftaran</span></a></li>
            </ul>
        </div>
    </div>
</nav>
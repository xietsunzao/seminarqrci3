<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
        <a href="#" class="b-brand">
            <div class="b-bg">
                E
            </div>
            <span class="b-title">Sistem Pendaftaran Seminar</span>
        </a>
    </div>
    <a class="mobile-menu" id="mobile-header" href="#!">
        <i class="feather icon-more-horizontal"></i>
    </a>
    <div class="collapse navbar-collapse">
        <a href="#" class="mob-toggler"></a>
        <ul class="navbar-nav mr-auto">
            <li>

                <div class="page-header">
                </div>

            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <div class="main-search">
                    <div class="input-group">
                        <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
                        <a href="#!" class="input-group-append search-close">
                            <i class="feather icon-x input-group-text"></i>
                        </a>
                        <span class="input-group-append search-btn btn btn-primary">
                            <i class="feather icon-search input-group-text"></i>
                        </span>
                    </div>
                </div>
            </li>
         
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon feather icon-settings"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="<?php echo base_url() ?>assets/images/widget/slider6.jpg" class="img-radius" alt="User-Profile-Image">
                            <span>Admin</span>
                            <a href="<?php echo site_url('logout') ?>" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                     
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
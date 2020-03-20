<style>
    .btn-icon,
    .drp-icon {
        width: 40px;
        height: 40px;
        padding: 10px 12px;
        border-radius: 50%;
    }

    .csa {
        max-height: 100px;
        min-width: 100px;
        min-height: 100px;
        max-width: 100px;

    }
</style>
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10"><?= $title ?></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!"><?= $parent ?></a></li>
                    <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card">
            <div class="widget-profile-card-3">
                <img class="img-fluid img-thumbnail csa" src="<?php echo base_url() ?>assets/images/widget/slider6.jpg" alt="Profile-user">
            </div>
            <div class="card-body text-center">
                <h3><?= $nama_mhs ?></h3>
                <p><?= $nim ?></p>
                
            </div>
            <div class="card-footer bg-inverse">
                <div class="row text-center">
                    <div class="col">
                        <h4><?= $kode_prodi ?></h4>
                        <span>Prodi</span>
                    </div>
                    <div class="col">
                        <h4><?= $kode_konsentrasi ?></h4>
                        <span>Kosentrasi</span>
                    </div>
                    <div class="col">
                        <h4><?= $kode_jenjang ?></h4>
                        <span>Jenjang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card"  style="height:425px;">
            <div class="card-header">
                <h5><?= $title ?></h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-danger btn-icon" href="#!" role="button"><i class="fas fa-street-view"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Program Studi</div>
                        <p class="chat-header text-muted"><?= $nama_prodi ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-info btn-icon" href="#!" role="button"><i class="fas fa-tag"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Konsentrasi</div>
                        <p class="chat-header text-muted"><?= $nama_konsentrasi ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-warning btn-icon" href="#!" role="button"><i class="fas fa-graduation-cap"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Jenjang</div>
                        <p class="chat-header text-muted"><?= $nama_jenjang ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-primary btn-icon" href="#!" role="button"><i class="fas fa-at"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Email</div>
                        <p class="chat-header text-muted"><?= $email ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-success btn-icon" href="#!" role="button"><i class="fas fa-mobile-alt"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">No Telepon</div>
                        <p class="chat-header text-muted"><?= $no_telp ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
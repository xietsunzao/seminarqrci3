<style>
    .img-thumbnail {
        padding: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        height: auto;
        min-width: auto;
        max-width: auto;
        max-height: 550px;
        min-height: 500px;
    }

    ximg {
        left: 0px;
    }

    .imgA1 {
        height: auto;
        position: relative;
        width: 100%;
        z-index: 3;
    }

    .pembicara {
        max-height: 80px;
        min-width: 80px;
        min-height: 80px;
        height: auto;
    }

    .card-pembicara {
        min-height: 450px;
    }

    .sponsor {
        max-height: 50px;
    }

    .sampul {
        max-height: 200px;
        min-height: 200px;
        min-width: 320px;
        max-width: 320px;
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
    <div class="col-md-5 col-xl-5">
        <div class="card" style="height:630px;">
            <img class="img-fluid img-thumbnail" src="<?php echo base_url() ?>uploads/poster/<?= $lampiran ?>" alt="Profile-user">

            <div class="card-body text-center">
                <h3><?= $nama_seminar ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row ml-md-1">
            <div class="col-md-12">
                <div class="card" style="height:300px;">
                    <div class="card-header">
                        <h5><?= $title ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="media">
                                    <div class="media-left">
                                        <a class="btn btn-outline-primary btn-icon" href="#!" role="button"><i class="fas fa-at"></i>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="chat-header">Nama Seminar</div>
                                        <p class="chat-header text-muted"><?= $nama_seminar ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="media">
                                    <div class="media-left">
                                        <a class="btn btn-outline-warning btn-icon" href="#!" role="button"><i class="fas fa-calendar"></i>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="chat-header">Tanggal Pelaksanaan</div>
                                        <p class="chat-header text-muted"><?= $tgl_pelaksanaan ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="media">
                                    <div class="media-left">
                                        <a class="btn btn-outline-danger btn-icon" href="#!" role="button"><i class="fas fa-money"></i>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="chat-header">Harga Tiket</div>
                                        <p class="chat-header text-muted"><?= $harga_tiket ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="media">
                                    <div class="media-left">
                                        <a class="btn btn-outline-info btn-icon" href="#!" role="button"><i class="fas fa-list"></i>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="chat-header">Slot Tiket</div>
                                        <p class="chat-header text-muted"><?= $tgl_pelaksanaan ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card" style="height:300px;">
                    <div class="card-header">
                        <h5><?= $tiket ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <img class="img-responsive imgA1" src="<?php echo base_url("uploads/tiket/{$foto_tiket}"); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <?php foreach ($seminar_box as $sb) { ?>
        <div class="col-xl-3 col-md-6">
        <div class="card ticket-card">
            <div class="card-body">
                <p class="m-b-25 bg-c-<?= $sb->color ?> lbl-card"><i class="fa fa-<?= $sb->icon ?> m-r-5"></i>
                    <?= $sb->title ?></p>
                <div class="text-center">
                    <h2 class="m-b-0 d-inline-block text-c-<?= $sb->color ?>"><?= $sb->total ?></h2>
                    <p class="m-b-0 d-inline-block">Tickets</p>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>


    <div class="col-sm-12 stastic-slider-full-card">
        <div id="stastic-slider-full4" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item" data-interval="3000">
                    <div class="row no-gutters">
                        <?php foreach ($sponsor as $s) { ?>
                            <div class="col-md-6 col-xl-3">
                                <div class="card bg-dark rounded-0 shadow-none">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <span class="text-white d-flex justify-content-center align-items-center">
                                            <?php echo $s->nama_sponsor ?>
                                        </span>
                                        <img src="<?php echo base_url("uploads/sponsor/{$s->gambar}") ?>" alt="" class="img-fluid sponsor">
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="carousel-item active" data-interval="3000">
                    <div class="row no-gutters">
                        <?php foreach ($sponsor as $s) { ?>
                            <div class="col-md-6 col-xl-3">
                                <div class="card bg-dark rounded-0 shadow-none">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <span class="text-white d-flex justify-content-center align-items-center">
                                            <?php echo $s->nama_sponsor ?>
                                        </span>
                                        <img src="<?php echo base_url("uploads/sponsor/{$s->gambar}") ?>" alt="" class="img-fluid sponsor">
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($pembicara as $p) { ?>
        <div class="col-sm-4 col-md-4">
            <div class="card user-card user-card-2 shape-center card-pembicara">
                <div class="card-header border-0 p-2 pb-0">
                    <div class="cover-img-block">
                        <img src="<?php echo base_url() ?>assets/images/widget/slider6.jpg" alt="" class="img-fluid sampul">
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="user-about-block text-center">
                        <div class="row align-items-end">
                            <div class="col text-left pb-3"><a href="#!"><i class="icon feather icon-star-on text-c-yellow f-20"></i></a>
                            </div>
                            <div class="col">
                                <div class="position-relative d-inline-block">
                                    <img class="img-radius img-fluid wid-80 pembicara" src="<?php echo base_url("uploads/pembicara/{$p->foto}") ?>" alt="User image">
                                    <div class="certificated-badge">
                                        <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                        <i class="fas fa-check front-icon text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-right pb-3">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h6 class="mb-1 mt-3"><?php echo $p->nama_pembicara ?></h6>
                        <p class="mb-3 text-muted"><?php echo $p->latar_belakang ?></p>
                    </div>
                    <hr class="wid-80 b-wid-3 my-4">
                </div>
            </div>
        </div>
    <?php } ?>



</div>
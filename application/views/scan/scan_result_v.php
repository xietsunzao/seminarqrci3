<style>
    img {
        left: 0px;
    }

    .imgA1 {
        height: auto;
        position: relative;
        width: 100%;
        z-index: 3;
    }

    .imgB1 {
        position: absolute;
        z-index: 3;
        top: 3px;
        left: 59%;
        width: 18%
    }
</style>
<div class="card">
    <div class="card-header">
        <?= $this->session->flashdata('message'); ?>
        <h5>Hasil</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-warning btn-icon" href="#!" role="button"><i class="fas fa-user"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Nomor Induk</div>
                        <p class="chat-header text-muted"><?= $nomor_induk ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-danger btn-icon" href="#!" role="button"><i class="fas fa-user"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Nama Peserta</div>
                        <p class="chat-header text-muted"><?= $nama_mhs ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
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
            </div>
            <div class="col-sm-6">
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
        <div class="row">
            <div class="col-sm-12">
                <img class="img-responsive imgA1" src="<?php echo base_url('uploads/tiket/tiket.jpg'); ?>" />
                <img class="img-responsive imgB1" src="<?php echo base_url('uploads/qr_image/') . $nomor_induk . 'code.png'; ?>" />
            </div>
        </div>
    </div>
</div>
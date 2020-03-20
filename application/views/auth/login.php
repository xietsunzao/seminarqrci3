<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/animation/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/notification/css/notification.min.css">
    <style>
    <style>
    .alert span {
        cursor: pointer;
        padding-right: 5px;
    }
</style>
    </style>
</head>

<body class="auth-prod-slider">
    <div class="blur-bg-images"></div>
    <div class="auth-wrapper">
        <div class="auth-content container">
            <div class="card">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-5">
                        <div class="card-body">
                            <?php echo form_open("auth/login"); ?>
                            <img src="<?php echo base_url() ?>assets/backend/template/assets/images/csa1.png" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">Login into your account</h4>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                </div>
                                <?php echo form_input($identity); ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                </div>
                                <?php echo form_input($password); ?>
                            </div>
                            <?php echo form_submit('submit', lang('login_submit_btn'), ['class' => 'btn btn-primary mb-4']); ?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <div id="carouselExampleCaptions" class="carousel slide auth-slider" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="auth-prod-slidebg bg-1"></div>
                                    <div class="carousel-caption d-none d-md-block">
                                        <img src="<?php echo base_url() ?>assets/backend/template/assets/images/product/c1.png" alt="product images" class="img-fluid mb-5">
                                        <h5>Sistem Pendaftaran Seminar (SIPES) </h5>
                                        <p class="mb-5">Sistem pendaftaran peserta seminar menggunakan QR Code</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="auth-prod-slidebg bg-2"></div>
                                    <div class="carousel-caption d-none d-md-block">
                                        <img src="<?php echo base_url() ?>assets/backend/template/assets/images/product/c2.jpg" alt="product images" class="img-fluid mb-5">
                                        <h5>Memudahkan pengguna untuk melakukan pendaftaran seminar</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="auth-prod-slidebg bg-3"></div>
                                    <div class="carousel-caption d-none d-md-block">
                                        <img src="<?php echo base_url() ?>assets/backend/template/assets/images/product/c3.jpg" alt="product images" class="img-fluid mb-5">
                                        <h5>Cukup melakukan scan QR</h5>
                                    </div>
                                </div>
                       
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/backend/template/assets/js/vendor-all.min.js"></script>
    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/notification/js/bootstrap-growl.min.js"></script>

    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')) { ?>

                function notify(message, type) {
                    $.growl({
                        icon: 'feather icon-check',
                        title: 'Berhasil!',
                        message: message,
                    }, {
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        spacing: 10,
                        z_index: 999999,
                        delay: 2500,
                        timer: 5000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" style="width:30%;height:80px;" class="alert" role="alert">' +
                            '<button type="button" class="close" data-growl="dismiss">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<span data-growl="icon"></span>' +
                            '<span data-growl="title"></span><br>' +
                            '<span data-growl="message"></span>' +
                            '<a href="#!" data-growl="url"></a>' +
                            '</div>'
                    });
                };
                notify('<?php echo $this->session->flashdata('success'); ?>', 'success');
            <?php } else if ($this->session->flashdata('danger')) { ?>
                function notify(message, type) {
                    $.growl({
                        icon: 'feather icon-x-circle',
                        title: 'Error!',
                        message: message,
                    }, {
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        spacing: 10,
                        z_index: 999999,
                        delay: 2500,
                        timer: 5000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" style="width:25%;height:70px;" class="alert" role="alert">' +
                            '<button type="button" class="close" data-growl="dismiss">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<span data-growl="icon"></span>' +
                            '<span data-growl="title"></span><br>' +
                            '<span data-growl="message"></span>' +
                            '<a href="#!" data-growl="url"></a>' +
                            '</div>'
                    });
                };
                notify('<?php echo $this->session->flashdata('danger'); ?>', 'danger');
            <?php } else if ($this->session->flashdata('warning')) { ?>

                function notify(message, type) {
                    $.growl({
                        icon: 'feather icon-alert-triangle',
                        title: 'Peringatan!',
                        message: message,
                    }, {
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        spacing: 10,
                        z_index: 999999,
                        delay: 2500,
                        timer: 30000000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" style="width:30%;height:80px;" class="alert" role="alert">' +
                            '<button type="button" class="close" data-growl="dismiss">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<span data-growl="icon"></span>' +
                            '<span data-growl="title"></span><br>' +
                            '<span data-growl="message"></span>' +
                            '<a href="#!" data-growl="url"></a>' +
                            '</div>'
                    });
                };
                notify('<?php echo $this->session->flashdata('warning'); ?>', 'warning');
            <?php } else if ($this->session->flashdata('info')) { ?>

                function notify(message, type) {
                    $.growl({
                        icon: 'feather icon-alert-circle',
                        title: 'Peringatan!',
                        message: message,
                    }, {
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        spacing: 10,
                        z_index: 999999,
                        delay: 2500,
                        timer: 5000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" style="width:30%;height:80px;" class="alert" role="alert">' +
                            '<button type="button" class="close" data-growl="dismiss">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<span data-growl="icon"></span>' +
                            '<span data-growl="title"></span><br>' +
                            '<span data-growl="message"></span>' +
                            '<a href="#!" data-growl="url"></a>' +
                            '</div>'
                    });
                };
                notify('<?php echo $this->session->flashdata('info'); ?>', 'info');
            <?php } ?>
        });
    </script>
</body>

</html>
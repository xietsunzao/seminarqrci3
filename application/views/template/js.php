<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/js/pcoded.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/js/menu-setting.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/data-tables/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/js/pages/data-styling-custom.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/dropify/js/dropify.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/inputmask/js/inputmask.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/inputmask/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/inputmask/js/autoNumeric.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/notification/js/bootstrap-growl.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/ekko-lightbox/js/ekko-lightbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/lightbox2-master/js/lightbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/jquery-migrate/jquery-migrate.min.js"></script>

<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/multi-select/js/jquery.quicksearch.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/multi-select/js/jquery.multi-select.js"></script>

<script>
    $(document).ready(function() {
        // [ lightbox ]
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).jquLightbox();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Drag atau upload file disini!',
                replace: 'Drag atau upload file disini atau klik untuk menimpa!',
                remove: 'dihapus',
                error: 'Error'
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".phone").inputmask({
            mask: "9999-9999-9999"
        });
        $(".nim").inputmask({
            mask: "99999999"
        });
        $(".slot").inputmask({
            mask: "999"
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".js-example-basic-single").select2();
    });
</script>
<script>
    $("body").on("click", ".remove-data", function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr("href");
        var id = $(this).attr("data-id");
        swal({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan lagi!",
            icon: 'warning',
            width: 500,
            dangerMode: true,
            buttons: {
                cancel: 'Batal',
                delete: 'Hapus'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                var postData = {};
                postData["id"] = id;
                $.post(targetUrl, postData, function(willDelete) {
                    swal("Data berhasil dihapus!", {
                        icon: "success",
                    }).then(function() {
                        location.reload();
                    });
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tanggal_pelaksanaan').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
    });
</script>

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
<script>
    let base_url = '<?= base_url() ?>';
</script>
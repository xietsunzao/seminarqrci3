<style>
    .ui-autocomplete {
        opacity: 0;
        display: none;
        transition: opacity 0.5s;
        -moz-transition: opacity 0.5s;
        -webkit-transition: opacity 0.5s;
        -o-transition: opacity 0.5s;
    }

    .ui-autocomplete.opened {
        opacity: 1;
    }
</style>
<body class="hold-transition skin-blue layout-top-nav" onLoad="pindah()">

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10"><?= $title ?></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5><?= $title ?></h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <?= $lqr ?>
                    <?= $iqr ?>
                </div>
                <div class="form-row pt-2">
                    <?= $submit ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5><?= $restitle ?></h5>
            </div>
            <div class="card-body ajax-content" id="showResult"></div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/jquery-ui/js/jquery-ui.js"></script>

<script type="text/javascript">
    function pindah() {
        $('#id').focus();
    };

    function ready() {
        var id = $('#id').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('genqr/generate') ?>',
            data: `id=${id}`,
            beforeSend: function(msg) {
                $('#showResult').html('<h1><i class="fa fa-spin fa-refresh" /></h1>');
            },
            success: function(msg) {
                $('#showResult').html(msg);
                $('#id').focus();
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#id').autocomplete({
            source: "<?php echo site_url('genqr/search'); ?>",
            open: function() {
                $('ul.ui-autocomplete').addClass('opened')
            },
            close: function() {
                $('ul.ui-autocomplete').removeClass('opened').css('display', 'block');
            },
            select: function(event, ui) {
                $('[name="qr"]').val(ui.item.label);
            }
        });
    });
</script>


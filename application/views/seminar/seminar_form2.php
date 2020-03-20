<style>
    .pembicara {
        padding-right: 39%;
    }
</style>
<style>
    body {
        padding-top: 60px;
    }

    @media (max-width: 767px) {
        .description {
            display: none;
        }
    }

    #carbonads {
        box-sizing: border-box;
        max-width: 300px;
        min-height: 130px;
        padding: 15px 15px 15px 160px;
        margin: 0;
        border-radius: 4px;
        font-size: 13px;
        line-height: 1.4;
        background-color: rgba(0, 0, 0, 0.05);
    }

    #carbonads .carbon-img {
        float: left;
        margin-left: -145px;
    }

    #carbonads .carbon-poweredby {
        display: block;
        color: #777 !important;
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5><?= $title ?></h5>
                <div class="card-header-right">
                    <div class="float-right">
                    </div>
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
                <?= $formopen; ?>
                <div class="form-row pt-1">
                    <?= $lnama_seminar ?>
                    <?= $i_namaseminar;  ?>
                    <?= $fe_namaseminar ?>
                </div>
                <div class="form-row pt-1">
                    <?= $ltgl_pelaksanaan ?>
                    <?= $i_tglpelaksanaan ?>
                    <?= $fe_tglpelaksanaan ?>
                </div>
                <div class="form-row pt-1">
                    <div class="col-sm-6">
                        <?= $llampiran ?>
                        <?= $i_lampiran ?>
                    </div>
                </div>
                <div class="form-row pt-1">
                    <div class="col-sm-6">
                        <?= $lpembicara ?>
                        <?= $i_pembicara ?>
                    </div>
                </div>
                <div class="form-row pt-3">
                    <?= $i_idseminar ?>
                    <?= $submit ?>
                </div>

            </div>
            <?= $formclose  ?>


            
        </div>
    </div>
</div>






<script>
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>
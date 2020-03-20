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
                <?= $formopen ?>
                <div class="form-row">
                    <?= $lnim ?>
                    <?= $inputnim;  ?>
                    <?= $fe_nim ?>
                    <div class="invalid-feedback">
                        <?= $ivnim ?>
                    </div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-row">
                    <?= $lnama_mhs ?>
                    <?= $inputnama_mhs ?>
                    <?= $fe_namamhs ?>
                    <div class="invalid-feedback">
                        <?= $ivnama_mhs ?>
                    </div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-row">
                    <?= $lprodi ?>
                    <?= $ddprodi ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?= $lkonsentrasi ?>
                        <?= $ddkonsentrasi ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $ljenjang ?>
                        <?= $ddjenjang ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?= $lemail ?>
                        <?= $iemail ?>
                        <?= $fe_email ?>
                        <div class="invalid-feedback">
                            <?= $ivemail ?>
                        </div>
                        <div class="valid-feedback"></div>

                    </div>
                    <div class="form-group col-md-6">
                        <?= $lno_telp ?>
                        <?= $inputno_telp ?>
                        <?= $fe_notelp ?>
                        <div class="invalid-feedback">
                            <?= $ivnotelp ?>
                        </div>
                        <div class="valid-feedback"></div>
                    </div>
                </div>
                <?= $inputid ?>
                <?= $submit ?>
                <?= $formclose  ?>
                <div class="form-row">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
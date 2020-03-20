<style>
    table,
    tr,
    td,
    th {
        text-align: center;
    }


    .badge {
        display: inline-block;
        padding: .25em .4em;
        font-size: 100%;
        font-weight: 00;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
                        <?php echo $btnadd ?>
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
            <div class="card-body p-3 mt-2">
                <div class="">
                    <div class="customer-scroll" style="height:auto;position:relative;">
                        <div class="dt-responsive table-responsive">
                            <table id="myTable" class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Peserta</th>
                                        <th>Email</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($laporan as $l) { ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $l->nama_mhs ?></td>
                                            <td><?php echo $l->email ?></td>
                                            <td>
                                                <?php if ($l->tgl_khd == NULL) : ?>
                                                    <label class="badge badge-danger">-</label>
                                                <?php else : ?>
                                                    <label class="badge badge-success"><?= $l->tgl_khd ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($l->jam_khd == NULL) : ?>
                                                    <label class="badge badge-danger">-</label>
                                                <?php else : ?>
                                                    <label class="badge badge-success"><?= $l->jam_khd ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($l->id_stskhd == NULL) : ?>
                                                    <label class="badge badge-danger">Tidak Hadir</label>
                                                <?php elseif ($l->id_stskhd == 2) : ?>
                                                    <label class="badge badge-success"><?= $l->nama_stskhd ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($l->id_presensi != NULL) : ?>
                                                    <?php echo anchor("laporan/update/{$l->id_presensi}", "<i class='feather icon-edit'></i>Edit", ['class' => 'btn btn-sm btn-gradient-warning']) ?>
                                                    <?php echo anchor("laporan/delete/{$l->id_presensi}", "<i class='feather icon-trash-2'></i>Hapus", ['class' => 'btn btn-sm btn-gradient-danger remove-data']) ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
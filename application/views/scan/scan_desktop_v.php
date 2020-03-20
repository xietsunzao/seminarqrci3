<style>
    #buttonScan {
        display: none;
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
    <div class="col-sm-6">
        <div class="card">
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
                <div id="sourceSelectPanel" style="display:none">
                    <label for="sourceSelect">Change video source:</label>
                    <select id="sourceSelect" style="max-width:450px" class="form-control"></select>
                </div>
                <div>
                    <video id="video" width="450" height="400" style="border: 0px solid gray"></video>
                </div>
                <textarea hidden="hidden" name="id_peserta" id="result"></textarea>
                <input type="hidden" name="seminar" id="idSeminar" value="<?= $id_seminar ?>">
                <span>
                    <a href="#" id="buttonScan" class="btn btn-danger">Cek</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 ajax-content" id="showResult">

    </div>
</div>



<script type="text/javascript" src="<?php echo base_url() ?>assets/backend/template/assets/plugins/zxing/zxing.min.js"></script>

<!-- scan 2 --> 
<script type="text/javascript">
    window.addEventListener('load', function() {
        let selectedDeviceId;
        let audio = new Audio("assets/audio/beep.mp3");
        const codeReader = new ZXing.BrowserMultiFormatReader()
        console.log('ZXing code reader initialized')
        codeReader.getVideoInputDevices()
            .then((videoInputDevices) => {
                const sourceSelect = document.getElementById('sourceSelect')
                selectedDeviceId = videoInputDevices[0].deviceId
                if (videoInputDevices.length >= 1) {
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        sourceSelect.appendChild(sourceOption)
                    })

                    sourceSelect.onchange = () => {
                        selectedDeviceId = sourceSelect.value;
                    };

                    const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                    sourceSelectPanel.style.display = 'block'
                }
                codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                    if (result) {
                        console.log(result)
                        document.getElementById('result').textContent = result.text
                        audio.play();
                        $('#buttonScan').click();
                    }

                    if (err && !(err instanceof ZXing.NotFoundException)) {
                        console.error(err)
                        document.getElementById('result').textContent = err
                    }
                })
                console.log(`Started continous decode from camera with id ${selectedDeviceId}`)

                document.getElementById('resetButton').addEventListener('click', () => {
                    codeReader.reset()
                    document.getElementById('result').textContent = '';
                    console.log('Reset.')
                })

            })
            .catch((err) => {
                console.error(err)
            })
    })
</script>

<script>
    let halaman = '<?= base_url() ?>';
</script>
<script>
    $("#buttonScan").click(function() {

        let idPeserta = $('#result').val();
        let idSeminar = $('#idSeminar').val();
        console.log(idPeserta);
        let url = halaman + 'scan/proses_kehadiran';
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id: idPeserta,
                seminar: idSeminar
            },
            beforeSend: function(msg) {
                $('#showResult').html('<h1><i class="fa fa-spin fa-refresh" /></h1>')
            },
            success: function(msg) {
                $('#showResult').html(msg);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error');
            }
        });

    });
</script>
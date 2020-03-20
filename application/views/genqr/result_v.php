<style>


    img {
        left: 50px;
    }

    .imgA1 {
        height: auto;
        position: relative;
        width: 80%;
        z-index: 3;
    }

    .imgB1 {
        position: absolute;
        z-index: 3;
        top: 5px;
        left:53%;
        width: 15%
    }
</style>

<div class="col-sm-12">
    <img class="img-responsive imgA1" src="<?php echo base_url('uploads/tiket/tiket.jpg'); ?>" />
    <img class="img-responsive imgB1" src="<?php echo base_url('uploads/qr_image/') . $nim . 'code.png'; ?>" />
</div>
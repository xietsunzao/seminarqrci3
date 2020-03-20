<!DOCTYPE html>
<html lang="en">

<head>
    <title>404 Page Not Found</title>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Phoenixcoded" />


    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/animation/css/animate.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/css/style.css">
</head>

<div class="auth-wrapper error">
    <div id="container" class="container">
        <ul id="scene" class="scene">
            <li class="layer" data-depth="1.00"><img class="img-fluid" src="<?php echo base_url() ?>assets/backend/template/assets/images/error/404-01.png" alt="images"></li>
            <li class="layer" data-depth="0.60"><img class="img-fluid" src="<?php echo base_url() ?>assets/backend/template/assets/images/error/shadows-01.png" alt="images"></li>
            <li class="layer" data-depth="0.20"><img class="img-fluid" src="<?php echo base_url() ?>assets/backend/template/assets/images/error/monster-01.png" alt="images"></li>
            <li class="layer" data-depth="0.40"><img class="img-fluid" src="<?php echo base_url() ?>assets/backend/template/assets/images/error/text-01.png" alt="images"></li>
            <li class="layer" data-depth="0.10"><img class="img-fluid" src="<?php echo base_url() ?>assets/backend/template/assets/images/error/monster-eyes-01.png" alt="images"></li>
        </ul>
        <form action="<?php echo site_url('home')?>">
            <button class="btn btn-outline-light mt-3 mb-4"><i class="feather icon-home"></i>Back to Home</button>
        </form>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/backend/template/assets/js/vendor-all.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/template/assets/js/pages/error.js"></script>
<script>
    var scene = document.getElementById('scene');
    var parallax = new Parallax(scene);
</script>
</html>
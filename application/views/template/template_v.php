<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sistem Pendaftaran Seminar</title>



	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<?php $this->load->view('template/css') ?>
</head>

<body class="">

	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<?php $this->load->view('template/navbar') ?>
	<?php $this->load->view('template/header') ?>


	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">


						<!-- start content here -->
							<?php echo $contents ?>
						<!-- end content -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/js') ?>
</body>

</html>
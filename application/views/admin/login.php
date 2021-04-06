<?php $this->load->view('admin/components/_head', ['log' => false]); ?>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<h2><strong><?= APP_NAME; ?></strong></h2>
			</div>
			<div class="card-body login-card-body">
				<p class="login-box-msg p-0 pb-3">Iniciar sesión</p>

				<form id="form_login" method="post" onsubmit="validFormPage(event, '<?= base_url('admin/validar'); ?>')">
					<div class="input-group mb-3 ">
						<input type="email" name="email" class="form-control" placeholder="Email" autofocus>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>

					<div class="input-group mb-3">
						<input type="password" name="pass" class="form-control" placeholder="Contraseña">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					
					<button type="submit" id="btnForm" class="btn bg-gradient-primary btn-block mt-4" name="button">
						<div id="cargandoSpinner" class="d-none">
							<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
							Accediendo...
						</div>
						<span id="nomForm">Acceder</span>
					</button>
				</form>
				<!-- /.form -->

				<!-- <p class="mb-1 mt-2 text-center">
					<a href="forgot-password.html"><small>Olvidé mi contraseña</small></a>
				</p> -->
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

	<?php $this->load->view('admin/components/_scripts', ['log' => false]) ?>

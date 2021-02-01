<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/mensajes/_headerMensajes'); ?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title">
								<a href="<?= base_url('admin/mensajes'); ?>" title="Volver">
									<i class="fas fa-reply mr-3"></i>
								</a>
								<?= $msj->nombre; ?>
							</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<div class="mailbox-read-info">
								<h5 class="mb-1"><u><i>Asunto:</i></u> <?= $msj->motivo; ?></h5>
								<h6><u><i>De:</i></u> <?= $msj->correo; ?>
									<span class="mailbox-read-time float-right"><?= strftime("%d de %B de %Y %H:%M", strtotime($msj->fecha_envio)); ?></span>
								</h6>
							</div>
							<!-- /.mailbox-read-info -->
							<div class="mailbox-read-message">
								<?= $msj->mensaje; ?>
							</div>
							<!-- /.mailbox-read-message -->
						</div>
						<!-- /.card-body -->
						<div class="card-footer p-2">
							<div class="float-right">
								<button type="button" id="responder" class="btn btn-default"><i class="fas fa-reply"></i> Responder</button>
							</div>
						</div>
						<!-- /.card-footer -->
					</div>
					<!-- /.card -->
					<div id="form-responder" class="card card-primary card-outline d-none">
						<div class="card-body p-0">
							<form id="resp-mensaje" class="form-horizontal" method="post" onsubmit="validFormPage(event, '<?= base_url('enviarRespuesta'); ?>')">
								<div class="card-body">
									<div class="form-group row">
										<label for="para" class="col-sm-2 col-form-label">Para</label>
										<div class="col-sm-10">
											<input type="email" id="para" name="para" class="form-control" placeholder="Introduce un email ... " value="<?= $msj->correo; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="asunto" class="col-sm-2 col-form-label">Asunto</label>
										<div class="col-sm-10">
											<input type="text" id="asunto" name="asunto" class="form-control" placeholder="Introduce un asunto ..." value="<?= $msj->motivo; ?>">
										</div>
									</div>
									<div class="form-group row mb-0">
										<label for="mensaje" class="col-sm-2 col-form-label">Mensaje</label>
										<div class="col-sm-10">
											<textarea id="mensaje" name="mensaje" class="form-control" rows="6" placeholder="Introduce un mensaje ..."></textarea>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
							</form>
						</div>
						<!-- /.card-body -->
						<div class="card-footer p-2">
							<div class="float-right">
								<button type="submit" id="btnForm" form="resp-mensaje" class="btn btn-primary" name="button">
									<div id="cargandoSpinner" class="d-none">
										<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
										Enviando...
									</div>
									<span id="nomForm"><i class="fas fa-paper-plane mr-2"></i>Enviar</span>
								</button>
							</div>
						</div>
						<!-- /.card-footer -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	$('#responder').click(function() {
		$('#form-responder').removeClass('d-none');
		$(this).fadeOut();
	});
</script>

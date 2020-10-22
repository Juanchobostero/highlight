<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Está a punto de salir!</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body py-4">
	A continuación se cerrará la sesión de <strong><?= $this->session->userdata('usuario'); ?></strong>. ¿Continuar?
</div>
<div class="modal-footer bg-gradient-light py-1">
	<button type="button" class="btn bg-gradient-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>
	<form action="<?= base_url('cerrarSesion'); ?>" method="POST">
		<button type="submit" class="btn bg-gradient-primary">
			<i class="fas fa-sign-out-alt fa-fw"></i> Cerrar sesión
		</button>
	</form>
</div>

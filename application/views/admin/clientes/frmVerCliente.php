<!-- Profile Image -->
<div class="card card-primary card-outline">
	<div class="card-header">
		<div class="card-title">Info cliente</div>
		<button type="button" id="cerrarModal" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="card-body card-outline box-profile">
		<div class="text-center">
			<img class="box-img-md img-circle" src="<?= base_url($cliente->fotoU); ?>" alt="User profile picture">
		</div>

		<h3 class="profile-username text-center"><?= $cliente->apellidoU; ?>, <?=$cliente->nombreU;?></h3>

		<ul class="list-group list-group-unbordered mt-1">
			<li class="list-group-item">
				<strong>Teléfono</strong> <p class="float-right mb-0"><?=$cliente->telefonoU;?></p>
			</li>
			<li class="list-group-item">
				<strong>E-Mail</strong> <p class="float-right mb-0"><?=$cliente->emailU;?></p>
			</li>
		</ul>
	</div>
</div>

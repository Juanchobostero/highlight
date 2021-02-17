<div class="card card-primary card-outline">
	<div class="card-header">
		<div class="card-title">Info subcategoría</div>
		<button type="button" id="cerrarModal" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="card-body card-outline">
		<div class="text-center">
			<img class="box-img" src="<?= base_url($subcategoria->imagenSC); ?>" alt="Subcategoria">
		</div>
		<ul class="list-group list-group-unbordered mt-1">
			<li class="list-group-item">
				<strong>Categoría</strong>
				<p class="float-right mb-0"><?= $subcategoria->categoria->descripcionCAT; ?></p>
			</li>
			<li class="list-group-item">
				<strong>Subcategoría</strong>
				<p class="float-right mb-0"><?= $subcategoria->descripcionSC; ?></p>
			</li>
		</ul>
	</div>
</div>

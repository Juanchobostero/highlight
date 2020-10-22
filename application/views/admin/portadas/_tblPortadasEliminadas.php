<table class="table table-hover">
	<thead>
		<tr>
			<th>Título</th>
			<th>Imagen</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($portadas as $port) : ?>
			<tr>
				<td><?= $port->titulo; ?></td>
				<td>
					<img class="img-fluid m-auto d-block rounded" src="<?= base_url($port->imagen); ?>" style="width: 40px; height: 40px">
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

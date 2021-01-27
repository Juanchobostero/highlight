<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1><?= $tit_mensaje; ?></h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<?php if ($lectura) : ?>
						<li class="breadcrumb-item"><a href="<?= base_url('admin/mensajes'); ?>">Mensajes</a></li>
						<li class="breadcrumb-item active">Lectura de Mensaje</li>
					<?php else : ?>
						<li class="breadcrumb-item active">Mensajes</li>
					<?php endif; ?>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

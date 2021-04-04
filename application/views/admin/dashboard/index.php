<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?php $this->load->view('admin/dashboard/_totales'); ?>
			<?php // json_decode(json_encode($grafico_ventas), true);?>
			<div class="row">
				<div class="col-12 col-md-8">
					<!-- Ultimas 8 ventas nuevas -->
					<?php $this->load->view('admin/dashboard/_ultimas_ventas'); ?>

					<!-- Grafico de total de ventas en los ultimos 6 meses -->
					<?php $this->load->view('admin/dashboard/_grafico_ventas'); ?>
				</div>

				<div class="col-12 col-md-4">
					<!-- Ultimos 4 productos agregados -->
					<?php $this->load->view('admin/dashboard/_ultimos_productos'); ?>
				</div>
			</div>
		</div>
		<!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
	// carga grafico
	window.onload = function() { graficoVentas() }
</script>
<?php $this->load->view('admin/components/footer'); ?>

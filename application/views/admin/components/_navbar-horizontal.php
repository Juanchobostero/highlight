<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">Home</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">15</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header">15 Notifications</span>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-envelope mr-2"></i> 4 new messages
					<span class="float-right text-muted text-sm">3 mins</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-users mr-2"></i> 8 friend requests
					<span class="float-right text-muted text-sm">12 hours</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-file mr-2"></i> 3 new reports
					<span class="float-right text-muted text-sm">2 days</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
			</div>
		</li>
		<!-- Login user -->
		<li class="nav-item dropdown user-menu">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
				<span class="d-none d-md-inline mr-1"><?= $_SESSION['usuario']; ?></span>
				<img src="<?= base_url($_SESSION['foto']) ?>" class="user-image img-circle elevation-2" alt="User Image">
			</a>
			<ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
				<a href="<?= base_url('admin/perfil/editar') ?>" class="dropdown-item">
					<i class="fas fa-user-alt fa-fw mr-2"></i> Mi Perfil
				</a>
				<div class="dropdown-divider"></div>
				<button type="button" class="dropdown-item" onclick="cargarForm('<?= base_url('salir') ?>', 'small', 'modal-small')">
					<i class="fas fa-sign-out-alt fa-fw mr-2"></i> Salir
				</button>
			</ul>
		</li>
	</ul>
</nav>
<!-- /.navbar -->

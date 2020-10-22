<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?=base_url('admin/dashboard');?>" class="brand-link">
		<img src="#" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Highlight</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?=base_url($_SESSION['foto']);?>" class="user-image img-circle elevation-2" alt="..." style="width: 2.5rem; height: 2.5rem">
			</div>
			<div class="info">
				<a href="<?=base_url('admin/perfil/editar')?>" class="d-block"><?=$_SESSION['usuario'];?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?= base_url('admin'); ?>" class="nav-link <?=($act == '0D') ? 'active' : ''?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/usuarios'); ?>" class="nav-link <?=($act == '1U') ? 'active' : ''?>">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>Usuarios</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/clientes'); ?>" class="nav-link <?=($act == '1C') ? 'active' : ''?>">
						<i class="nav-icon fas fa-user-friends"></i>
						<p>Clientes</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/portadas'); ?>" class="nav-link <?=($act == '2Port') ? 'active' : ''?>">
						<i class="nav-icon far fa-images"></i>
						<p>Portadas</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="pages/widgets.html" class="nav-link">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Widgets
							<span class="right badge badge-danger">New</span>
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-copy"></i>
						<p>
							Layout Options
							<i class="fas fa-angle-left right"></i>
							<span class="badge badge-info right">6</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="pages/layout/top-nav.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Top Navigation</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="pages/layout/top-nav-sidebar.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Top Navigation + Sidebar</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-chart-pie"></i>
						<p>
							Charts
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="pages/charts/chartjs.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>ChartJS</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="pages/charts/flot.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Flot</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">EXAMPLES</li>
				<li class="nav-item">
					<a href="pages/calendar.html" class="nav-link">
						<i class="nav-icon fas fa-calendar-alt"></i>
						<p>
							Calendar
							<span class="badge badge-info right">2</span>
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

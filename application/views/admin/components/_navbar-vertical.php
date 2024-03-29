<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('admin/dashboard'); ?>" class="brand-link">
		<img src="<?= base_url('assets/img/jlvector.png') ?>" alt="Logo" class="brand-image img-circle elevation-3">
		<span class="brand-text font-weight-light"><?= APP_NAME ?></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url($_SESSION['foto']); ?>" class="user-image img-circle elevation-2" alt="..." style="width: 2.5rem; height: 2.5rem">
			</div>
			<div class="info">
				<a href="<?= base_url('admin/perfil/editar') ?>" class="d-block"><?= $_SESSION['usuario']; ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('admin'); ?>" class="nav-link <?= ($act == '0D') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-header">INSTITUCIONAL</li>
				<li class="nav-item <?= ($desplegado == 'ins') ? 'menu-is-opening menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= ($desplegado == 'ins') ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-university"></i>
						<p>
							Institucional
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('admin/nosotros'); ?>" class="nav-link <?= ($act == '0_1Nos') ? 'active' : '' ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>Nosotros</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/terminos-y-condiciones'); ?>" class="nav-link <?= ($act == '0_2Ter') ? 'active' : '' ?>">
								<i class="nav-icon fas fa-american-sign-language-interpreting"></i>
								<p>Términos y condiciones</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/politica-de-privacidad'); ?>" class="nav-link <?= ($act == '0_3Pri') ? 'active' : '' ?>">
								<i class="nav-icon fas fa-shield-alt"></i>
								<p>Políticas de privacidad</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">GESTIÓN</li>
				<!-- <li class="nav-item">
					<a href="<?//= base_url('admin/usuarios'); ?>" class="nav-link <?//= ($act == '1U') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>Usuarios</p>
					</a>
				</li> -->
				<li class="nav-item">
					<a href="<?= base_url('admin/clientes'); ?>" class="nav-link <?= ($act == '2C') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-user-friends"></i>
						<p>Clientes</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/imagenes'); ?>" class="nav-link <?= ($act == '3Img') ? 'active' : '' ?>">
						<i class="nav-icon far fa-file-image"></i>
						<p>Imágenes</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/portadas'); ?>" class="nav-link <?= ($act == '4Port') ? 'active' : '' ?>">
						<i class="nav-icon far fa-images"></i>
						<p>Portadas</p>
					</a>
				</li>
				<li class="nav-item <?= ($desplegado == 'prod') ? 'menu-is-opening menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= ($desplegado == 'prod') ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-gifts"></i>
						<p>
							Productos
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('admin/categorias'); ?>" class="nav-link <?= ($act == '5_0Cat') ? 'active' : '' ?>">
								<i class="nav-icon fas fa-th-list"></i>
								<p>Categorias y Subcat.</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/marcas'); ?>" class="nav-link <?= ($act == '5_1Mar') ? 'active' : '' ?>">
								<i class="nav-icon far fa-bookmark"></i>
								<p>Marcas</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/productos'); ?>" class="nav-link <?= ($act == '5_2Prod') ? 'active' : '' ?>">
								<i class="nav-icon fas fa-tools"></i>
								<p>Productos</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/productos-pausados') ?>" class="nav-link <?= ($act == '5_3Paus') ? 'active' : '' ?>">
								<i class="nav-icon fas fa-pause"></i>
								<p>Pausados</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/productos-destacados'); ?>" class="nav-link <?= ($act == '5_4Dest') ? 'active' : '' ?>">
								<i class="nav-icon fas fa-star"></i>
								<p>Destacados</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/productos-ofertas'); ?>" class="nav-link <?= ($act == '5_5Ofer') ? 'active' : '' ?>">
								<i class="nav-icon fab fa-forumbee"></i>
								<p>Ofertas</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">MOVIMIENTOS</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/ventas'); ?>" class="nav-link <?= ($act == '6Vent') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-shopping-cart"></i>
						<p>Ventas
							<span class="badge badge-info right notif-ventas"></span>
						</p>
					</a>
				</li>
				<li class="nav-header">ESTADISTICAS</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/inventario'); ?>" class="nav-link <?= ($act == '9Inv') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-boxes"></i>
						<p>Inventario</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/balance'); ?>" class="nav-link <?= ($act == '10Bal') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-balance-scale"></i>
						<p>Balance</p>
					</a>
				</li>
				<li class="nav-header">MENSAJES</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/mensajes'); ?>" class="nav-link <?= ($act == '8Msj') ? 'active' : '' ?>">
						<i class="nav-icon fas fa-envelope"></i>
						<p>
							Mensajes
							<span class="badge badge-info right notif-msjs"></span>
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

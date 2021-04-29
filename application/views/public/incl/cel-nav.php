<nav class="cel-nav">
    <a href="#" class="nav-close">
        <img src="<?=base_url('assets/img/public/imgVarios/close.jpeg')?>" class="img-close" alt="cerrar-nav">
    </a>

    <ul class="nav-links">

    <?php if($this->session->userdata('login')):?>
    <li class="nav-item nav-logout">
      <a onclick="showMenu()" class="nav-link-email"><?=$this->session->userdata('emailU')?></a>
      <ul class="sub-nav-links">
        <li class="sub-nav-item">
          <a class="sub-nav-link" href="<?=base_url('perfil')?>">Mi Perfil</a>
        </li>
        <li class="sub-nav-item">
          <a class="sub-nav-link" href="<?=base_url('pedidos')?>">Mis pedidos</a>
        </li>
        <li class="sub-nav-item">
          <a class="sub-nav-link" href="<?=base_url('carrito')?>">Mi Carrito</a>
        </li>
        
        <li class="sub-nav-item">
          <a href="<?=base_url('logout')?>" class="sub-nav-link">Salir</a>
        </li>
      </ul>
    </li>
    <?php else:?>
    <li class="nav-login">
      <a href="<?=base_url('login')?>" id="bold" class="nav-login-link">
        <span class="login-text">  Ingresar</span>
      </a>
      <div class="vl"></div>
      <a href="<?=base_url('registro')?>" id="bold" class="nav-register-link">
        <span class="register-text">  Registrate</span>
      </a>
    </li>
    <?php endif?>

        <li class="nav-item">
            <a href="<?=base_url()?>" id="bold" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item">
            <a href="#" id="bold" class="nav-link">Productos</a>
        </li>

        <hr class="hr-nav">

        <div class="nav-prod">
            <li class="nav-item">
                <a href="<?=base_url('productos')?>" id="cat" class="nav-link">Todos</a>
            </li>
            <?php foreach($categorias as $categoria):?>
                <li class="nav-item">
                  <a href="<?=base_url('productos/'. $categoria->id_categoria)?>" class="nav-link" id="cat"><?=$categoria->descripcionCAT?>
                  </a>
                </li>
                <?php foreach($categoria->subcategorias as $subcat):?>
                  <li class="nav-item">
                    <a href="<?=base_url('productos/'. $categoria->id_categoria . '/' . $subcat->id_subcategoria)?>" class="nav-link" id="subcat"><?=$subcat->descripcionSC?>
                    </a>
                  </li>
                <?php endforeach?>
              <?php endforeach?>
            
        </div>

        <li class="nav-item">
            <a href="<?=base_url('nosotros')?>" id="bold" class="nav-link">Nosotros</a>
        </li>
        <li class="nav-item">
            <a href="<?=base_url('contacto')?>" id="bold" class="nav-link">Contacto</a>
        </li>
    </ul>
  
</nav>
<div class="backdrop"></div>
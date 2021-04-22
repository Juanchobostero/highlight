<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Comment #1: OG Tags -->
  <meta property="og:url"           content="https://hlherramientas.com.ar" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="HIGHLIGHT" />
  <meta property="og:description"   content="Herramientas e Iluminación" />
  <meta property="og:image"         content="https://www.hlherramientas.com.ar/assets/img/public/img/hl.png" />
  <meta property="og:image:width"  content="200"/>
  <meta property="og:image:height" content="200"/>

  <link href='https://css.gg/eye.css' rel='stylesheet'>
  <link href="<?=base_url('assets/plugins/sweetalert2/sweetalert2.min.css')?>">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital@1&display=swap" rel="stylesheet">


  
  
  <!-- estilos -->
  <link rel="stylesheet" href="<?=base_url('assets/css/public/index.css');?>">

  <link rel="apple-touch-icon" href="favicon.png" type="image/x-icon">
  <link rel="icon" href="favicon.png" type="image/x-icon">
  <link rel="Shortcut Icon" href='favicon.png' type="image/x-icon" />
  
  <title>HIGHLIGHT</title>
  
</head>
<body class="grid-container">

  <?php $this->load->view('public/incl/cel-nav');?>

    <header class="header">

      <a class="menu-toggle">
        <img class="img-toggle" src="<?=base_url('assets/img/public/img/toggle.png')?>">
      </a>

      <a href="<?=base_url()?>" class="logo-link">
        <img class="icon-logo" src="<?=base_url('assets/img/public/img/hlportada.png')?>" alt="logo">
      </a>
      
      <nav class="navbar">
        <ul class="navbar-links">
          <li class="navbar-item"><a href="<?=base_url()?>" class="navbar-link">Inicio</a></li>
          <li id="activa-drop" class="navbar-item">
            <a id="opcion-prod" class="navbar-link">Productos</a>

            <ul class="navbar-drop">
              <li>
                <a href="<?=base_url('productos')?>" class="navbar-drop-link" id="categoria">Todos
                </a>
              </li>
              <?php foreach($categorias as $categoria):?>
                <li>
                  <a href="<?=base_url('productos/'. $categoria->id_categoria)?>" class="navbar-drop-link" id="categoria"><?=$categoria->descripcionCAT?>
                  </a>
                </li>
                <?php foreach($categoria->subcategorias as $subcat):?>
                  <li>
                    <a href="<?=base_url('productos/'. $categoria->id_categoria . '/' . $subcat->id_subcategoria)?>" class="navbar-drop-link" id="subcategoria"><?=$subcat->descripcionSC?>
                    </a>
                  </li>
                <?php endforeach?>
              <?php endforeach?>
            </ul>
            
          </li>
          <li class="navbar-item"><a id="nosotros" href="<?=base_url('nosotros')?>" class="navbar-link">Nosotros</a></li>
          <li class="navbar-item"><a href="<?=base_url('contacto')?>" class="navbar-link">Contacto</a></li>
        </ul>
      </nav>
      
      <div class="extras">
          <a href="#" id="search" class="busqueda">
            <img class="icon-lupa" src="<?=base_url('assets/img/public/imgVarios/lupa-icon.jpeg')?>" alt="logo">
          </a>
          <?php if($this->session->userdata('login')):?>

            <ul class="user-logout">
              <li class="dropdown-logout">
                <a href="javascript:void(0)" class="logout-link" onclick="myFunction()">
                  <img class="logout-user" src="<?=base_url('assets/img/public/imgVarios/loguin.png')?>" alt="logo">
                </a>
                <span class="bad"></span>
                <div class="dropdown-content" id="myDropdown" onblur="hideDiv()">
                  <a href="<?=base_url('perfil')?>" class="navbar-link" id="nav">Mi perfil</a>
                  <a href="<?=base_url('pedidos')?>" class="navbar-link" id="nav">Mis pedidos</a>
                  <a href="<?=base_url('logout')?>" class="navbar-link" id="nav">Salir</a>
                </div>
              </li>
            </ul>
          <?php else:?>
            <a href="<?=base_url('login')?>" class="usuario">
            <img class="icon-user" src="<?=base_url('assets/img/public/imgVarios/loguin.png')?>" alt="logo">
            </a>
          <?php endif?>
          
          <a href="<?=base_url('carrito')?>" class="carrito">
            <img class="icon-cart" src="<?=base_url('assets/img/public/imgVarios/carrito-vector.png')?>" alt="logo">
            <span class="cart-number" style="display:none;"></span>
          </a>
      </div>
    
    </header>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  
  <!-- estilos -->
  <link rel="stylesheet" href="<?=base_url('assets/css/public/index.css');?>">

  <title>HIGHLIGHT</title>
  
</head>
<body class="grid-container">
  <header class="header">

    <a class="menu-toggle">
      <img class="img-toggle" src="<?=base_url('assets/img/public/img/toggle.png')?>">
    </a>

    <a href="<?=base_url()?>" class="logo-link">
      <img class="icon-logo" src="<?=base_url('assets/img/public/img/hlportada.png')?>" alt="logo">
    </a>
    
    <nav>
      <ul>
        <li><a href="<?=base_url()?>">Inicio</a></li>
        <li><a href="#">Productos</a></li>
        <li><a href="#">Nosotros</a></li>
        <li><a href="#">Contactos</a></li>
      </ul>
    </nav>
    
    <div class="extras">
        <a href="<?=base_url()?>" class="busqueda">
          <img class="icon-lupa" src="<?=base_url('assets/img/public/imgVarios/lupa-icon.jpeg')?>" alt="logo">
        </a>
        <a href="<?=base_url()?>" class="usuario">
          <img class="icon-user" src="<?=base_url('assets/img/public/imgVarios/loguin.png')?>" alt="logo">
        </a>
        <a href="<?=base_url()?>" class="carrito">
          <img class="icon-cart" src="<?=base_url('assets/img/public/imgVarios/carrito-vector.png')?>" alt="logo">
        </a>
    </div>
  
  </header>


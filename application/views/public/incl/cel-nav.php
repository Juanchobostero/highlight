<nav class="cel-nav">
    <a href="#" class="nav-close">
        <img src="<?=base_url('assets/img/public/imgVarios/close.jpeg')?>" class="img-close" alt="cerrar-nav">
    </a>

    <ul class="nav-links">
        <li class="nav-item">
            <a href="#" id="bold" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item">
            <a href="#" id="bold" class="nav-link">Productos</a>
        </li>

        <hr class="hr-nav">

        <div class="nav-prod">
            <li class="nav-item">
                <a href="#" id="cat" class="nav-link">Todos</a>
            </li>
            <?php foreach($categorias as $categoria):?>
                <li class="nav-item">
                  <a href="#" class="nav-link" id="cat"><?=$categoria->descripcionCAT?>
                  </a>
                </li>
                <?php foreach($categoria->subcategorias as $subcat):?>
                  <li class="nav-item">
                    <a href="#" class="nav-link" id="subcat"><?=$subcat->descripcionSC?>
                    </a>
                  </li>
                <?php endforeach?>
              <?php endforeach?>
            
        </div>

        <li class="nav-item">
            <a href="#" id="bold" class="nav-link">Nosotros</a>
        </li>
        <li class="nav-item">
            <a href="#" id="bold" class="nav-link">Contacto</a>
        </li>
    </ul>
  
</nav>
<div class="backdrop"></div>
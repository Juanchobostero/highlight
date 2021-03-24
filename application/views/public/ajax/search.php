<?php foreach($productos as $producto):?>
  <a class="result-item" href="<?=base_url('producto/'.$producto->id_producto)?>">
    <div class="result-img-top">
      <img class="result-img" src="<?=base_url($producto->foto)?>">
    </div>
    <div class="result-info">
      <h2 class="result-nomb"><?=$producto->nombrePR?></h2>
      <h2 class="result-price">$<?=$producto->precio_ventaPR?></h2>
      <hr>
    </div>
  </a>
<?php endforeach?>
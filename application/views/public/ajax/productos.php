<?php foreach($productos as $producto):?>
    <a href="<?=base_url('producto/'.$producto->id_producto)?>">
        <div class="producto-cell">
            <div class="producto-card">
                <div class="producto-img-top">
                    <img class="producto-img" src="<?=base_url($producto->foto)?>" alt="producto img">
                </div>
                <div class="producto-desc">
                    <h5 class="producto-desc-title"><?=$producto->nombrePR?></h5>
                    <i class="gg-eye"></i>
                </div>
            </div>
        </div>
    </a>
<?php endforeach?>
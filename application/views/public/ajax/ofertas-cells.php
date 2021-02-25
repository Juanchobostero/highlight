<?php foreach($productos as $producto):?>
    <div class="slider-cell" data-idproducto="<?=$producto->id_producto?>">
        <div class="product-cart">
            <div class="product-img-top">
                <img class="product-img" src="<?=base_url($producto->foto)?>">
                <span class="new-price">AHORA: <?=$producto->precio_nuevo?></span>
            </div>
            <div class="product-desc">
                <h5>
                    <?=$producto->nombrePR?>
                </h5>
                <h6>
                    Antes <s>$<?=$producto->precio_ventaPR?></s>
                </h6>
            </div>
        </div>
    </div>
<?php endforeach?>
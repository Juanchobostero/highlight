<section class="prod-ofertas section-slider container">
	<h4 class="slider-titulo">OFERTAS</h4>
	<hr class="hr-head">
	<div class="slider-wraper slider-ofertas">
		<?php foreach($ofertas as $producto):?>
			<div class="slider-cell" data-idproducto="<?=$producto->id_producto?>">
				<div class="product-cart">
					<div class="product-img-top">
						<img class="product-img" src="<?=base_url($producto->foto)?>">
					</div>
					<div class="new-price">
						<span>AHORA  $<?=$producto->precio_nuevo?></span>
					</div>
					<div class="product-desc">
						<h5>
							<?php echo word_limiter($producto->nombrePR, 5)?>
						</h5>
						<h6>
							Antes <s>$<?=$producto->precio_ventaPR?></s>
						</h6>
					</div>
				</div>
			</div>
			<?php endforeach?>
	</div>
	<div class="total-ofertas"
		data-total="<?=$total_ofertas?>">
	</div>
</section>
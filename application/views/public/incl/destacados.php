<section class="prod-destacados section-slider container">
	<h4 class="slider-titulo">DESTACADOS</h4>
	<hr class="hr-head">
	<div class="slider-wraper slider-destacados">

		<?php foreach($destacados as $producto):?>
		<div class="slider-cell" data-idproducto="<?=$producto->id_producto?>">
		<div class="product-cart">
			<div class="product-img-top">
			<img class="product-img" src="<?=base_url($producto->foto)?>">
			</div>
			<div class="product-desc">
				<h6>
					$<?=$producto->precio_ventaPR?>
				</h6>
				<h5>
					<?php echo word_limiter($producto->nombrePR, 5)?>
				</h5>
				
			</div>
		</div>
		</div>
		<?php endforeach?>
	</div>
	<div class="total-destacados"
		data-total="<?=$total_destacados?>">
	</div>
</section>
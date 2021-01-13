<section class="prod-novedades section-slider container">
	<h4 class="slider-titulo">NOVEDADES</h4>
	<hr class="hr-head">
	<div class="slider-wraper slider-novedades">

		<?php foreach($novedades as $producto):?>
		<div class="slider-cell" data-idproducto="<?=$producto->id_producto?>">
			<div class="product-cart">
				<div class="product-img-top">
				<img class="product-img" src="<?=base_url($producto->foto)?>">
				</div>
				<div class="product-desc">
				<h5>
					<?=$producto->nombrePR?>
				</h5>
				
				<h6>
					$<?=$producto->precio_ventaPR?>
				</h6>
				</div>
			</div>
		</div>
		<?php endforeach?>
	</div>
	<div class="total-novedades"
		data-total="<?=$total_novedades?>">
	</div>
</section>
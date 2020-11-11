<section class="portadas">
	<div class="gallery js-flickity">
		<?php foreach($portadas as $portada):?>
			<div class="gallery-cell"><img class="img-portada" src="<?=base_url($portada->imagen)?>">
			</div>
		<?php endforeach;?>	
	</div>
</section>


<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<div class="product-main">
    <div class="banner" id="banner-pro">
        <a class="prod-link" href="<?=base_url('productos/'. $producto->id_categoria)?>">
            <?=$producto->descripcionCAT . '/'?>
        </a>
        <a class="prod-link" href="<?=base_url('productos/'. $producto->id_categoria . '/' .$producto->id_subcategoria)?>">
            <?=$producto->descripcionSC?>
        </a>
    </div>
    <div class="product-head">
        <h3 id="nameP" class="product-name"><?=$producto->nombrePR?></h3>
        <a href="<?=base_url('productos/'. $producto->id_categoria)?>">
            <span id="catP" class="product-category"><?=$producto->descripcionCAT?></span>
        </a>
        
    </div>
    <div class="hr-pro">
        <hr class="hr-prod">  
    </div>
    
    <div class="product-content">
        <div class="producto-img" >
            <img class="img-pro" id="img-main" src="<?=base_url($producto->foto)?>" onclick="showModalImg(event)">
            </img>
            <?php 
            if(count($fotos) > 1):?>
                <div class="slider-images" id="slider-img">
                    <?php foreach($fotos as $foto):?>
                        <?php if ($foto->foto != $producto->foto) { ?>
                            <div class="img-cart">
                                <img src="<?=base_url($foto->foto)?>" class="img-mini" onclick="change(this.src)">
                            </div>
                        <?php } ?>
                        
                    <?php endforeach?>
                </div>
            <?php endif; ?>
        </div>
        <div class="product-info" id="pro-info">
            <h3 class="des-title">Descripción</h3>
            <div class="product-descrip"><?=$producto->descripcionPR?></div>
            <div class="product-detail">
                <?php if($es_oferta):?>
                    <h6 id="precio-ante">
						<s>$<?=$producto->precio_ventaPR?></s>
                    </h6>
                    <h2 class="product-price">$<?=$precio_oferta->precio?></h2>
					
                <?php else: ?>
                    <h2 class="product-price">$<?=$producto->precio_ventaPR?></h2>
                <?php endif; ?>
                
                <h3 class="product-stock">Stock disponible: <?=ceil($producto->stockPR)?> unidades</h3>
                <label class="lbl-cant" for="cantidad">cantidad:</label>
                <div class="cantidad">
                    <input type="number" class="item-cantidad" id="cantidad" value="0" min="0" max="15">
                    <a href="#" class="cart-link" onclick="addToCart(event)">
                        <img class="cart-img" src="<?=base_url('assets/img/public/imgVarios/add-cart.jpeg')?>">
                    </a>
                </div>
            </div>
        </div>
    </div> 
</div>

<div id="producto-datos" style="display:none" 
    data-idproducto="<?=$producto->id_producto?>"
    data-stock="<?=ceil($producto->stockPR)?>"
    data-precioventa="<?=$producto->precio_ventaPR?>">                        
</div>

<?php $this->load->view('public/incl/modal')?>

<?php $this->load->view('public/incl/footer');?>
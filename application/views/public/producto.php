<?php $this->load->view('public/incl/header');?>

<div class="product-main">
    <div class="banner">
        <div class="breadcrumb">
            <?=$producto->descripcionCAT .'/' .$producto->descripcionSC?>      
        </div>
    </div>
    <div class="product-head">
        <h3 id="nameP" class="product-name"><?=$producto->nombrePR?></h3>
        <span id="catP" class="product-category"><?=$producto->descripcionCAT?></span>
        <hr class="hr-prod">
    </div>
    
    <div class="product-content">
        <div class="producto-img">
            <img class="img-pro" src="<?=base_url($producto->foto)?>">
            </img>
            <div class="product-images">
                <img src="#" class="img-mini">
            </div>
        </div>
        <div class="product-info">
            <h3 class="des-title">Descripción</h3>
            <div class="product-descrip"><?=$producto->descripcionPR?></div>
            <div class="product-detail">
                <h2 class="product-price">$<?=$producto->precio_ventaPR?></h2>
                <h3 class="product-stock">Stock disponible: 3 unidades</h3>
                <div class="cantidad">
                    <input class="product-cantidad" type="text">
                    <a href="#" class="cart-link"><img class="cart-img" src="<?=base_url('assets/img/public/imgVarios/carrito2.jpg')?>"></a>
                </div>
            </div>
        </div>
    </div> 
</div>

<?php $this->load->view('public/incl/footer')?>
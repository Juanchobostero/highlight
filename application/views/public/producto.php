<?php $this->load->view('public/incl/header');?>

<div class="product-main">
    <div class="product-head">
        <h2 class="product-name">Nombre producto</h2>
        <span class="product-category">Categoria Producto</span>
    </div>
    <hr class="hr-prod">
    <div class="product-content">
        <div class="product-img">
            <img class="img-pro" src="#">
            </img>
            <div class="product-images">
                <img src="#" class="img-mini">
            </div>
        </div>
        <div class="product-info">
            <h3 class="product-title">Descripción</h3>
            <div class="product-descrip"></div>
            <h2 class="product-price"></h2>
            <span class="product-stock">Stock disponible: 3 unidades</span>
            <div class="cantidad">
                <input class="product-cantidad" type="text">
                <button class="btn-comprar"></button>
            </div>
        </div>
    </div> 
</div>

<?php $this->load->view('public/incl/footer')?>
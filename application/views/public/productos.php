<?php $this->load->view('public/incl/header');?>

<div class="producto-main">

    <div class="banner banner-prods" id="banner-prod">
        <a class="prod-link" href="<?=base_url('productos')?>">
            Productos
        </a>
        <?php if(isset($categoria)):?>
            <a class="prod-link" href="<?=base_url('productos/'.$categoria->id_categoria)?>">
                /<?=$categoria->descripcionCAT?>
            </a>
        <?php endif?>

        
    </div>

    <div class="product-head categoria">
        <?php if(isset($categoria)):?>
            <h3 id="nameCat" class="product-name"><?=$categoria->descripcionCAT?></h3>
        <?php else:?>
            <h3 id="nameCat" class="product-name">Todos</h3> 
        <?php endif?>
        <?php if(isset($subcategoria)):?>
            <a href="<?=base_url('productos/'. $categoria->id_categoria . '/' . $subcategoria->id_subcategoria)?>">
                <span id="nameSubcat" class="product-category"><?=$subcategoria->descripcionSC?></span>
            </a>
                
        <?php endif?>
    </div>

    <div class="hr-pro">
        <hr class="hr-prods">  
    </div>

    <?php if(isset($categoria) and !isset($subcategoria) ):?>
        <div class="categoria-wrapper">
            <div class="portada">portada
                <img src="#" alt="portada categoria">
            </div>
            <div class="subcategorias-wrapper">
            <?php foreach($categoria->subcategorias as $subcat):?>
                        <a href="<?=base_url('productos/'. $subcat->id_cat . '/' . $subcat->id_subcategoria)?>">
                            <div class="subcategoria-cell">
                                <div class="subcategoria-card">
                                    <div class="subcategoria-img-top">
                                        <img class="subcategoria-img" src="#" alt="subcat img">
                                    </div>
                                    <div class="subcategoria-name">
                                        <h3 class="subcategoria-title"><?=$subcat->descripcionSC?></h3>
                                    </div>
                                </div>
                            </div>
                        </a>
            <?php endforeach?>
            </div>

        </div>
    <?php else:?>
    <div class="productos-wrapper" id="productos">
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
    </div>
    <?php endif?>

</div>

<?php $this->load->view('public/incl/footer');?>
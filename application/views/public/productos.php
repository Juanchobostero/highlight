<?php $this->load->view('public/incl/header');?>
<?php if(isset($categoria) && isset($subcategoria)):?>
<div class="datos-paginado-productos" style="display:none;"
    data-total="<?=$total_pages?>"
    data-categoria="<?php $categoria?>"
    data-subcategoria="<?php $subcategoria?>">
</div>
<?php else:?>
    <div class="datos-paginado-productos" style="display:none;"
    data-total="<?=$total_pages?>"
    >
    </div>
<?php endif?>

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

    <?php if(isset($categoria) && !isset($subcategoria)):?>
        <div class="categoria-wrapper">
            <div class="portada">
                <img src="<?=base_url($categoria->imagenCAT)?>" alt="portada categoria">
            </div>
            <div class="subcategorias-wrapper">
            <?php foreach($categorias as $cat):?>
                <?php foreach($cat->subcategorias as $subcat):?>
                    <?php if($subcat->id_cat == $categoria->id_categoria):?>
                        <a href="<?=base_url('productos/'. $subcat->id_cat . '/' . $subcat->id_subcategoria)?>">
                            <div class="subcategoria-cell">
                                <div class="subcategoria-card">
                                    <div class="subcategoria-img-top">
                                        <img class="subcategoria-img" src="<?=base_url($subcat->imagenSC)?>" alt="subcat img">
                                    </div>
                                    <div class="subcategoria-name">
                                        <h3 class="subcategoria-title"><?=$subcat->descripcionSC?></h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endif?>
                <?php endforeach?>
            <?php endforeach?>
            </div>

            <div class="subcategoria-slider">
                <?php foreach($categorias as $cat):?>
                    <?php foreach($cat->subcategorias as $subcat):?>
                        <?php if($subcat->id_cat == $categoria->id_categoria):?>
                            <a href="<?=base_url('productos/'. $subcat->id_cat . '/' . $subcat->id_subcategoria)?>">
                                <div class="subcat-cell">
                                    <div class="subcat-card">
                                        <div class="subcat-img-top">
                                            <img class="subcat-img" src="<?=base_url($subcat->imagenSC)?>" alt="subcat img">
                                        </div>
                                        <div class="subcat-name">
                                            <h3 class="subcat-title"><?=$subcat->descripcionSC?></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif?>
                    <?php endforeach?>
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
<div class="gooey">
    <span class="dot"></span>
    <div class="dots">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<?php $this->load->view('public/incl/footer');?>
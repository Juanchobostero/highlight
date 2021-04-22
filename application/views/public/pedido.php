<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<div class="venta-detalle">
    <div class="venta-cabecera">
        <div class="cabecera-title">
            <h3>Pedido nro: <?=$pedido->id_venta?></h3>
            <hr>
        </div>

        <div class="cabecera-data">
            <div class="item-detail">
                <img class="mercadoPago" src="<?=base_url('assets/img/public/imgVarios/mp.jpg')?>" alt="mercado pago">
                <span class="mp-text"><?=$pedido->nroPago?></span>
                <div class="detail-name">N° mercado pago</div> 
            </div>

            <div class="item-detail">
                <img class="fecha" src="<?=base_url('assets/img/public/imgVarios/date.jpg')?>" alt="fecha pago">
                <span><?=$pedido->fechaEnvio?></span>
                <div class="detail-name">Fecha</div>
            </div>

            <div class="item-detail">
                <img class="total" src="<?=base_url('assets/img/public/imgVarios/total.jpg')?>" alt="fecha pago">
                <span><?=$pedido->totalVENT?></span>
                <div class="detail-name">Total</div>
            </div>
            
            <div class="item-detail">
                <img class="status" src="<?=base_url('assets/img/public/imgVarios/status2.jpg')?>" alt="fecha pago">
                <span id="status"><?=$pedido->estadoPago?></span>
                <div class="detail-name">Estado</div>
            </div>
        </div>
        
        
    </div>
    <div class="detalle">
        <div class="head-detalle">
            <h3>Detalle</h3>
            <hr>
        </div>
        <div class="body-detalle">
        <?php foreach($pedido->detalle as $detalle):?>
            <a href="<?=base_url('producto/'. $detalle->id_product)?>">
                <div class="item-detalle">
                    <div class="detalle-foto">
                        <img src="<?=base_url($detalle->foto)?>" alt="producto foto">
                    </div>
                    <div class="detalle-info">
                        <span id="detalle-nombre"><?=$detalle->nombrePR?></span>
                        <span id="detalle-cant">Cantidad:<?=ceil($detalle->cantidadVENT)?></span>
                        <span id="detalle-tot">Total: $<?=$detalle->precioVENT?></span>
                    </div>
                </div>
            </a>
            <hr>
        <?php endforeach?>
        </div>
    </div>

</div>

<?php $this->load->view('public/incl/footer');?>
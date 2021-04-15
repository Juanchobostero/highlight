<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<div class="pago">
    <div class="pago-title">
        <h3 class="h3-pago" id="pedidos-title"><?=$title?></h3>
        <hr class="hr-pago" id="pedidos-hr">
    </div>
    <div class="detalles">
        
        <div class="detalles-productos">
            <div class="carrito-content">
            <div class="tabla-main">
                <table class="carrito-tabla">
                    <thead id="pedidos-head">
                        <tr>
                        <th id="th-prod">N° pedido</th>
                        <th id="th-pu">Fecha</th>
                        <th id="th-cant">Monto</th>
                        <th id="th-st">Estado</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody class="carrito-items">
                    <?php foreach($pedidos as $pedido):?>
                        
                            <tr class="carrito-item">
                                <td>
                                    <?=$pedido->id_venta?>
                                </td>
                                
                                <td>
                                    <?=$pedido->fechaEnvio?>
                                </td>
                                <td>
                                    <?=$pedido->totalVENT?>
                                </td>

                                <td>
                                    <?=$pedido->estadoPago?>
                                </td>

                                <td>
                                    <a class="venta-detail" href="<?=base_url('pedido/'.$pedido->id_venta)?>">
                                        <img src="<?=base_url('assets/img/public/imgVarios/venta-detail.jpg')?>">
                                    </a>
                                </td>
                                    
                            </tr>
                        
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
            
        </div>
        </div>
    </div>

</div>


<?php $this->load->view('public/incl/footer');?>
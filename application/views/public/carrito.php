<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<div class="carrito-main">
    <div class="banner" id="carrito-ban">
    </div>
    <div class="carrito-head">
        <div class="carrito-title">
            <span class="carrito-icono"><img src="<?=base_url('assets/img/public/imgVarios/carrito.jpeg')?>" alt="cart img"></span>
            <h3>Mi carrito</h3>
        </div>
        <hr class="carrito-hr">
    </div>
    <div class="carrito-content">
        <div class="tabla-main">
            <table class="carrito-tabla">
                <thead>
                    <tr>
                    <th id="th-prod">Producto</th>
                    <th></th>
                    <th id="th-pu">Precio/unidad</th>
                    <th id="th-cant">Cantidad</th>
                    <th id="th-st">Subtotal</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody class="carrito-items">
                <?php foreach($this->cart->contents() as $item):?>
                    <tr class="carrito-item" id="<?=$item['rowid']?>">
                        <td>
                            <span class="carrito-foto"><img src="<?=base_url($item['foto'])?>" alt="cartimg">
                            </span>
                        </td>
                        <td><?=$item['name']?></td>
                        <td>
                            <h4 id="precio">$
                                <span id="precio-valor-<?=$item['rowid']?>"><?=$item['price']?></span>
                            </h4></td>
                        <td>
                            <span 
                                id="producto-stock-<?=$item['rowid']?>"
                                style="display: none;" 
                            >
                                <?=ceil($item['stock'])?>                     
                            </span>
                            
                            <input 
                                type="number" 
                                class="item-cantidad item-cantidad-cart"
                                id="cant-item-<?=$item['rowid']?>"
                                value="<?=$item['qty']?>"
                                onchange="updateCantidad(event, '<?=$item['rowid']?>')" 
                                type="number"
                                min="0"  
                            >
                        
                        </td>
                        <td>
                            <h4 id="subtotal">$
                                
                                <span id="sub-valor-<?=$item['rowid']?>">
                                    <?=$item['price'] * $item['qty']?>
                                </span>
                            </h4>
                        </td>
                        
                        <td>
                            <a class="delete" onclick='delFromCart("<?=$item["rowid"]?>")'>
                                <img src="<?=base_url('assets/img/public/imgVarios/delete.png')?>">
                            </a>
                        </td>
                    
                    </tr>
                    
                <?php endforeach?>
                </tbody>
            </table>
        </div>
        
        <div class="carrito-total">
            <h4>Total: $ 
                <span id="total-cart">
                    <?=$this->cart->total()?>
                </span>
            </h4>
            <div class="retiro-envio">
                <!-- <select id="ddlViewBy" name="envio">
                    <option value="1">Retiro en local</option>
                    <option value="2">Envío</option>
                </select> -->
                <div class="retiro">
                    <input type="checkbox" id="retiro" name="retiro" onchange="check()" value="1">
                    <span for="retiro" id="retiro-lbl"> Retiro en local</span><br><br>
                </div>

                <div class="envio">
                    <input type="checkbox" id="envio" name="envio" onclick="check()" value="0">
                    <span for="retiro" id="envio-lbl"> Envío a domicilio</span><br><br>
                </div>
                
                
            </div>
        </div>
        
        

        <div class="carrito-botones">
            <button class="carrito-vaciar" onclick="vaciar()">Vaciar</button>
            <button class="carrito-continuar" onclick="guardarCompra()">Continuar</button>
        </div>
    </div>
</div>


<?php $this->load->view('public/incl/footer');?>
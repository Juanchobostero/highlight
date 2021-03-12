<?php $this->load->view('public/incl/header');?>

<div class="carrito-main">
    <div class="banner" id="carrito-ban">
        Carrito
    </div>
    <div class="carrito-head">
        <div class="carrito-title">
            <span class="carrito-icono"><img src="#" alt="cart img"></span>
            <h3>Mi carrito</h3>
        </div>
        <hr class="carrito-hr">
    </div>
    <div class="carrito-content">
        <div class="tabla-main">
            <table class="carrito-tabla">
                <thead>
                    <tr>
                    <th>Producto</th>
                    <th></th>
                    <th>Precio/unidad</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody class="carrito-items">
                <?php foreach($this->cart->contents() as $item):?>
                    <tr class="carrito-item">
                    <td><span class="carrito-foto"><img src="<?=base_url($item['foto'])?>" alt="cartimg"></span></td>
                    <td><?=$item['name']?></td>
                    <td>
                        <h4 id="precio">$
                            <span id="precio-valor-<?=$item['id']?>"><?=$item['price']?></span>
                        </h4></td>
                    <td>
                        <div class="quantity">
                            <input id="cant-cart" value="<?=$item['qty']?>" onchange="uploadPrices(event, '<?=$item['id']?>')" name="cantidad" type="number" min="0" step="1">
                        </div>
                    
                    </td>
                    <td>
                        <h4 id="subtotal">$
                            <span id="sub-valor-<?=$item['id']?>">
                                <?=$item['price'] * $item['qty']?>
                            </span>
                        </h4>
                    </td>
                    
                    <td>
                        <a class="delete" href="#" onclick='delFromCart("<?=$item["id"]?>")'>
                            <img src="<?=base_url('assets/img/public/imgVarios/delete.png')?>">
                        </a>
                    </td>
                    
                    </tr>
                <?php endforeach?>
                </tbody>
            </table>
        </div>
        
        <hr class="total">
        <div class="carrito-total">
            <h4>Total: $ 
                <span id="total-cart">
                    <?=$this->cart->total()?>
                </span>
            </h4>
        </div>
        <hr class="total">

        <div class="carrito-botones">
            <button class="carrito-vaciar">Vaciar</button>
            <button class="carrito-continuar">Continuar</button>
        </div>
    </div>
  


</div>

<?php $this->load->view('public/incl/footer');?>
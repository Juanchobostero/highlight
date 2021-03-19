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

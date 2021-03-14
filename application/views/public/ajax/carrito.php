<?php foreach($this->cart->contents() as $item):?>
    <tr class="carrito-item" id="<?=$item['rowid']?>">
    <td><span class="carrito-foto"><img src="<?=base_url($item['foto'])?>" alt="cartimg"></span></td>
    <td><?=$item['name']?></td>
    <td>
        <h4 id="precio">$
            <span id="precio-valor-<?=$item['id']?>"><?=$item['price']?></span>
        </h4></td>
    <td>
        <span 
            id="producto-stock-<?=$item['rowid']?>"
            style="display: none;" 
        >
            <?=ceil($item['stock'])?>                     
        </span>
        <div class="quantity">
            <input id="cant-item-<?=$item['rowid']?>" 
            value="<?=$item['qty']?>" 
            onchange="updateCantidad(event, '<?=$item['rowid']?>')" 
            name="cantidad" 
            type="number" 
            min="0" 
            step="1">
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
        <a class="delete" href="#" onclick='delFromCart("<?=$item["rowid"]?>")'>
            <img src="<?=base_url('assets/img/public/imgVarios/delete.png')?>">
        </a>
    </td>
    
    </tr>
<?php endforeach?>

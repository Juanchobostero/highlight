<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<?php
// SDK de Mercado Pago
require_once $_SERVER['DOCUMENT_ROOT'] . '/highlight/assets/mercadopago/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-7764682637448613-112623-bd8da5701ce014e430960f099a01e57d__LC_LB__-61092162');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    'success' => base_url('finalizar_compra'),
    'failure' => base_url('falla_compra'),
    'pending' => base_url('pendiente_compra'),
);

$preference->auto_return = 'approved';

// Crea un ítem en la preferencia
$datos = array();
foreach($cart as $itemCart) {
    $item = new MercadoPago\Item();
    $item->title = $itemCart['name'];
    $item->quantity = $itemCart['qty'];
    $item->unit_price = $itemCart['price'];
    $datos[]=$item;
}


  /* $payer = new MercadoPago\Payer();
  $payer->name = $usuario->nombreU;
  $payer->surname = $usuario->apellidoU;
  $payer->email = $usuario->emailU;
  $payer->date_created = date("Y-m-d H:i:s");
  $payer->phone = array(
    "area_code" => "",
    "number" => $usuario->telefonoU
  );
  
  $payer->identification = array(
    "type" => "DNI",
    "number" => "12345678"
  );
  
  $payer->address = array(
    "street_name" => "Cuesta Miguel Armendáriz",
    "street_number" => 1004,
    "zip_code" => "11020"
  );
  // ... */


$preference->items = $datos;
$preference->save();

//curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_tokne=TEST-7764682637448613-112623-bd8da5701ce014e430960f099a01e57d__LC_LB__-61092162" -d "{'site_id':'MLA'}"

// CREDENCIALES VENDEDOR
//{"id":733853182,"nickname":"TESTP7J2NPIA","password":"qatest1678","site_status":"active","email":"test_user_24512024@testuser.com"}

//CREDENCIALES COMPRADOR
//{"id":733853366,"nickname":"TESTEZMWJYKX","password":"qatest7647","site_status":"active","email":"test_user_95853136@testuser.com"}

?>
<div class="pago">
    <div class="pago-title">
        <h3 class="h3-pago"><?=$title?></h3>
        <hr class="hr-pago">
    </div>
    <div class="detalles">
        <h2>Detalle de tu compra</h2>
        <hr>
        <div class="detalles-productos">
            <div class="carrito-content">
            <div class="tabla-main">
                <table class="carrito-tabla">
                    <thead>
                        <tr>
                        <th id="th-prod">Producto</th>
                        <th></th>
                        <th id="th-pu">Precio</th>
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
                                
                                <h5 style="text-align: center; font-weight: bold">
                                    <?=$item['qty']?>
                                </h5>

                                <input 
                                type="number" 
                                class="item-cantidad item-cantidad-cart"
                                id="cant-item-<?=$item['rowid']?>"
                                value="<?=$item['qty']?>"
                                onchange="updateCantidad(event, '<?=$item['rowid']?>')" 
                                type="number"
                                min="0"  
                                style="display: none;"
                            >
                                
                            
                            </td>
                            <td>
                                <h4 id="subtotal">$
                                    
                                    <span id="sub-valor-<?=$item['rowid']?>">
                                        <?=$item['price'] * $item['qty']?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
            
        </div>
        </div>
    </div>

    <div class="pagar">
        <h2>Total: $<?=$this->cart->total()?></h2>
        <hr>
        <form action="<?=base_url('finalizar_compra')?>" method="POST">
            <script
            src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
            data-preference-id="<?php echo $preference->id; ?>">
            </script>
        </form>
    </div>
    
</div>

    


<?php $this->load->view('public/incl/footer');?>
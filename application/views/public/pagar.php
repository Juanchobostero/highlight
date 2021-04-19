<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<?php
// SDK de Mercado Pago
require_once $_SERVER['DOCUMENT_ROOT'] . '/highlight/assets/mercadopago/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-807757061207747-041023-dbcf30f993bada9daed346e6151e4af4-741603910');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    'success' => base_url('finalizar_compra/' .$envioVENT),
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

//curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TEST-6517227164665383-040822-5d43aaed77c7f48c5d17af8782a9585a-223361114" -d "{'site_id':'MLA'}"
//curl -G -X GET -H "accept: application/json" -H 'Authorization: Bearer TEST-807757061207747-041023-dbcf30f993bada9daed346e6151e4af4-741603910' "https://api.mercadopago.com/v1/payments/1235666412" -d "status=approved" -d "offset=0" -d "limit=10"`
// CREDENCIALES VENDEDOR
//{"id":741603910,"nickname":"TESTMASKK07H","password":"qatest4522","site_status":"active","email":"test_user_71615187@testuser.com"}

//CREDENCIALES COMPRADOR
//{"id":741608660,"nickname":"TETE8934678","password":"qatest8581","site_status":"active","email":"test_user_81131039@testuser.com"}

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
        <div class="total-title">
            <h2>Total: $<?=$this->cart->total()?></h2>
        </div>
        <form action="<?=base_url('finalizar_compra')?>" method="POST">
            <script
            src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
            data-preference-id="<?php echo $preference->id; ?>">
            </script>
        </form>
    </div>
    
</div>

    


<?php $this->load->view('public/incl/footer');?>
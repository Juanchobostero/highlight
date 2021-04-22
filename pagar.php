<?php
// SDK de Mercado Pago
require __DIR__ .  '/assets/mercadopago/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-2414639824456369-032503-61f53f82a0f1a0f989a258a7a0d3cb3a-733853182');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// URL de retorno
$preference->back_urls = array(
    "success" => "https://localhost/highlight/success.php",
    "failure" => "http://localhost/highlight/errorpago.php?error=failure",
    "pending" => "http://localhost/highlight/errorpago.php?error=pending"
);
$preference->auto_return = "approved";

// Crea un ítem en la preferencia
$datos = array();
for ($i=0; $i < 10; $i++) { 
    $item = new MercadoPago\Item();
    $item->title = 'Pantalon';
    $item->quantity = 2;
    $item->unit_price = 75.56;
    $datos[]=$item;
}

$preference->items = $datos;
$preference->save();

//curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_tokne=TEST-7764682637448613-112623-bd8da5701ce014e430960f099a01e57d__LC_LB__-61092162" -d "{'site_id':'MLA'}"

// CREDENCIALES VENDEDOR
//{"id":733853182,"nickname":"TESTP7J2NPIA","password":"qatest1678","site_status":"active","email":"test_user_24512024@testuser.com"}

//CREDENCIALES COMPRADOR
//{"id":733853366,"nickname":"TESTEZMWJYKX","password":"qatest7647","site_status":"active","email":"test_user_95853136@testuser.com"}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="https://localhost/highlight/insertarpago.php" method="POST">
        <script
        src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
        data-preference-id="<?php echo $preference->id; ?>">
        </script>
    </form>
</body>
</html>
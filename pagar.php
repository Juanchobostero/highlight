<?php
// SDK de Mercado Pago
require __DIR__ .  '/assets/mercadopago/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-7764682637448613-112623-bd8da5701ce014e430960f099a01e57d__LC_LB__-61092162');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();
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
    <form action="">
        <script
        src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
        data-preference-id="<?php echo $preference->id; ?>">
        </script>
    </form>
</body>
</html>
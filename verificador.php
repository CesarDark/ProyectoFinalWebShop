<?php
    include("global/config.php");
    include("global/conexion.php");
    include("carrito.php");
    include("templates/cabecera.php");
?>

<?php
    print_r($_GET);
    // Basado en la API de Paypal
    //https://developer.paypal.com/docs/api/get-an-access-token-curl/
    $ClientID = "AR1kZMCRhhabhA6iS955zKS_d-indBK7Z7jlIJr1DnyODGefPTmdLMRebr6ZhuhsMb4Dieo4Hc2-2STu";
    $Secret = "EJAQPjaOF67pyDTq2vhRDYUc5ioRS7wa49vP7ftHfbDQDOTo4D1E3QqWvOlCm1lvkMRYLl0NpYGj_k0H";

    //Realizar solicitudes a traves de un cliente.
    //$Login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token"); //original
    //$Login = curl_init("https://api.sandbox.paypal.com/v2/checkout/orders/");
    $Login = curl_init();
    $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
    //Función para acer relación con el login.
    curl_setopt($Login, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($Login, CURLOPT_URL, $url);
    curl_setopt($Login, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($Login, CURLOPT_USERPWD, $ClientID.":".$Secret);
    curl_setopt($Login, CURLOPT_POSTFIELDS,"grant_type=client_credentials");

    $respuesta = curl_exec($Login); //Ejecuta todas las instrucciones anteriores.
    //print_r($respuesta); //Buscar access_token de acceso :v
    $objRespuesta = json_decode($respuesta);
    $accessToken = $objRespuesta->access_token;
    echo "<br>";
    print_r($$accessToken);

    //Consultar la información del pago
    //$venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['payerID']); //original
    $venta = curl_init();
    $url2 = "https://api.sandbox.paypal.com/v2/checkout/orders/".$_GET['orderID'];
    curl_setopt($venta, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($venta, CURLOPT_URL, $url2);
    curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$accessToken));
    curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);

    $respuestaVenta = curl_exec($venta);
    print_r($respuestaVenta);

    $objDatosTransaccion = json_decode($respuestaVenta);
    //print_r($objDatosTransaccion->state);

    
    //----------------------------------------------------------------
    $state = $objDatosTransaccion->state;
    $email = $objDatosTransaccion->payer->payer_info->email;

    $total = $objDatosTransaccion->transactions[0]->amount->total;
    $currency = $objDatosTransaccion->transactions[0]->amount->currency;
    $custom = $objDatosTransaccion->transactions[0]->custom;

    //echo $total;

    print_r($custom);
    $clave = explode("#", $custom);
    $SID = $clave[0];
    $claveVenta = openssl_decrypt($clave[1], COD, KEY);
    print_r($claveVenta);

    curl_close($venta);
    curl_close($Login);

    echo $state;

    if ($state == "approved"){
        $mensajePaypal = "<h3>Pago aprovado</h3>";
        $query = "UPDATE ventas 
                  SET datosp = :datosp, status = 'aprovado'
                  WHERE idVenta = :ID";
        
        $sql = $connect->prepare($query);
        $sql->bindParam(":ID", $claveVenta);
        $sql->bindParam(":datosp", $respuestaVenta);
        $sql->execute();

        $query = "UPDATE ventas 
                  SET status = 'completo'
                  WHERE clavetransaccion = :clavetransaccion
                  AND total = :TOTAL
                  AND ID = :ID";

        $sql = $connect->prepare($query);
        $sql->bindParam(":clavetransaccion", $SID);
        $sql->bindParam(":TOTAL", $total);
        $sql->bindParam(":ID", $claveVenta);
        $sql->execute();

        $completado = $sql->rowCount();

    } else {
        $mensajePaypal = "<h3>Hay un problema con el pago</h3>";
    }
    echo $mensajePaypal;
?>

<div class="jumbotron">
    <h1 class="display-4">¡Listo!</h1>
    <hr class="my-4">
    <p class="lead"><?php echo $mensajePaypal;?></p>
    <p>Content</p>
</div>

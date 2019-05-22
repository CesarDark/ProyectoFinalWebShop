<?php
include("global/config.php");
include("global/conexion.php");
include("carrito.php");
include("templates/cabecera.php");
?>

<?php
if ($_POST) {
    $total = 0; //Lo que se le cobrará al usuario.
    $SID = session_id(); //Devuelve la clave de la sesión.
    $correo = $_POST['email'];

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    $query = "INSERT INTO ventas (clavetransaccion, datosp, fecha, correo, total, status) 
                  VALUES (:clavetransaccion, '', NOW(), :correo, :total, 'Pendiente')";
    $sql = $connect->prepare($query);

    //Insertar en la tabla ventas.
    $sql->bindParam(":clavetransaccion", $SID);
    $sql->bindParam(":correo", $correo);
    $sql->bindParam(":total", $total);
    $sql->execute();

    $idVenta = $connect->lastInsertId(); //Recuperar Id de venta.

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $query = "INSERT INTO detalleVenta (idventa, idproducto, preciounitario, cantidad, descargado) 
                      VALUES (:idventa, :idproducto, :preciounitario, :cantidad, 0)";
        $sql = $connect->prepare($query);

        $sql->bindParam(":idventa", $idVenta);
        $sql->bindParam(":idproducto", $producto['ID']);
        $sql->bindParam(":preciounitario", $producto['PRECIO']);
        $sql->bindParam(":cantidad", $producto['CANTIDAD']);
        $sql->execute();
    }
    //echo "<h3>".$total."</h3>";
}
?>

<!-- Pago con Paypal (Estilo)-->
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
<style>
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }

    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
</style>
<!-- Pago con Paypal (Estilo)-->


<!-- Pantalla para que el usuario pague -->
<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">
        Estas a punto de pagar la cantidad de:
        <h4> $<?php echo number_format($total, 2); ?></h4>
        <div id="paypal-button-container"></div>
    </p>
    <p>Los productos podrán ser descargados una vez que se procese el pago</p>
    <strong>(Para aclaraciones: cesar@gmail.com)</strong>
</div>
<!-- Pantalla para que el usuario pague -->


<!-- Pago con Paypal -->
<script>
    paypal.Buttons({
        env: 'sandbox', // sandbox | production
        //Cuentas
        client: {
            sandbox: 'AR1kZMCRhhabhA6iS955zKS_d-indBK7Z7jlIJr1DnyODGefPTmdLMRebr6ZhuhsMb4Dieo4Hc2-2STu',
            production: 'AenWkUceblmNYp5eUnkkrHr_mzU-w5tpBNTxkImQG5rDd_7OdFsrAkZ_DcwbyPpeVjErR2-lMHWiVfe2'
        },

        // Transacción
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $total; ?>'
                    },
                    //Mostrar descripción al usuario antes de que haga la compra.
                    description: 'Compra de productos: $<?php echo number_format($total, 2); ?>',
                    //Información extra del pago que se procesó (retorno). ¿Quién fue el cliente?
                    //Método de encriptacíón
                    reference_id: "<?php echo $SID; ?>#<?php openssl_encrypt($idVenta, COD, KEY); ?>"
                }]
            });
        },
        // Finalizar la transacción
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Mostrar mensaje
                //alert('Pago completado ' + details.payer.name.given_name + '!');
                alert('Pago completado');
                console.log(data); //Saber que trae el retorno del pago
                //window.location="verificador.php?orderID="+data.orderID+"&payerID="+data.payerID;
                window.location = "verificar_two.php";
            });
        }
    }).render('#paypal-button-container');
</script>
<!-- Pago con Paypal -->

<?php include("templates/pie.php"); ?>
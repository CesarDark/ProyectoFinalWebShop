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
    $usuario = $_SESSION['usuario'];
    $correo = $_POST['email'];

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    $query = "INSERT INTO ventas (clavetransaccion, datosp, fecha, correo, total, status, usuarioNombre) 
                  VALUES (:clavetransaccion, '', NOW(), :correo, :total, 'Pendiente', :usuarioNombre)";
    $sql = $connect->prepare($query);

    //Insertar en la tabla ventas.
    $sql->bindParam(":clavetransaccion", $SID);
    $sql->bindParam(":correo", $correo);
    $sql->bindParam(":total", $total);
    $sql->bindParam(":usuarioNombre", $usuario);
    $sql->execute();

    $idVenta = $connect->lastInsertId(); //Recuperar Id de venta.

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $query = "INSERT INTO detalleVenta (idventa, idproducto, preciounitario, cantidad, descargado, usuario) 
                      VALUES (:idventa, :idproducto, :preciounitario, :cantidad, 0, :usuario)";
        $sql = $connect->prepare($query);

        $sql->bindParam(":idventa", $idVenta);
        $sql->bindParam(":idproducto", $producto['ID']);
        $sql->bindParam(":preciounitario", $producto['PRECIO']);
        $sql->bindParam(":cantidad", $producto['CANTIDAD']);
        $sql->bindParam(":usuario", $usuario);
        $sql->execute();
    }
    //echo "<h3>".$total."</h3>";
}
?>

<!-- Pantalla para que el usuario pague -->
<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">
        Estas a punto de pagar la cantidad de:
        <h4> $<?php echo number_format($total, 2); ?></h4>
        <!-- <div id="paypal-button-container"></div> -->

        <div class="form-group">
            <form action="verificar_two.php"> <br><br>
                <button class="btn btn-success btn-lg center-block" name="" value="Ver" type="submit">Paga Aquí</button>
            </form>
        </div>
    </p>
    <p>Los productos podrán ser descargados una vez que se procese el pago.</p>
    <strong>(Para aclaraciones: cesar@gmail.com)</strong>
</div>
<!-- Pantalla para que el usuario pague -->

<?php include("templates/pie.php"); ?>
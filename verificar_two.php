<?php
    include("global/config.php");
    include("global/conexion.php");
    include("carrito.php");
    include("templates/cabecera.php");
?>

<?php
    $usuario = $_SESSION['usuario'];
    $SID = session_id();

    $query = "UPDATE ventas SET datosp = 'Sesion', status = 'Completado' WHERE claveTransaccion =:claveTransaccion";
    $sql = $connect->prepare($query);
    $sql->bindParam(":claveTransaccion", $SID);
    $sql->execute();

    $completado = $sql->rowCount();

    $mensajePaypal = "Últimas Compras: ";
    echo $mensajePaypal;
    echo $completado;
?>

<div class="jumbotron">
    <h1 class="display-4">¡Gracias <?php echo $_SESSION['usuario']; ?> por tu Compra!</h1>
    <hr class="my-4">
    <small id="emailHelp" class="form-text text-muted">
        Ya puedes descargar tus Cómics.
    </small>
    <p>
    <p class="lead"><?php echo $mensajePaypal; ?></p>

    <!-- Mostrar últimos comprados -->
    <?php
        if ($completado >= 1) {  // >=1 | == 1

            $query = " SELECT detalleVenta.usuario, ventas.clavetransaccion, detalleVenta.idVenta, ventas.total
                        FROM (detalleVenta INNER JOIN ventas ON detalleVenta.idVenta=ventas.idVenta)
                        WHERE ventas.usuarioNombre = :usuarioNombre
                        GROUP BY detalleVenta.usuario, ventas.clavetransaccion, detalleVenta.idVenta, ventas.idVenta";

            $sql = $connect->prepare($query);
            $sql->bindParam(":usuarioNombre", $usuario);
            $sql->execute();

            $listarProductos = $sql->fetchALL(PDO::FETCH_ASSOC);
            //print_r($listarProductos);
        }
    ?>

    <!-- Desplegar Transacción producto -->
    <div class="row">
        <?php foreach ($listarProductos as $producto) { ?>
            <div class="col-4">
                <div class="card">
                    <!-- <img class="card-img-top" src="Images/<?php echo $producto['imagen']; ?>"> -->
                        <div class="card-body">
                            <strong>Transacción: </strong>
                            <p class="card-text"><?php echo $producto['clavetransaccion']; ?></p>
                            <strong>Precio: </strong>
                            <p class="card-text"><?php echo $producto['total']; ?></p>
                            <button class="btn btn-success" type="button">Descargar</button>
                        </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Desplegar Transacción producto -->
    <!-- Mostrar últimos comprados -->

    <div class="form-group">
        <form action="../archivos_sesion/logout.php"> <br><br>
            <button class="btn btn-danger btn-lg center-block" name="" value="Ver" type="submit">Salir</button>
        </form>
    </div>

    </p>
</div>

<?php include("templates/pie.php");

// Vaciar carrito sin cerrar sesión.
unset($_SESSION['CARRITO']);

?>
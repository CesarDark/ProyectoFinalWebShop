<?php
include("global/config.php");
include("global/conexion.php");
include("carrito.php");
include("templates/cabecera.php");
?>

<?php
if (!empty($_SESSION['CARRITO'])){
//if ($_POST) {
    //$idVenta = $connect->lastInsertId();
    $SID = session_id();
    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $query = "UPDATE ventas SET datosp = 'BBB', status = 'Completado' WHERE clavetransaccion =:clavetransaccion";
        //print_r($idVenta);
        $sql = $connect->prepare($query);
        $sql->bindParam(":clavetransaccion", $SID);
        $sql->execute();

        //$ultimo_id = $connect->lastInsertId($sql);
        //echo $ultimo_id;
        $completado = $sql->rowCount();
   }
}
    $mensajePaypal = "Pago Completado";
    echo $mensajePaypal;
    echo $completado;
//}
?>

<div class="jumbotron">
    <h1 class="display-4">¡Listo!</h1>
    <hr class="my-4">
    <p class="lead"><?php echo $mensajePaypal; ?></p>
    <p>
        <?php
            if ($completado >= 1){  // >=1 | == 1
                foreach ($_SESSION['CARRITO'] as $indice => $producto) { 
                // $query = "SELECT * FROM detalleVenta, productos 
                //             WHERE detalleVenta.idProducto = productos.idProducto 
                //             AND detalleVenta.idVenta = 68;";
                
                $query = "SELECT max(detalleVenta.idVenta), productos.nombre, productos.imagen 
                            FROM detalleVenta, productos 
                            WHERE detalleVenta.idProducto = productos.idProducto 
                            GROUP BY detalleVenta.idVenta, productos.nombre, productos.imagen
                            ORDER BY detalleVenta.idVenta DESC LIMIT 2";

                $sql = $connect->prepare($query);
                //$sql->bindParam(":ID", $SID); // $claveVenta
                //$sql->bindParam(":clavetransaccion", $SID);
                $sql->execute();

                //$idVenta = $connect->lastInsertId($sql);
                //echo $idVenta;
                //$claveVenta = openssl_decrypt($producto['ID'], COD, KEY);
                //print_r($claveVenta);              
                }
                echo "hola <br>"; 
               
                $listarProductos = $sql->fetchALL(PDO::FETCH_ASSOC);
                print_r($listarProductos);
            }
        ?>

        <div class="row">
            <?php foreach($listarProductos as $producto) {?>
                <div class="col-2">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $producto['imagen'];?>">
                        <div class="card-body">
                            <p class="card-text"><?php echo $producto['nombre'];?></p>
                            <button class="btn btn-success" type="button">Descargar</button>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </p>
</div>

<?php include("templates/pie.php"); ?>

<!-- 
    AND ventas.clavetransaccion = :clavetransaccion"; 
    AND detalleVenta.idVenta = 67"; //ID
-->
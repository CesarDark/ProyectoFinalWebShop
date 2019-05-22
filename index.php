<?php
  include("global/config.php");
  include("global/conexion.php");
  include("carrito.php");
  include("templates/cabecera.php");
?>

<!-- Elementos -->
<!-- <div class="container"><br> -->
<!-- Mensaje Agregar Producto Carrito -->
<?php if ($mensaje != ""){?>
  <div class="alert alert-success">
    <?php echo $mensaje; ?>
    <a href="mostrarCarrito.php" class="badge badge-success">Ver Carrito</a> <!-- Botón Usuario-->
  </div>
<?php }?>

<!-- Columnas para los elementos -->
<div class="row">
  <?php
    $query = "SELECT * FROM productos";
    $sql = $connect->prepare($query);
    $sql->execute();
    $listarProductos = $sql->fetchALL(PDO::FETCH_ASSOC);
    //print_r($listarProductos); //Muestra array del producto.
  ?>
  <!-- Producto -->
  <?php foreach ($listarProductos as $producto){ ?>
    <div class="col-3">
      <div class="card">
        <!-- Imagen height="317px"-->
        <img title="<?php echo $producto['nombre']; ?>" 
             alt="<?php echo $producto['nombre']; ?>" 
             class="card-img-top" 
             src="<?php echo $producto['imagen']; ?>" 
             data-toggle="popover" data-trigger="hover" 
             data-content="<?php echo $producto['descripcion']; ?>"
        >
        <!-- Cuerpo -->
        <div class="card-body">
          <span><?php echo $producto['nombre']; ?></span>
          <h5 class="card-title">$<?php echo $producto['precio']; ?></h5>
          <p class="card-text"><?php echo $producto['descripcion']; ?></p>
          <!-- Botón -->
          <form action="" method="post">
            <!-- AES -->
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['idproducto'], COD, KEY); ?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>
  <!-- Producto -->
</div>
</div>

<script>
  $(function() {
    $('[data-toggle="popover"]').popover()
  });
</script>

<?php include("templates/pie.php"); ?>
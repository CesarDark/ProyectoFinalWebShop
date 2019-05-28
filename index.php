<?php
    include("global/config.php");
    include("global/conexion.php");
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>The Geek Store</title>
</head>

<body class="hm-gradient">
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <img src="../Images/3_Spiderman_cara_editado_1200x1200.png" width="30" height="30" alt="">
        <a class="navbar-brand" href="index.php">The Geek Store</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="somos.php"> ¿Quienes somos? </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="politica.php"> Politica de Compra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="contacto.php"> Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="inicio.php"> Inicia Sesión / Registrate</a>
                </li>
            </ul>
        </div>
    </nav> 
    <!-- Navegación -->

    <!-- Carrusel -->
    <div class="container">
        <div class="col-md-12">
            <div id="carousel-1" class="carousel slide" data-ride="carousel">
                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-1" data-slide-to="1"></li>
                    <li data-target="#carousel-1" data-slide-to="2"></li>
                </ol>
                <!-- Contenedor de los slide -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="/Images/Banner1.png" class="img-responsive" alt="">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide #1</h3>
                            <p>slide</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="/Images/Banner2.jpg" class="img-responsive" alt="">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide #2</h3>
                            <p>slide</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="/Images/slide1.1.jpg" class="img-responsive" alt="">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide #3</h3>
                            <p>slide</p>
                        </div>
                    </div>
                </div>

                <!-- Controles -->
                <a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </div> <br><br>
    <!-- Carrusel -->

    <!-- Columnas para los elementos -->
    <div class="container"><br>  
        <div class="row">
        <?php
            $query = "SELECT * FROM productos ORDER BY nombre DESC LIMIT 8;";
            $sql = $connect->prepare($query);
            $sql->execute();
            $listarProductos = $sql->fetchALL(PDO::FETCH_ASSOC);
        ?>
        <!-- Producto -->
        <?php foreach ($listarProductos as $producto){ ?>
            <div class="col-3">
            <div class="card">
                <!-- Imagen height="317px"-->
                <img title="<?php echo $producto['nombre']; ?>" 
                    alt="<?php echo $producto['nombre']; ?>" 
                    class="card-img-top" 
                    src="Images/<?php echo $producto['imagen']; ?>" 
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

                    <!-- <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button> -->
                </form>
                </div>
            </div>
            </div>
        <?php } ?>
        <!-- Producto -->
    </div>
</div>

<div class="form-group">
    <form action="inicio.php"> <br><br>
        <button class="btn btn-success btn-lg center-block" name="" value="Ver" type="submit">Ver más productos</button>
    </form>
</div>
<div class="text-center"><br><br>
    <strong>&copy; Cesar Rebollar 2019</strong>
</div> 

<script>
  $(function() {
    $('[data-toggle="popover"]').popover()
  });
</script>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
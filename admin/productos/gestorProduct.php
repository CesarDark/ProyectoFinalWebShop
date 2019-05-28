<?php
	// ob_start();
	session_start();
    $varsesion = $_SESSION['usuario'];
	if ($varsesion == null || $varsesion = ''){
		header ("Location: ../../archivos_sesion/error.php");
		die();
	}
?>

<?php require("producto.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Geek Store (Admin)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <img src="../../Images/3_Spiderman_cara_editado_1200x1200.png" width="30" height="30" alt="">
        <a class="navbar-brand" href="index.php">The Geek Store</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link " href="../../archivos_sesion/logout.php"> Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navegación -->

    <div class="container">
        <!-- enctype: para recepcionar imagenes -->
        <form action="" method="post" enctype="multipart/form-data">

            <!-- Botón Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" required name="txtProducto" value="<?php echo $txtProducto;?>" placeholder="" id="txtProducto" require="">    

                        <div class="form-group col-md-8">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control <?php echo isset(($error['nombre']))?"is-invalid":"";?>" required name="txtNombre" value="<?php echo $txtNombre;?>" placeholder="" id="txtNombre" require="">
                            <div class="invalid-feedback">
                                <?php echo isset(($error['nombre']))?$error['nombre']:"";?>
                            </div>
                            <br>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Precio:</label>
                            <input type="text" class="form-control <?php echo isset(($error['precio']))?"is-invalid":"";?>" required name="txtPrecio"  value="<?php echo $txtPrecio;?>" placeholder="" id="txtPrecio" require="">
                            <div class="invalid-feedback">
                                <?php echo isset(($error['precio']))?$error['precio']:"";?>
                            </div>
                            <br>
                        </div>                    
                        <div class="form-group col-md-12">
                            <label for="">Descripción:</label>
                            <input type="text" class="form-control <?php echo isset(($error['descripcion']))?"is-invalid":"";?>" required name="txtDescripcion"  value="<?php echo $txtDescripcion;?>" placeholder="" id="txtDescripcion" require="">
                            <div class="invalid-feedback">
                                <?php echo isset(($error['descripcion']))?$error['descripcion']:"";?>
                            </div>
                            <br>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="">Foto:</label>
                            <?php if ($txtFoto!=""){?>
                                <br/>
                                <img class="img-thumbnail rounded mx-auto d-block" width="150px" src="../../Images/<?php echo $txtFoto;?>">
                                <br/>
                                <br/>
                            <?php }?>
                            <input type="file" accept="image/*" class="form-control" name="txtFoto" value="<?php echo $txtFoto;?>" laceholder="" id="txtFoto" require=""><br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button value="btnAgregar" <?php echo $actionAgregar;?> class="btn btn-success" type="submit" name="action">Agregar</button>
                    <button value="btnModificar" <?php echo $actionModificar;?> class="btn btn-warning" type="submit" name="action">Modificar</button>        
                    <button value="btnEliminar" onclick=" return Confirmar('¿Realmente deseas borrar?');" <?php echo $actionEliminar;?> class="btn btn-danger" type="submit" name="action">Eliminar</button>
                    <button value="btnCancelar" <?php echo $actionCancelar;?> class="btn btn-primary" type="submit" name="action">Cancelar</button>
                </div>
                </div>
            </div>
            </div>
            
            <br><br><br><br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Agregar Producto
            </button>
            <br><br>
        </form>

        <!-- Mostar Productos -->
        <div class="row">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Foto</th>    
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>                    
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php foreach($listarProductos as $producto){?>
                    <tr>
                        <td><img class="img-thumbnail" width="100px" src="../../Images/<?php echo $producto['imagen'];?>"></td>
                        <td><?php echo $producto['nombre'];?></td>
                        <td>$<?php echo $producto['precio'];?></td>
                        <td><?php echo $producto['descripcion'];?></td>
                        <td>
                            <form action="" method="post">                         
                                <input type="hidden" name="txtProducto" value="<?php echo $producto['idproducto'];?>">
                                <input type="submit" value="Seleccionar" class="btn btn-info" name="action">   
                                <button value="btnEliminar" onclick=" return Confirmar('¿Realmente deseas borrar?');" type="submit" class="btn btn-danger" name="action">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
        <!-- Mostar Productos -->

        <!-- Script validación -->
        <?php if ($mostrarModal){?>
            <script>
                $('#exampleModal').modal('show');
            </script>
        <?php }?>

        <!-- Validación Error-->
        <script>
            function Confirmar(Mensaje){
                return (confirm(Mensaje))?true:false;
            }
        </script>

    </div>
</body>
</html>
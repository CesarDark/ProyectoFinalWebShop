<?php
$txtProducto = (isset($_POST['txtProducto']))?$_POST['txtProducto']:"";
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio = (isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtDescripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtFoto = (isset($_FILES['txtFoto']["name"]))?$_FILES['txtFoto']["name"]:"";

$action = (isset($_POST['action']))?$_POST['action']:"";

include("../../global/conexion.php");

switch ($action) {
    case "btnAgregar":
        $query = "INSERT INTO productos (nombre, precio, descripcion, imagen) values (:nombre, :precio, :descripcion, :imagen)";
        $sql = $connect->prepare($query);
        //Insertar en la tabla productos.
        $sql->bindParam(":nombre", $txtNombre);
        $sql->bindParam(":precio", $txtPrecio);
        $sql->bindParam(":descripcion", $txtDescripcion);
        
        // Actualizar foto
        $Fecha = new DateTime(); //Obtiene fecha exacta.
        $nombreArchivo = ($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES['txtFoto']['name']:"woo-no-image.jpg";
        $tmpFoto = $_FILES['txtFoto']['tmp_name'];

        //Valida que la foto no se llame igual a otra.
        if($tmpFoto!=""){
            move_uploaded_file($tmpFoto,"../../Images/".$nombreArchivo);
        }

        $sql->bindParam(":imagen", $nombreArchivo);
        $sql->execute();
       
        header('Location: gestorProduct.php');
        echo $txtNombre; 
        echo "Presionaste: btnAgregar";
    break;

    case 'btnModificar':
        $query = "UPDATE productos SET nombre=:nombre, precio=:precio, descripcion=:descripcion WHERE idproducto=:idproducto";
        $sql = $connect->prepare($query);
        //Modificar en la tabla productos.
        $sql->bindParam(":nombre", $txtNombre);
        $sql->bindParam(":precio", $txtPrecio);
        $sql->bindParam(":descripcion", $txtDescripcion);
        $sql->bindParam(":idproducto", $txtProducto);
        $sql->execute();

        // Actualizar foto
        $Fecha = new DateTime();
        $nombreArchivo = ($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES['txtFoto']['name']:"woo-no-image.jpg";
        $tmpFoto = $_FILES['txtFoto']['tmp_name'];

        if($tmpFoto!=""){
            move_uploaded_file($tmpFoto,"../../Images/".$nombreArchivo);

            //Modifica la foto existente.
            $query = "SELECT imagen FROM productos WHERE idproducto=:idproducto";
            $sql = $connect->prepare($query);
            $sql->bindParam(":idproducto", $txtProducto);
            $sql->execute();
            $producto = $sql->fetch(PDO::FETCH_LAZY);
            print_r($producto);

            //Para borrar la foto de la carpeta.
            if (isset($producto["imagen"])){
                if (file_exists("../../Images/".$producto["imagen"])){
                    unlink("../../Images/".$producto["imagen"]);
                }
            }

            //Actualiza con la foto actual.
            $query = "UPDATE productos SET imagen=:imagen WHERE idproducto=:idproducto";
            $sql = $connect->prepare($query);
            $sql->bindParam(":imagen", $nombreArchivo);
            $sql->bindParam(":idproducto", $txtProducto);
            $sql->execute();
        }
        
        header('Location: gestorProduct.php');
        echo $txtNombre;
        echo "Presionaste: btnModificar";
    break;
    
    case 'btnEliminar':    
        $query = "SELECT imagen FROM productos WHERE idproducto=:idproducto";
        $sql = $connect->prepare($query);
        $sql->bindParam(":idproducto", $txtProducto);
        $sql->execute();
        $producto = $sql->fetch(PDO::FETCH_LAZY);
        print_r($producto);

        //Para borrar la foto de la carpeta.
        if (isset($producto["imagen"])){
            if (file_exists("../../Images/".$producto["imagen"])){
                unlink("../../Images/".$producto["imagen"]);
            }
        }
        
        //Eliminar en la tabla productos.
        $query = "DELETE FROM productos WHERE idproducto=:idproducto";
        $sql = $connect->prepare($query);
        $sql->bindParam(":idproducto", $txtProducto);
        $sql->execute();
    
        header('Location: gestorProduct.php');
        echo $txtNombre;
        echo "Presionaste: btnEliminar";
    break;

    case 'btnCancelar':
        echo $txtNombre;
        echo "Presionaste: btnCancelar";
    break;
}

$query = "SELECT idProducto, nombre, precio, descripcion, imagen FROM productos";
$sql = $connect->prepare($query);
$sql->execute();

$listarProductos = $sql->fetchALL(PDO::FETCH_ASSOC);
//print_r($listarProductos);

?>

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
    <div class="container">
        <!-- enctype: para recepcionar imagenes -->
        <form action="" method="post" enctype="multipart/form-data">
        
            <input type="hidden" required name="txtProducto" value="<?php echo $txtProducto;?>" placeholder="" id="txtProducto" require="">    

            <label for="">Nombre:</label>
            <input type="text" name="txtNombre" required value="<?php echo $txtNombre;?>" placeholder="" id="txtNombre" require="">
            <br>
            <label for="">Precio:</label>
            <input type="text" name="txtPrecio" required value="<?php echo $txtPrecio;?>" placeholder="" id="txtPrecio" require="">
            <br>
            <label for="">Descripción:</label>
            <input type="text" name="txtDescripcion" required value="<?php echo $txtDescripcion;?>" placeholder="" id="txtDescripcion" require="">
            <br>
            <label for="">Foto:</label>
            <input type="file" accept="image/*" name="txtFoto" value="<?php echo $txtFoto;?>" laceholder="" id="txtFoto" require=""><br>

            <button value="btnAgregar" type="submit" name="action">Agregar</button>
            <button value="btnModificar" type="submit" name="action">Modificar</button>
            <button value="btnEliminar" type="submit" name="action">Eliminar</button>
            <button value="btnCancelar" type="submit" name="action">Cancelar</button>
        </form>

        <!-- Mostar Prodcutos -->
        <div class="row">
            <table class="table">
                <thead>
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
                                <input type="hidden" name="txtNombre" value="<?php echo $producto['nombre'];?>">
                                <input type="hidden" name="txtPrecio" value="<?php echo $producto['precio'];?>">
                                <input type="hidden" name="txtDescripcion" value="<?php echo $producto['descripcion'];?>">
                                <input type="hidden" name="txtFoto"  value="<?php echo $producto['imagen'];?>">
                                
                                <input type="submit" value="Seleccionar" name="action">   
                                <button value="btnEliminar" type="submit" name="action">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </div>
</body>
</html>
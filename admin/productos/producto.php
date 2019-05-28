<?php
    $txtProducto = (isset($_POST['txtProducto']))?$_POST['txtProducto']:"";
    $txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtPrecio = (isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
    $txtDescripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
    $txtFoto = (isset($_FILES['txtFoto']["name"]))?$_FILES['txtFoto']["name"]:"";

    $action = (isset($_POST['action']))?$_POST['action']:"";
    $error = array();

    $actionAgregar = "";
    $actionModificar = $actionEliminar = $actionCancelar = "disabled";
    $mostrarModal = false;

    include("../../global/conexion.php");

    switch ($action) {
        case "btnAgregar":
            //Valdadción del lado del servidor.
            if ($txtNombre == ""){
                $error['nombre'] =  "Escribe el nombre";
            }
            if ($txtNombre == ""){
                $error['precio'] =  "Escribe el precio";
            }
            if ($txtNombre == ""){
                $error['descripcion'] =  "Escribe la descripción";
            }
            
            if (count($error) > 0){
                $mostrarModal = true;
                break;
            }

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
                        if ($producto["imagen"]!="woo-no-image.jpg"){
                            unlink("../../Images/".$producto["imagen"]);
                        }
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
        break;
        
        case 'btnEliminar':    
            $query = "SELECT imagen FROM productos WHERE idproducto=:idproducto";
            $sql = $connect->prepare($query);
            $sql->bindParam(":idproducto", $txtProducto);
            $sql->execute();
            $producto = $sql->fetch(PDO::FETCH_LAZY);
            print_r($producto);

            //Para borrar la foto de la carpeta.
            if (isset($producto["imagen"]) && ($producto["imagen"]!="woo-no-image.jpg")){
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
        break;

        case 'btnCancelar':
            header('Location: gestorProduct.php');
        break;

        case 'Seleccionar':
            $actionAgregar = "disabled";
            $actionModificar = $actionEliminar = $actionCancelar = "";
            $mostrarModal = true;

            $query = "SELECT nombre, precio, descripcion, imagen FROM productos WHERE idproducto=:idproducto";
            $sql = $connect->prepare($query);
            $sql->bindParam(":idproducto", $txtProducto);
            $sql->execute();
            $producto = $sql->fetch(PDO::FETCH_LAZY);

            $txtNombre = $producto['nombre'];
            $txtPrecio = $producto['precio'];
            $txtDescripcion = $producto['descripcion'];
            $txtFoto = $producto['imagen'];
        break;
    }

    $query = "SELECT idProducto, nombre, precio, descripcion, imagen FROM productos";
    $sql = $connect->prepare($query);
    $sql->execute();

    $listarProductos = $sql->fetchALL(PDO::FETCH_ASSOC);
    //print_r($listarProductos);

?>
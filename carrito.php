<?php
    session_start();

    $mensaje="";

    // Evaluar el botón
    if (isset($_POST['btnAccion'])) {
        switch ($_POST['btnAccion']) {
            //Acción Agregar
            case 'Agregar':
                if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                    $ID=openssl_decrypt($_POST['id'], COD, KEY);
                    $mensaje.="Ok, Id Correcto: ".$ID."<br/>";
                } else {
                    $mensaje.="Upss..., Id Incorrecto: ".$ID."<br/>";
                    break;
                }

                if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                    $NOMBRE=openssl_decrypt($_POST['nombre'], COD, KEY);
                    $mensaje.="Ok, Nombre Correcto: ".$NOMBRE."<br/>";
                } else {
                    $mensaje.="Upss..., Nombre Incorrecto: ".$NOMBRE."<br/>";
                    break;
                }

                if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                    $PRECIO=openssl_decrypt($_POST['precio'], COD, KEY);
                    $mensaje.="Ok, Precio Correcto: ".$PRECIO."<br/>";
                } else {
                    $mensaje.="Upss..., Precio Incorrecto: ".$PRECIO."<br/>";
                    break;
                }

                if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                    $CANTIDAD=openssl_decrypt($_POST['cantidad'], COD, KEY);
                    $mensaje.="Ok, Cantidad Correcto: ".$CANTIDAD."<br/>";
                } else {
                    $mensaje.="Upss..., Cantidad Incorrecto: ".$CANTIDAD."<br/>";
                    break;
                }
                
                //Evaluar Variable de Sesión
                if (!isset($_SESSION['CARRITO'])) { //Si no existen productos.
                    $producto = array(
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'PRECIO'=>$PRECIO,
                        'CANTIDAD'=>$CANTIDAD
                    );
                    $_SESSION['CARRITO'][0] = $producto;
                    $mensaje = "Producto agregado al carrito ";

                } else { //Si existen productos.
                    //Evalular si el producto se ha seleccionado más veces.
                    $idProductos = array_column($_SESSION['CARRITO'], "ID"); //Función para depositar todos los Id del carrito de compras.
                    if(in_array($ID, $idProductos)){
                        echo "<script> alert('El producto ya ha sido seleccionado...');</script>";
                        $mensaje = "";
                    }else {
                        $numeroProductos = count($_SESSION['CARRITO']); //Contabilizar carrito de compras.
                        $producto = array(
                            'ID'=>$ID,
                            'NOMBRE'=>$NOMBRE,
                            'PRECIO'=>$PRECIO,
                            'CANTIDAD'=>$CANTIDAD
                        );
                        $_SESSION['CARRITO'][$numeroProductos] = $producto;
                        $mensaje = "Producto agregado al carrito ";
                    }
                }
                //$mensaje = print_r($_SESSION, true); //Imprime el arrary del producto.
                

            break;
            
            //Acción Eliminar
            case 'Eliminar':
                if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                    $ID=openssl_decrypt($_POST['id'], COD, KEY);
                    //Evaluar valores que coinciden con el Id seleccionado.
                    foreach($_SESSION['CARRITO'] as $indice=>$producto){
                        if ($producto['ID'] == $ID){
                            //Función unset() para eliminar registros de la variable de sesión.
                            unset($_SESSION['CARRITO'][$indice]);
                            // echo "<script> alert('Elemento borrado...');</script>";
                        }
                    }
                } else {
                    $mensaje.="Upss..., Id Incorrecto: ".$ID."<br/>";
                    break;
                }
            break;
        }
    }
?>
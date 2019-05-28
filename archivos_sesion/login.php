<?php
    session_start();
    include("../global/config.php");
    include("../global/conexion.php");

    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);

    $query = "SELECT usuarioNombre, contraseña, rol 
                FROM usuarios
                WHERE usuarioNombre = '$usuario' 
                AND contraseña = '$password'";

    $sql = $connect->prepare($query);
    $sql->execute();

    $contador = $sql->rowCount();
    $usuarioDB = $sql-> fetch(PDO::FETCH_ASSOC);

    
    if ($usuarioDB){
        if ($usuario == $usuarioDB['rol']){
            $_SESSION['usuario'] = $usuario;
            header('Location: ../admin/productos/gestorProduct.php');

        } else {
            $_SESSION['usuario'] = $usuario;
            header('Location: ../principal.php');
        }
    } else {
        header('Location: ../inicio.php');
    }
?>
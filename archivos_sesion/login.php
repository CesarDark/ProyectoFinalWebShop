<?php
    session_start();
    include("../global/config.php");
    include("../global/conexion.php");

    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);

    $query = "SELECT usuarioNombre, contraseña FROM usuarios WHERE usuarioNombre = '$usuario' AND contraseña = '$password'";
    $sql = $connect->prepare($query);
    //$sql->bindParam(":usuarioNombre", $usuario);
    //$sql->bindParam(":contraseña", $password);
    $sql->execute();

    $contador = $sql->rowCount();
    if($contador ==1){ 
        //pasamos los valores de la consulta a variable
        $usuarioDB = $sql-> fetch(PDO::FETCH_ASSOC); //Guarda los registros que devuelve la SELECT en un array asociativo
        print_r($usuarioDB);
        $_SESSION['usuario'] = $usuario;
        header('Location: ../principal.php');
    }
    



    // echo "Consulta ".$query;
    // echo "<br>";
    // var_dump($query);
    // var_dump($result);

    // $temp = pg_fetch_row($result);
    // // var_dump($temp);
    // // $pass = pg_fetch_row($result);
    // $user = $temp[0];
    // $pass = $temp[1];
    // echo "Usuario: ".$user. " ".$pass;

    // if (($usuario == $user) && ($password == $pass)) {
    //     $_SESSION['usuario'] = $usuario;
    //     // echo "La variable de sesión es: " .$_SESSION['username'];
    //     header('Location: ../principal.php');
    // } else {
    //     // echo "No se puedo iniciar sesión";
    //     session_destroy();
    //     header('Location: ../index.php');
    // }
?>
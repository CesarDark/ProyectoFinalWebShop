<?php
    include("../global/config.php");
    include("../global/conexion.php");
?>
<?php
	$nombre = $_POST['nombre'];
	$apaterno = $_POST['apaterno'];
	$usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

	$query = "INSERT INTO usuarios (nombre, apaterno, usuarioNombre, correo, contraseña) VALUES ('$nombre', '$apaterno', '$usuario', '$email', '$password')";
    $sql = $connect->prepare($query);
    $sql->execute();
	

    echo"<script>alert('Registro Exitoso.'); window.location.href=\"../index.php\"</script>";
?>

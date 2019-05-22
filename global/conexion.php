<?php
	$host = "127.0.0.1"; //www.thegeekstore.com.mx
	$port = "5432";
	$dbname = "geekshop";
	$dbuser = "admin_shop"; //postgres
	$dbpass = "mishop";

	try {
		$connect = new PDO("pgsql:dbname=$dbname;host=$host;port=$port", $dbuser, $dbpass);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// si la conexion fue exitosa
		//echo "<script> alert('Conectado Shop')</script>";

	} catch (PDOException $e) {
		//echo "Error: " . $e->getMessage();
		//echo "<script> alert('Error...')</script>";
	}
?>
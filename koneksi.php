<?php 
	$host_connection = "localhost";
	$username_connection = "root";
	$password_connection = "";
	$database_connection = "db_store";

	$koneksi = mysqli_connect($host_connection, $username_connection, $password_connection);

	if ($koneksi) {
		mysqli_select_db($koneksi, $database_connection);
	}else{
		echo "Koneksi Database gagal";
	}
?>

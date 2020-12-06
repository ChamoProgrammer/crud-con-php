<?php
function pdo_connect_mysql() {
    $BASE_DATOS_HOST = 'localhost';
    $BASE_DATOS_USUARIO = 'root';
    $BASE_DATOS_CONTRASEÑA = '';
    $BASE_DATOS_NOMBRE = 'formular_crud';
    try {
    	return new PDO('mysql:host=' . $BASE_DATOS_HOST . ';dbname=' . $BASE_DATOS_NOMBRE . ';charset=utf8', $BASE_DATOS_USUARIO, $BASE_DATOS_CONTRASEÑA);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('conexion de base de datos fallida!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="estilos.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="https://fonts.googleapis.com/css2?family=Gugi&family=Pattaya&family=Rye&family=VT323&display=swap" rel="stylesheet">
		</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Website Title</h1>
            <a href="indice.php"><i class="fas fa-home"></i>inicio</a>
    		<a href="leer.php"><i class="fas fa-address-book"></i>Contactos</a>
    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>
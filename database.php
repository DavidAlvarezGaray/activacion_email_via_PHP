<?php
    $server = ''; // Aquí colocan la URL del servidor para accesar a él
    $username = ''; // Se necesita el usuario del servidor de MySQL
    $password = ''; // Colocar la contraseña
    $database = ''; // Elegir la base de datos que se requiere usar

	// Se utiliza un try catch para intentar la conexión y en caso de no establecerse nos regrese un mensaje de error y cierre la conexión
    try{
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
    } catch (PDOException $e) {
        
        die('Connection failed: '.$e->getMessage());
    }
?>
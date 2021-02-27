<?php

// Requerir el archivo database.php 
require 'database.php';

$message = '';

// Tomar el correo electrónico y la contraseña del cliente
if (!empty($_POST['email_clie'])  && !empty($_POST['pssword_clie'])){
    $sql = "INSERT INTO cliente (nickname_clie, email_clie, psswrd_clie, nom_clie, hash_) VALUES (:nickname_clie, :email_clie, :pssword_clie, :nom_clie, :hash_)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email_clie',$_POST['email_clie']);
    $password = password_hash($_POST['pssword_clie'], PASSWORD_BCRYPT);
    $hash = md5( rand(0,1000) );
    $stmt->bindParam(':hash_', $hash);
    $stmt->bindParam(':pssword_clie', $password);
    $nickname_lwr = strtolower($_POST['nickname_clie']);
    $stmt->bindParam(':nickname_clie',$nickname_lwr);
    $stmt->bindParam(':nom_clie',$_POST['nom_clie']);
    $email = $_POST['email_clie'];
    $_nickname_ = $_POST['nickname_clie'];
    $_password_us = $_POST['pssword_clie'];

$to      = $email; // Enviar Email al usuario
$subject = 'Signup | Verification'; // Darle un asunto al correo electrónico
$message = '
 
Gracias por registrarte!
Tu cuenta ha sido creada, activala utilizando el enlace de la parte inferior.
 
------------------------
Username: '.$_nickname_.'
Password: '.$_password_us.'
------------------------
 
Por favor haz clic en este enlace para activar tu cuenta:
http://aquivaelnombrededominio.com/php/activar.php?email='.$email.'&hash='.$hash.'
'; // Aqui se incluye la URL para ir al mensaje
                     
$headers = 'From:noreply@aquivtucorreoelectronico.com' . "\r\n"; // Colocar el encabezado
mail($to, $subject, $message, $headers); // Enviar el correo electrónico
    
    if($stmt->execute()){
        $message ='Successful';
        
        header('Location: login.php'); // En caso de que sea satisfactorio el proceso, se redirige al formulario de Login
    } else {
        $message = 'Ups :( Algo salió mal';

    }   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="../css/signup.css">
    <script src="../javascripts/validar_signin.js"></script>
</head>
<body>
    <header class="header">
        <div class="container logo-nav-container">
            <div class="logo">
                <div>
                </div>
                <div class="menu-icon">
                    <img src="../imgs/image3.png" alt="MENÚ">
                </div>
            </div>
             <nav class="navigation">
                <ul>
                    <li><a href="../index.html">Inicio</a></li>
                    <li><a href="../servicios.html">Servicios</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main">

        <div class="signup-box">

            <?php if(!empty($message)): ?>
                    <p><?= $message ?></p>
            <?php endif; ?>
            <h2>Regístrate</h2>

            <form action="registrarse.php" method="post" onsubmit="return validarsign();">
				<!--USERNAME-->
				<LABEL for="username">Nombre de usuario</LABEL>
				<input id="_cliente_" type="text" name="nom_clie" placeholder="Ingresa el nombre" required autofocus>
				<!--EMAIL-->
				<LABEL for="email">Correo electrónico</LABEL>
				<input id="_correo_" type="text" name="email_clie" placeholder="Ingresa el correo eléctrico" required>
				<!--PASSWORD-->
				<LABEL for="psswrd">Contraseña</LABEL>
				<input id="_pssword_" type="password" name="pssword_clie" placeholder="Ingresa contraseña" required>
				<!--PASSWORD CONFIRMATION-->
				<LABEL for="nickname">Nickname</LABEL>
				<input id="_nickname_" type="text" name="nickname_clie" placeholder="Ingresa un apodo (max. 10 caracteres)" required>
	
                <input type="submit" name="aceptar_" value="Registrar">
            </form>
            <div class="existente">
                <span>¿Ya tienes una cuenta? <a href="login.php">Ingresar ahora</a></span>
            </div>
            
		</div>

    </main>
    <footer class="footer">
        <div class="container">
           <p>GitHub: DavidAlvarezGaray</p> 
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../scripts.js"></script>
</body>
</html>




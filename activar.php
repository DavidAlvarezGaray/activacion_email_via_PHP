<?php
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verificar datos
    $email = mysql_escape_string($_GET['email']); // Asignar el correo electrónico a una variable
    $hash = mysql_escape_string($_GET['hash']); // Asignar el hash a una variable
                 
    $search = mysql_query("SELECT email_clie, hash_, activo FROM cliente WHERE email_clie='".$email."' AND hash_='".$hash."' AND activo='0'") or die(mysql_error()); 
    $match  = mysql_num_rows($search);
                 
    if($match > 0){
        // Hay una coincidencia, activar la cuenta
        mysql_query("UPDATE cliente SET activo='1' WHERE email_clie='".$email."' AND hash_='".$hash."' AND activo='0'") or die(mysql_error());
        echo '<div class="statusmsg">Tu cuenta ha sido activada, ya puedes iniciar sesión.</div>';
    }else{
        // No hay coincidencias
        echo '<div class="statusmsg">La URL es inválida  o ya has activado tu cuenta.</div>';
    }
}else{
    // Intento nó válido (ya sea porque se ingresa sin tener el hash o porque la cuenta ya ha sido registrada)
    echo '<div class="statusmsg">Intento inválido, por favor revisa el mensaje que enviamos correo electrónico</div>';
}
?>
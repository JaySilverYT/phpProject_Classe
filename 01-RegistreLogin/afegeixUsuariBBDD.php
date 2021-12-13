<?php
    require_once("Includes/bbddConex.php");

function crearUsuario($email, $username, $password, $firstName, $lastName)
{

    $db = openDB();

    $sql = "INSERT INTO `users`(mail,username,passHash,userFirstName,userLastName,creationDate,removeDate,lastSignIn,active) 
    VALUES('$email','$username','$password','$firstName','$lastName', NOW(), null, null, 0)";
    
    $db->query($sql);
}

?>
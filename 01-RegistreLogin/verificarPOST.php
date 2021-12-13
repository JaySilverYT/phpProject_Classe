<?php
require_once("afegeixUsuariBBDD.php");
$username = null;
$email = null;
$firstName = null;
$lastName= null;
$password = null;
$verifyPassword = null;

if (isset($_POST["username"]) && !is_numeric($_POST["username"]) && strlen($_POST["username"]) <= 16 && strlen($_POST["username"]) > 0 && ctype_space($_POST["username"]) == false)
{
    $username = filter_input(INPUT_POST, "username");
}

if (isset($_POST["email"]) && !is_numeric($_POST["email"]) && strlen($_POST["email"]) <= 40 && ctype_space($_POST["email"]) == false)
{
    $email = filter_input(INPUT_POST, "email");
}


if (isset($_POST["firstname"]) && !is_numeric($_POST["firstname"]) && strlen($_POST["firstname"]) <= 60 && ctype_alpha($_POST["firstname"]) && ctype_space($_POST["firstname"]) == false)
{
    $firstName = filter_input(INPUT_POST, "firstname");
}

if (isset($_POST["lastname"]) && !is_numeric($_POST["lastname"]) && strlen($_POST["lastname"]) <= 120 && ctype_alpha($_POST["lastname"]) && ctype_space($_POST["lastname"]) == false)
{
    $lastName = filter_input(INPUT_POST, "lastname"); 
}


if (isset($_POST["password"]) && strlen($_POST["password"]) <= 60 && ctype_space($_POST["password"]) == false)
{
    $password = filter_input(INPUT_POST, "password"); 
}

if (isset($_POST["verifypassword"]) && strlen($_POST["verifypassword"]) <= 60 && ctype_space($_POST["verifypassword"]) == false)
{
    $verifyPassword = filter_input(INPUT_POST, "verifypassword"); 
}

if (!is_null($username) && !is_null($email) && !is_null($firstName) && !is_null($lastName) && !is_null($password) && !is_null($verifyPassword))
{
    if ($password != $verifyPassword)
    {
        header("Location: ../01-RegistreLogin/register.php"); //Et retorna al formulari de registre
    }
    else 
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        crearUsuario($email, $username, $password, $firstName, $lastName); //Crea el usuario en la BBDD.

        header("Location: ../01-RegistreLogin/index.php"); //Et retorna al Login
    }
}
else
{
    header("Location: ../01-RegistreLogin/register.php"); //Et retorna al formulari de registre
}

?>
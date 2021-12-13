<?php require 'Includes/bbddConex.php' ?>

<?php
$db = openDB();
$username = false;
$passwordOK = false;

if(isset($_POST['username']) && !empty($_POST['username']))
{
    $username = filter_input(INPUT_POST,'username'); //Filter input serveix per a evitar la injeccio de codi.
}

if(isset($_POST['password']) && !empty($_POST['password']) && strlen($_POST['password']) < 12)
{
    $password = filter_input(INPUT_POST, 'password'); //Filter input serveix per a evitar la injeccio de codi.
}

$sql = 'SELECT username, passHash FROM `users` WHERE `username` = ? OR `mail` = ?';
$usuaris = $db->prepare($sql);
$usuaris->execute(array($username, $username)); //Dentro del execute tiene que haber las variables en orden que hay en el WHERE del sql. (En este caso 'username' e 'password's)


foreach ($usuaris as $fila) {

    if ($fila['username'] == $username || $fila['mail'] == $username)
    {
        $nombreOK = true;
    }

    if ($fila['passHash'] == password_verify($password, $fila['passHash']))
    {
        $passwordOK = true;
    }
}

if($nombreOK == true && $passwordOK == true)
{
    header('Location: home.php');
}
else
{
    header('Location: index.php');
}

?>
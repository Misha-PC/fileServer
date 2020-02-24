<?php

$servername = "localhost";
$username = "server";
$password = "00001";
$database = "my_server";

$link = mysqli_connect($servername, $username, $password, $database);

if (!$link) {
    echo "false";
    die('Ошибка соединения: ' . mysql_error());
}

$id = $_GET['id'];



$query = "select patch from files where id='$id';";

$result = $link->query($query);


$file = mysqli_fetch_assoc($result)['patch'];

unlink($file);


$query = "delete from files where id='$id';";

$link->query($query);


echo "true";

?>
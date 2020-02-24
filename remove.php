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

<<<<<<< HEAD

=======
>>>>>>> 131de79af9301ba7116035fca2e7d16fef5a69f4
$file = mysqli_fetch_assoc($result)['patch'];

unlink($file);
$query = "delete from files where id='$id';";

$link->query($query);
echo "true";

?>
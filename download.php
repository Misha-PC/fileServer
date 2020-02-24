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

$query = "select file_name from files where id='$id';";

$result = $link->query($query);

$name =  mysqli_fetch_assoc($result)['file_name'];


header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$name ");
header("Content-Transfer-Encoding: binary");    
readfile("saved_files/$name");

?>
<html>
    <head>

    </head>
        <script src="src/js/login.js"></script>

        <link rel="stylesheet" href="src/style/login.css">
    <body>

    <div class="div_login" id="log">
        <!-- <form method="post" action="page.php"> -->
           <p class="title"> LOGIN</p>
        <form method="post" >
            <p>Login</p>
            <input class="login"  type="text" name="login">
            <p>Password</p>
            <input class="pass" type="password" name="password">
            <input class="btn" type="submit" value="SignIN">
         </form>
    </div>
    
    <div class="div_reg" id="reg">
        <p class="title">REGISTRATION </p>
        <!-- <form method="post" action="page.php"> -->
        <form method="post" >
         
            <p>Login</p>
            <input class="login"  type="text" name="login">
            
            <p>Password</p>
            <input class="pass" type="password" name="password">
         
            <p>Confirm password</p>
            <input class="pass" type="password" name="c_password">
         
            <p>Mail</p>
            <input class="pass" type="mail" name="mail">
            
            <input class="btn" type="submit" value="SignUP">
         </form>
    </div>

    <div class="div_btn" onclick="swap()"></div>

    </body>
</html>

<?php 

if($_COOKIE['id'] != -1 && $_COOKIE['id']){
    header('Location: index.php');

}
  



$servername = "localhost";
$username = "server";
$password = "00001";
$database = "my_server";


$link = mysqli_connect($servername, $username, $password, $database);


if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}



if(!isset($login) ) {
    $login = $_POST['login'];
    $pass =  $_POST['password'];

    $query = "select id from users where login='$login' and pass='$pass';";

    $result = $link->query($query);

    if ($result->num_rows != 0){
        setcookie("id", mysqli_fetch_assoc($result)['id']);
        setcookie("login", $login);
        header('Location: index.php');
    } 
}


/*

insert into users(login, pass) values ('', '');

select id from users where login='' and pass='';

*/

?>



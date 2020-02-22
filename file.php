
<?php



if ( 0 < $_FILES['file']['error'] ) {
  echo 'Error: ' . $_FILES['file']['error'];
}
else {
  move_uploaded_file($_FILES['file']['tmp_name'], 'saved_files/' . $_FILES['file']['name']);
}

registorFileToDB($_FILES['file']['name'], $_POST['user_id'], $_POST['size'], $_POST['last_edit']);


function registorFileToDB($name, $ovnerID, $size, $edit){
  
  $servername = "localhost";
  $username = "server";
  $password = "00001";
  $database = "my_server";

  $link = mysqli_connect($servername, $username, $password, $database);

  $patch = "saved_files/".$name;


  if (!$link) {
      die('Ошибка соединения: ' . mysql_error());
  }

  $query = " insert into files(ovner_id, file_name, last_edit, size, patch) values ('$ovnerID', '$name', '$edit', '$size', '$patch')";


  $link->query($query);

  $query = "select id from files where file_name='$name' and size='$size'";
  $result = $link->query($query);

  echo mysqli_fetch_assoc($result)['id'];

}






?>

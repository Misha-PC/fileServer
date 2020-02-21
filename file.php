
<?php



// fwrite(STDOUT, "testssss");

// console_log($_FILES['userfile']['name']);

error_log(print_r($_FILES['userfile']['name'], TRUE));
error_log(print_r($_POST, TRUE));

$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'saved_files'.DIRECTORY_SEPARATOR;
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);



if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    $out = "Файл корректен и был успешно загружен.\n";
} else {
    $out = "Возможная атака с помощью файловой загрузки!\n";
}

echo $out;




if ( 0 < $_FILES['file']['error'] ) {
  echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
  move_uploaded_file($_FILES['file']['tmp_name'], 'test/' . $_FILES['file']['name']);
}

?>

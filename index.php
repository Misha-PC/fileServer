<?php
    if(!$_COOKIE['id'] || $_COOKIE['id'] == -1){
      header('Location: login.php');
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="src/style/index.css">
        <script src="src/js/index.js"></script>
    </head>

<body>



<div class="divBody">

  <table class="allFile" >
  <tbody id="files">

    <tr class="fileHead">
      <td class="fileName"     > name </td>
      <td class="fileOvner"    > ovner </td>
      <td class="fileLastEdit" > Last edit</td>
      <td class="fileSize"     > size </td>
      <td class="fileStartHead"> start </td>
    </tr>

    </tbody>


  </table>

  <div class="fileList">

  </div>



</div>


<div class="newFile" onclick="select()">

  <div id="p1"></div>
  <div id="p2"></div>
</div>
<div id="bar"class="bar"><div id="progress" class="progress"></div></div>

<form name="uploader" enctype="multipart/form-data" method="POST">
        <input name="userfile" type="file" id="f1" onchange="upload()" />
        <button type="submit" name="submit"></button>
</form>

<div class="divHead">
  <div class="divMenuItem" onclick="removeFile()">Remove file</div>
  <div class="divMenuItem" onclick="downloadFile()">Download</div>
  <div class="divMenuItem" onclick="startFile()">Start</div>


  <div class="divOut">
    <span class="outTooltip" onclick="out()">Out</span>
  </div>
</div>

<!-- <div class="divUpload"></div> -->



<?php

function getFilesArray(){
  $servername = "localhost";
  $username = "server";
  $password = "00001";
  $database = "my_server";

  $link = mysqli_connect($servername, $username, $password, $database);

  if (!$link) {
      die('Ошибка соединения: ' . mysql_error());
  }

  $query = "select * from files where ovner_id='".$_COOKIE['id']."';";
  $outArray = [];
  $index = 0;

  $result = $link->query($query);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $tmp = [];
      $tmp[0] = $row['id'];
      $tmp[1] = $row['file_name'];
      $tmp[2] = $row['last_edit'];
      $tmp[3] = $row['size'];
      $outArray[$index++] = $tmp;
    }
  }

    return $outArray;
}

function arrToStr($arr){
  $outStr = "[";
  $currentArr = [];
  $currentIntex = 0;
  foreach ($arr as &$value) $currentArr[$currentIntex++] = "['". implode("', '", $value) . "']";
  return "[". implode(', ', $currentArr) . "]";
}


echo '<script> createFileDiv(' . arrToStr(getFilesArray()) . ') </script>';


?>



</body>

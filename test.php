

<html>
    <head>
        <!-- <link rel="stylesheet" href="src/style/index.css"> -->
        <script src="src/js/index.js"></script>
    </head>

<body>

<?php

$outArray = [];
$index = 0;


// $result = $link->query($query);

while ($index < 20){
  $tmp = [];

  $tmp["name"] = "name_$index";
  $tmp["size"] = "21$index";
  $tmp["edit"] = "20.02.202$index";
  
  $outArray[$index++] = $tmp; 
}

function arrToStr($arr){
    $outStr = "[";
    $currentArr = [];
    $currentIntex = 0;
    foreach ($arr as &$value) $currentArr[$currentIntex++] = "['". implode("', '", $value) . "']";
    return "[". implode(', ', $currentArr) . "]";
}


echo '<script> echo(' . arrToStr($outArray) . ') </script>';


// print_r( $outArray);


// class Files {
//     private $fileArray
// }


?>
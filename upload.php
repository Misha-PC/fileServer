<html>
    <head>
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">    
    
        function hideBtn(){
            $('#upload').hide();
            $('#res').html("Идет загрузка файла");
        }
        
        function handleResponse(mes) {
            $('#upload').show();
            if (mes.errors != null) {
                $('#res').html("Возникли ошибки во время загрузки файла: " + mes.errors);
            }    
            else {
                $('#res').html("Файл " + mes.name + " загружен");    
            }    
        }
    </script>

    <form action="upload.php" method="post" target="hiddenframe" enctype="multipart/form-data" onsubmit="hideBtn();">
    <input type="file" id="userfile" name="userfile" />
    <input type="submit" name="upload" id="upload" value="Загрузить" />
    </form>
    <div id="res"></div>
    <iframe id="hiddenframe" name="hiddenframe" style="width:0px; height:0px; border:0px"></iframe>

    <?php 
    
if(isset($_POST['upload'])){
    //Список разрешенных файлов
    $whitelist = array(".gif", ".jpeg", ".png", ".jpg", ".mp4", ".zip");         
    $data = array();
    $error = true;
    
    //Проверяем разрешение файла
    foreach  ($whitelist as  $item) {
        if(preg_match("/$item\$/i",$_FILES['userfile']['name'])) $error = false;
    }

    //если нет ошибок, грузим файл
    if(!$error) { 
        $folder =  'test/';//директория в которую будет загружен файл
        $uploadedFile =  $folder.basename($_FILES['userfile']['name']);
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
            if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadedFile)){
                $data = $_FILES['userfile'];
                
            }
            else {    
                $data['errors'] = "Во время загрузки файла произошла ошибка";
            }
        }
        else {    
            $data['errors'] = "Файл не  загружен";
        }
    }
    else{
        $data['errors'] = 'Вы загружаете запрещенный тип файла';
    }
    
    
    //Формируем js-файл    
    $res = '<script type="text/javascript">';
    $res .= "var data = new Object;";
    foreach($data as $key => $value){
        $res .= 'data.'.$key.' = "'.$value.'";';
    }
    $res .= 'window.parent.handleResponse(data);';
    $res .= "</script>";
    
    echo $res;

}
else{
    // die("ERROR");
}

?>

</body>
